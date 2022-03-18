<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'message' => 'data category',
            'data_category' => $category
        ], 200);
    }

    public function addCategory(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        // dd($category);
        $category->save();
        return response()->json([
            'message' => 'success',
            'data_menu' => $category
        ], 201);
    }

    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        return response()->json([
            'message' => 'edit category success',
            'data_menu' => $category
        ], 201);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'message' => 'delete category success',
        ], 201);
    }

    //
}
