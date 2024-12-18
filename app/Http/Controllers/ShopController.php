<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $items = ShopItem::all();
        return view('registered.shop', compact('items'));
    }
}
