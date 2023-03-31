<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\BoxItem;
use App\Models\Drawbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = BoxItem::all();

        return view('items.index', compact('items'));
    }

    public function add()
    {
        $boxs = Drawbox::all();
        return view('items.add', compact('boxs'));
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'drawbox_id' => 'required',
            'item' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = 'assets/images';
        $image = $request->file('image');
        $imageName = rand() . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);
        $validData['image'] = $path . '/' . $imageName;

        BoxItem::create($validData);

        return redirect()->back()->with('success', 'Item added successfully');
    }

    public function edit(BoxItem $boxItem)
    {
        $boxs = Drawbox::all();
        return view('items.edit', compact('boxItem', 'boxs'));
    }

    public function update(Request $request, BoxItem $boxItem)
    {
        $validData = $request->validate([
            'drawbox_id' => 'required',
            'item' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = 'assets/images';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (file_exists($boxItem->image)) {
                unlink($boxItem->image);
            }

            $imageName = rand() . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            $validData['image'] = $path . '/' . $imageName;
        }

        $boxItem->update($validData);

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function destroy(BoxItem $boxItem)
    {
        if (file_exists($boxItem->image)) {
            unlink($boxItem->image);
        }
        $boxItem->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }
}
