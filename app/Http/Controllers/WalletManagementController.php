<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

class WalletManagementController extends Controller
{
    public function index()
    {
        $wallets = Wallet::where('current_balance', '>', 0)->get();
        return view('wallet', compact('wallets'));
    }
}
