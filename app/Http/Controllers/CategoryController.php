<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];
    public static $rules = [
        'name' => 'required|string',
    ];

    public function index()
    {
        return new CategoryCollection(Category::paginate(10));
    }

    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category), 200);
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('create',$user);

        $request->validate(self::$rules, self::$messages);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        /*$this->authorize('update',$category);

        $request->validate(self::$rules, self::$messages);
        $category->update($request->all());
        return response()->json($category, 200);*/
    }

    public function delete(Request $request, Category $category)
    {
        //$this->authorize('delete',$category);

        //$category->delete();
        //return response()->json(null, 204);
    }
}
