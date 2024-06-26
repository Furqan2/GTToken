<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GlobalToadTokenService;

class TokenController extends Controller
{
    protected $tokenService;

    public function __construct(GlobalToadTokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function getBalance(Request $request)
    {
        $address = $request->input('address');
        $balance = $this->tokenService->getBalance($address);

        return response()->json(['balance' => $balance]);
    }
}
