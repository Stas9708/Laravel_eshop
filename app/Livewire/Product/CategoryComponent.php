<?php

namespace App\Livewire\Product;


use App\Helpers\Traits\CartTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\isNull;


class CategoryComponent extends Component
{
    use WithPagination, CartTrait;

    public string $slug = '';

    #[Url]
    public string $sort = 'default';
    public array $sortList = [
        'default' => ['title' => 'Default', 'order_field' => 'id', 'order_direction' => 'desc'],
        'name-asc' => ['title' => 'Name (a-z)', 'order_field' => 'title', 'order_direction' => 'asc'],
        'name-desc' => ['title' => 'Name (z-a)', 'order_field' => 'title', 'order_direction' => 'desc'],
        'price-asc' => ['title' => 'Price (low > high)', 'order_field' => 'price', 'order_direction' => 'asc'],
        'price-desc' => ['title' => 'Price (high > low)', 'order_field' => 'price', 'order_direction' => 'desc']
    ];

    #[Url]
    public int $limit = 3;
    public array $limitList = [3, 6, 9, 12];
    #[Url]
    public array $selectedFilters= [];
    #[Url]
    public $minPrice;
    #[Url]
    public $maxPrice;


    public function mount($slug)
    {
        $this->slug = $slug;
        if (!isset($this->sortList[$this->sort])) {
            $this->redirectRoute('category', ['slug' => $slug], navigate: true);
        }
        if (!in_array($this->limit, $this->limitList)) {
            $this->redirectRoute('category', ['slug' => $slug], navigate: true);
        }
    }

    public function render()
    {
        $category = Category::query()
            ->where('slug', '=', $this->slug)
            ->firstOrFail();
        $ids = \App\Helpers\Category\Category::getIds($category->id) . $category->id;

        if (isnull($this->minPrice) || isNull($this->maxPrice)) {
            $minMaxprice = DB::table('products')
                ->select(DB::raw('MIN(price) as min_price, MAX(price) as max_price'))
                ->whereIn('category_id', explode(',', $ids))
                ->get();
            $this->minPrice = $this->minPrice ?? $minMaxprice[0]->min_price;
            $this->maxPrice = $this->maxPrice ?? $minMaxprice[0]->max_price;
        }

        $categoryFilters = DB::table('category_filters')
            ->select('category_filters.filter_group_id', 'filter_groups.title', 'filters.id as filter_id',
            'filters.title as filter_title')
            ->join('filter_groups', 'category_filters.filter_group_id', '=',
                'filter_groups.id')
            ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
            ->whereIn('category_filters.category_id', explode(',', $ids))
//            ->groupBy('filters.id')
            ->get();
        $filterGroups = [];
        foreach ($categoryFilters as $filter) {
            $filterGroups[$filter->filter_group_id][] = $filter;
        }

        if($this->selectedFilters){
            $cntFilterGroups = DB::table('filters')
            ->select(DB::raw('count(distinct filter_group_id) as cnt'))
            ->whereIn('id', $this->selectedFilters)
            ->value('cnt');
        }else{
            $cntFilterGroups = 1;
        }

        $products = Product::query()
            ->whereIn('category_id', explode(',', $ids))
            ->when($this->selectedFilters, function (Builder $query) use ($cntFilterGroups){
                $query->leftJoin(DB::raw('filter_products FORCE INDEX FOR JOIN (filter_id)'),
                'filter_products.product_id', '=', 'products.id')
                ->whereIn('filter_products.filter_id', $this->selectedFilters)
                ->groupBy('id')
                ->havingRaw("count(distinct filter_products.filter_group_id) >= $cntFilterGroups" );
            })
            ->whereBetween('price', [$this->minPrice, $this->maxPrice])
            ->orderBy($this->sortList[$this->sort]['order_field'], $this->sortList[$this->sort]['order_direction'])
            ->paginate($this->limit);
        if (request()->query('page') > $products->lastPage()) {
            abort(404);
        }

        $breadcrumbs = \App\Helpers\Category\Category::getBreadcrumbs($category->id);
        return view('livewire.product.category-component', [
            'category' => $category,
            'products' => $products,
            'breadcrumbs' => $breadcrumbs,
            'filter_groups' => $filterGroups,
            'title' => "Category - {$category->title}",
        ]);

    }

    public function updated($property)
    {
        $property = explode('.', $property);
        if (in_array($property[0], ['selectedFilters', 'minPrice', 'maxPrice'])) {
            $this->resetPage();
        }
    }


    public function changeSort()
    {
        $this->sort = isset($this->sortList[$this->sort]) ? $this->sort : 'default';
    }

    public function changeLimit()
    {
        $this->limit = in_array($this->limit, $this->limitList) ? $this->limit : 3;
        $this->resetPage();
    }

    public function removeFilter($filter_group_id)
    {
        if (false !== ($key = array_search($filter_group_id, $this->selectedFilters))) {
            unset($this->selectedFilters[$key]);
            $this->selectedFilters = array_values($this->selectedFilters);
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->selectedFilters = [];
        $this->resetPage();
    }

}
