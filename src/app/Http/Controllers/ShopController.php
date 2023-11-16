<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function show()
    {
        $shops = Shop::all();

        return view('shop_all', compact('shops'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with('region')->regionSearch($request->region)->genreSearch($request->genre)->keywordSearch($request->keyword)->get();
        
        return view('shop_all', compact('shops'));
    }
}
