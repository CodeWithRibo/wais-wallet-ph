<?php

namespace App\Livewire\Admin\Users;

use Illuminate\View\View;
use Livewire\Component;

class UserManagement extends Component
{
    public function render() : View
    {
        return view('livewire.admin.users.user-management');
    }
}
