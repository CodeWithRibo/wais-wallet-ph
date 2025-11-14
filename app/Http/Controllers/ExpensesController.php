<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ExpensesController extends Controller
{
    public function __invoke()
    {
        return view ('user.expenses');
    }
}
