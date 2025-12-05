<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    public function __invoke()
    {
        return view('admin.category');
    }
}
