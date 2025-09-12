<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Filter Group')]
class FilterGroupEditComponent extends Component
{
    public FilterGroup $filterGroup;
    public $title;


    public function mount(FilterGroup $filterGroup)
    {
        $this->title = $filterGroup->title;
    }

    public function save()
    {
        $validated = $this->validate(
            ['title' => 'required|unique:filter_groups,title|max:255'],
        );
        $this->filterGroup->update($validated);
        session()->flash('success', 'Filter group updated successfully.');
        $this->redirectRoute('admin.filter-groups.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.filter-groups.filter-group-edit-component');
    }
}
