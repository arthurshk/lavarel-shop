<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name ? $request->name : "";
        $category->img = $request->img ? $request->img : "";
        $category->save();
        return response()->json([
            'success' => 'Category created successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if(!empty($category)){
            return response()->json($category,200);
        }
        else {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if(!empty($category)){
            $category->name = is_null($request->name) ? $request->name : $category->name;
            $category->img = $request->img ? $request->img : $category->img;
            $category->save();
            return response()->json([
                'success' => 'Category updated successfully'
            ],200);
          }  else {
                return response()->json([
                    'error' => 'Category not found',
                ], 404);
            }
        }
        public function destroy(string $id)
        {
            if(Category::where('id', $id)->exists()){
                $category = Category::find($id);
                $category->delete();
                return response()->json([
                    'success' => 'Category deleted successfully'
                ],200);
              }  else {
                    return response()->json([
                        'error' => 'Category not found',
                    ], 404);
                }
        }
    
    }

