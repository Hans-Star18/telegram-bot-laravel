<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Token;
use App\Models\Drawbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = Token::all();

        return view('tokens.index', compact('tokens'));
    }

    public function add()
    {
        $boxs = Drawbox::all();

        return view('tokens.add', compact('boxs'));
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'token' => 'required',
            'chance' => 'required|numeric',
            'drawbox_id' => 'required',
        ]);

        Token::create($validData);

        return redirect()->back()->with('success', 'Token added successfully');
    }

    public function edit(Token $token)
    {
        $boxs = Drawbox::all();

        return view('tokens.edit', compact('token', 'boxs'));
    }

    public function update(Request $request, Token $token)
    {
        $validData = $request->validate([
            'token' => 'required',
            'chance' => 'required|numeric',
            'drawbox_id' => 'required',
        ]);

        $token->update($validData);

        if ($token->chance > $token->used) {
            $token->is_claimed = 0;
            $token->save();
        }

        return redirect()->back()->with('success', 'Token updated successfully');
    }

    public function destroy(Token $token)
    {
        $token->delete();

        return redirect()->back()->with('success', 'Token deleted successfully');
    }
}
