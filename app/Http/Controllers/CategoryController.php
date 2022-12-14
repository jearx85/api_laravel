<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\post;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CategoryController extends Controller
{

    public function getAll(){
        $categories = Category::all()->toArray();
        if($categories == null){
            return response()->json([
                 'message' => 'no hay categorias'
            ]);
        }
        return response()->json([
            "code" => 200,
            "status" => 'true',
            "data" => $categories
        ]);
    }

    public function store(Request $request){
        //$name = $request->name;
        //$description = $request->description;
//
        //if(!$name){
        //    return response()->json([
        //        'message' => 'Nombre vacio'
        //    ]);
        //}
        //$data = [$name, $description];
//
        ////$data = $request->name->toArray();
        //$jwt = JWT::encode($data, env('JWT_SECRET'), 'HS256');

        category::create($request->all());
        return response()->json([
            'message' => 'Categoria creada con exito',
            'code' => 200,
            'status' => 'true',
            'data' => ''
        ]);

    }

    public function update(Request $request, $id){
        $category = category::all()->toArray();
        if($category == null){
            return response()->json([
                 'message' => 'no hay categorias'
            ]);
        }

        category::find($id)->update($request->all());
        return response()->json([
            'message' => 'Update success',
            'data'=> $category
        ]);
    }

    public function  destroy($id){

        if(!Category::find($id)){
            return response()->json([
                 'message' => 'categoria no encontrada'
            ]);
        }
        $category = Category::find($id);
        $category->delete();
        $categories = Category::all()->toArray();
        Category::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $categories
            ]
        );
    }

    public function edit($id){

        if(!category::find($id)){
            return response()->json([
                'message' => 'no hay categorias con ese id',
                'status'=> 404
            ]);
        }
        $category = category::find($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $category
            ]);
    }
}
