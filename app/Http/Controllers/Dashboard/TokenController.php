<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = Token::all();

        return view('tokens.index', compact('tokens'));
    }
}
