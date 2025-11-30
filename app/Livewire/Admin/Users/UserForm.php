<?php

namespace App\Livewire\Admin\Users;

use Illuminate\View\View;
use Livewire\Component;

class UserForm extends Component
{

    public function mount()
    {

    }

    public function render() : View
    {
        return view('livewire.admin.users.user-form');
    }
}
