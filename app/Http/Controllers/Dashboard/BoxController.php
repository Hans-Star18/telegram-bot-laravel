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

    public function show(Drawbox $drawbox)
    {
        return view('boxs.show', compact('drawbox'));
    }

    public function add()
    {
        return view('boxs.add');
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'box' => 'required'
        ]);

        Drawbox::create($validData);

        return redirect()->back()->with('success', 'Box added successfully');
    }

    public function edit(Drawbox $drawbox)
    {
        return view('boxs.edit', compact('drawbox'));
    }

    public function update(Request $request, Drawbox $drawbox)
    {
        $validData = $request->validate([
            'box' => 'required'
        ]);

        $drawbox->update($validData);

        return redirect()->back()->with('success', 'Box updated successfully');
    }

    public function destroy(Drawbox $drawbox)
    {
        foreach ($drawbox->boxItems as $item) {
            $file_path = public_path($item->image);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $drawbox->boxItems()->delete();
        $drawbox->delete();

        return redirect()->back()->with('success', 'Drawbox deleted successfully');
    }
}
