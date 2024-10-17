<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crochet;

class CrochetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $crochets = Crochet::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('name', 'ASC')->SimplePaginate(5);
        return view('crochet.storedata', compact('crochets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('crochet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:2|max:15',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $proses = Crochet::create([
            'type'=> $request->type,
            'name'=> $request->name,
            'price'=> $request->price,
            'stock'=> $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('crochets')->with('success', 'Data has been added!');
        } else {
            return redirect()->route('crochets.add')->with('failed', 'Data added failed');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $crochet = Crochet::where('id', $id)->first();
        return view('crochet.edit', compact('crochet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:2|max:15',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $crochetBefore = Crochet::where('id', $id)->first();

        $proses = $crochetBefore->update([
            'type'=> $request->type,
            'name'=> $request->name,
            'price'=> $request->price,
            'stock'=> $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('crochets')->with('success', 'Data has been successfully changed');
        } else {
            return redirect()->route('crochets.edit')->with('failed', 'Failed to change data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = Crochet::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Item data has been successfully deleted!');
        } else {
            return redirect()->back()->with('failed', 'item data failed to delete');
        }
    }
}
