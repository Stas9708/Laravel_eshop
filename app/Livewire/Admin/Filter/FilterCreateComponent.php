<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filter;
use App\Models\FilterGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Create filter')]
class FilterCreateComponent extends Component
{
    public $title;
    public $filter_group_id;

    public function render()
    {
        $filterGroups = FilterGroup::all();
        return view('livewire.admin.filter.filter-create-component', compact('filterGroups'));
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'filter_group_id' => 'required|exists:filter_groups,id',
        ]);

        Filter::query()
            ->create($validated);
        session()->flash('success', 'Filter created successfully.');
        $this->redirectRoute('admin.filters.index', navigate: true);
    }
}
