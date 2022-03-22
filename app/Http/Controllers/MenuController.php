<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $menu = Menu::with(['category'])->get();
        return response()->json([
            'message' => 'data menu',
            'data_menu' => $menu
        ], 200);
    }

    public function addMenu(Request $request)
    {
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->id_category = $request->id_category;
        $menu->price = $request->price;
        // dd($menu);
        $menu->save();
        return response()->json([
            'message' => 'success',
            'data_menu' => $menu
        ], 201);
    }

    public function editMenu(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->id_category = $request->id_category;
        $menu->price = $request->price;
        // dd($menu);
        $menu->save();
        return response()->json([
            'message' => 'edit menu success',
            'data_menu' => $menu
        ], 201);
    }

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json([
            'message' => 'delete menu success',
            'data_menu' => $menu
        ], 201);
    }

    public function countMenu()
    {
        $menu = Menu::all()->count();
        return response()->json([
            'total_menu' => $menu
        ]);
    }
    //
}
