<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\BoxItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = BoxItem::all();

        return view('items.index', compact('items'));
    }
}
