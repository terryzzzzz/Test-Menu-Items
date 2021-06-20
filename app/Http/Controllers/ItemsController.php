<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use Illuminate\Support\Facades\Http;

class ItemsController extends Controller
{
    private $importArr;

    public function __construct()
    {
        $this->importArr = array();
    }

    public function requestData()
    {
        Items::truncate();
        $response = Http::get('https://dev.shepherd.appoly.io/fruit.json');
        $menuItems = $response['menu_items'];
        $this->decodeNestedArray(null, $menuItems);
        foreach ($this->importArr as $newItem) {
            $item = new Items;
            $item->label = $newItem->label;
            if (isset($newItem->parent)) {
                $parentId = Items::select('id')->where('label', $newItem->parent)->get();
                $item->item_id = $parentId[0]->id;
            }
            $item->save();
        }

        $itemsArr = $this->getItems();
        return view('index', compact('itemsArr'));
    }

    public function getItems()
    {
        $items = Items::whereNull('item_id')
            ->with('childItems')
            ->orderby('label', 'asc')
            ->get();
        return view('index', compact('items'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $label = $request->label;
        $item = Items::find($id);
        $item->label = $label;
        $item->save();
        return response('success', 200);
    }

    public function decodeNestedArray($parent, $array)
    {
        foreach ($array as $object) {
            $item = (object)[];
            $item->label = $object['label'];
            $item->parent = $parent;
            array_push($this->importArr, $item);
            if (count($object['children']) > 0) {
                $this->decodeNestedArray($object['label'], $object['children']);
            }
        }
    }
}
