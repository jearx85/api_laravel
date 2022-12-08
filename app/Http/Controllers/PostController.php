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
    public function all(){
        $posts = post::all()->toArray();

       // if($posts == null){
       //     return response()->json([
       //          'message' => 'no hay posts'
       //     ]);
       // }

        return response()->json([
            "code" => 200,
            "status" => 'true',
            "data" => $posts
        ]);
    }

    public function edit($id){
        if(Post::find($id) == null){
            return response()->json([
                'message' => 'No post found',
                404
            ]);
        }
        $post = Post::find($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $post
            ]
        );

    }

    public function store(Request $request)
    {

        //$title = $request->title;
        //$content = $request->content;
        ////$category_id = Category::all();
//
        //if($title == null){
        //    return response()->json([
        //        'message' => 'Titulo vacio'
        //    ]);
        //}else if($content == null){
        //    return response()->json([
        //        'message' => 'Contenido vacio'
        //    ]);
        //}

        post::create($request->all());
        return response()->json([
            'message' => 'Post creado con exito',
            'code' => 200,
            'status' => 'true',
            'data' => ''
        ]);
    }


    public function update(Request $request, $id)
    {
        $post = post::all()->toArray();
        if(!post::find($id)){
            return response()->json([
                 'message' => 'no hay post con ese id'
            ]);
        }

        post::find($id)->update($request->all());
        return response()->json([
            'message' => 'Post updated',
            'code' => 200,
            'status' => 'true',
            'data' => ''
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
        $post = Post::find($id);
        $post->delete();
        $posts = Post::all()->toArray();
        Post::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $posts
            ]
        );
    }
}
