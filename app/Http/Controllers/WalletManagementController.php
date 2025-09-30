<?php

namespace App\Http\Controllers;

class WalletManagementController extends Controller
{
    public function __invoke()
    {
        return view('wallet');
    }
}
