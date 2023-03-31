<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Drawbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoxController extends Controller
{
    public function index()
    {
        $boxs = Drawbox::all();

        return view('boxs.index', compact('boxs'));
    }
}
