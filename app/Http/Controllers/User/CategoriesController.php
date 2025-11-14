<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __invoke()
    {
        return view('user.categories');
    }
}
