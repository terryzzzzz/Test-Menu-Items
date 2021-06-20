<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    private $importArr;

    public function __construct()
    {
        $this->importArr = array();
    }

    public function hello()
    {
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

        return view('index');
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
