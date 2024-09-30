<?php

namespace App\Http\Controllers;

use App\Models\Explorador;
use App\Models\Item;
use Illuminate\Http\Request;

class ExploradorController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'idade' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $explorador = Explorador::create($request->all());
        return response()->json($explorador, 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $explorador = Explorador::findOrFail($id);
        $explorador->update($request->only(['latitude', 'longitude']));
        return response()->json($explorador);
    }


    public function addItem(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string',
            'valor' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $item = new Item($request->all());
        $item->explorador_id = $id;
        $item->save();

        return response()->json($item, 201);
    }


    public function trocarItens(Request $request)
    {

    }


    public function show($id)
    {
        $explorador = Explorador::with('itens')->findOrFail($id);
        return response()->json($explorador);
    }
}
