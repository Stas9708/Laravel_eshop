<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Filters')]
class FilterIndexComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $filters = Filter::query()
            ->with('group')
            ->paginate();
        return view('livewire.admin.filter.filter-index-component', compact('filters'));
    }

    public function deleteFilter(Filter $filter)
    {
        $title = $filter->title;
        try {
            DB::beginTransaction();
            DB::table('filter_products')
                ->where('filter_id', '=', $filter->id)
                ->delete();
            $filter->delete();
            DB::commit();
            $this->js("toastr.success('Filter - $title deleted successfully!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting filter!')");
        }
    }
}
