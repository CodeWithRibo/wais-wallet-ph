<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminWalletController extends Controller
{
    public function __invoke()
    {
        return view('admin.wallets');
    }
}
