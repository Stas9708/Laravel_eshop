<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Create Filter Group')]
class FilterGroupCreateComponent extends Component
{
    public $title;


    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|unique:filter_groups,title|max:255',
        ]);
        FilterGroup::create($validated);
        session()->flash('success', 'Filter group created successfully.');
        $this->redirectRoute('admin.filter-groups.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.filter-groups.filter-group-create-component');
    }
}
