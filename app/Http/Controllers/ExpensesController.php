<?php

namespace App\Http\Controllers;

class ExpensesController extends Controller
{
    public function __invoke()
    {
        return view ('expenses');
    }
}
