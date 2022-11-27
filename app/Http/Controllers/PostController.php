<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(){
        $post = post::all()->toArray();

        if($post == null){
            return response()->json([
                 'message' => 'no hay posts'
            ]);
        }

        return response()->json([
            "code" => 200,
            "status" => 'true',
            "data" => $post
        ]);
    }

    public function getById($id){
        $post = Post::find($id)->toArray();

        if(!$post){
            return response()->json([
                'message' => 'No post found',
                404
            ]);

        }
        return response()->json($post, 200);

    }

    public function store(Request $request)
    {

        $title = $request->title;
        $content = $request->content;
        $category_id = Category::all();

        if($title == null){
            return response()->json([
                'message' => 'Titulo vacio'
            ]);
        }else if($content == null){
            return response()->json([
                'message' => 'Contenido vacio'
            ]);
        }

        post::create($request->all());
        return response()->json([
            'message' => 'Post creado con exito'
        ]);
    }


    public function update(Request $request, $id)
    {
        post::find($id)->update($request->all());
        return response()->json([
            'message' => 'Post updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json([
            'message' => 'Deleted success'
        ]);
    }
}