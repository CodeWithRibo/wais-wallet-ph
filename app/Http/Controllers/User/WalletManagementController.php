<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller;

class WalletManagementController extends Controller
{
    public function __invoke()
    {
        return view('user.wallet');
    }
}
