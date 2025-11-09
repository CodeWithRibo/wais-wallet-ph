<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Livewire\Actions\Logout;

class LogoutController extends Controller
{
    public function __invoke(Logout $logout)
    {
        $logout();

        return redirect()->route('welcome');
    }
}
