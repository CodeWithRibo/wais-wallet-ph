<?php

namespace App\Http\Controllers;

class CategoriesController extends Controller
{
    public function __invoke()
    {
        return view('categories');
    }
}
