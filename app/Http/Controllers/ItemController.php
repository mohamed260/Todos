<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(){
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request){
        $item = new Item;

        $item->name = $request->item['name'];
        $item->save();

        return $item;
    }

    public function update(Request $request, $id){
        $item = Item::find($id);
        $item->completed = $request->item['completed'] ? true : false;
        $item->completed_at = $request->item['completd'] ? Carbon::now() : null;
        $item->save();

        return $item;
    }

    public function destroy($id){
        $item = Item::find($id);

        $item->delete();

        return "deleted successfuly!";
    }
}
