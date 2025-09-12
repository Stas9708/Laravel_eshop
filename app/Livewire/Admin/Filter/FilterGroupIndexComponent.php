<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Filter Groups ')]
class FilterGroupIndexComponent extends Component
{
    public function render()
    {
        $filterGroups = FilterGroup::all();
        return view('livewire.admin.filter-groups.filter-group-index-component', compact('filterGroups'));
    }

    public function deleteFilterGroup(FilterGroup $filterGroup)
    {
        $title = $filterGroup->title;
        try {
            DB::beginTransaction();
            DB::table('filter_products')
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();
            DB::table('category_filters')
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();
            Filter::query()
                ->where('filter_group_id', '=', $filterGroup->id)
                ->delete();
            $filterGroup->delete();
            DB::commit();
            $this->js("toastr.success('$title deleted successfully!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting filter group!')");
        }
    }
}
