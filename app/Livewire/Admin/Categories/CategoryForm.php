<?php

namespace App\Livewire\Admin\Categories;

use Illuminate\View\View;
use Livewire\Component;

class CategoryForm extends Component
{
    public function render() : View
    {
        return view('livewire.admin.categories.category-form');
    }
}
