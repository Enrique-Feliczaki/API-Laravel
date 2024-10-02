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
        $request->validate([
            'explorador_id_1' => 'required|exists:exploradores,id',
            'explorador_id_2' => 'required|exists:exploradores,id',
            'itens_explorador_1' => 'required|array',
            'itens_explorador_2' => 'required|array',
        ]);

        $explorador1 = Explorador::findOrFail($request->explorador_id_1);
        $explorador2 = Explorador::findOrFail($request->explorador_id_2);

        $valorTotal1 = Item::whereIn('id', $request->itens_explorador_1)->sum('valor');

        $valorTotal2 = Item::whereIn('id', $request->itens_explorador_2)->sum('valor');

        if ($valorTotal1 !== $valorTotal2) {
            return response()->json(['message' => 'Os valores dos itens não são equivalentes'], 400);
        }

        Item::whereIn('id', $request->itens_explorador_1)->update(['explorador_id' => $explorador2->id]);
        Item::whereIn('id', $request->itens_explorador_2)->update(['explorador_id' => $explorador1->id]);

        return response()->json(['message' => 'Troca realizada com sucesso']);
    }



    public function show($id)
    {
        $explorador = Explorador::with('itens')->findOrFail($id);
        return response()->json($explorador);
    }
}
