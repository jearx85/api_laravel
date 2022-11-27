<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

   /*  public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login', 'store']]);
    } */

    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $tipo = $request->tipo;
        $password = $request->password;

        if(!$name){
            return response()->json([
                'message' => 'Nombre vacio'
            ]);
        }else if(!$email){
            return response()->json([
                'message' => 'email vacio'
            ]);
        }else if(!$password){
            return response()->json([
                'message' => 'password vacio'
            ]);
        }else if(!$tipo){
            return response()->json([
                'message' => 'tipo de usuario vacio'
            ]);
        }
        $data = [$name, $email, $tipo, Hash::make($password)];

        $jwt = JWT::encode($data, env('JWT_SECRET'), 'HS256');

        User::create($request->all());
        return response()->json([
            'message' => 'Usuario creado con exito',
            'usuario' => $data,
            'token' => $jwt
        ]);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $jwt = JWT::encode($credentials, env('JWT_SECRET'), 'HS256');
        try {

            if(!$jwt){
                return response()->json([
                    'error' => 'Invalid credentials',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'not create token'
            ],500);
        }
        return response()->json(compact('jwt'));
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
            //'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }






    public function getAll(){
        $user = User::all()->toArray();

        if($user == null){
            return response()->json([
                 'message' => 'no hay usuarios'
            ]);
        }
        return response()->json([
            'usuarios' => $user
        ]);
    }

    public function getById($id){

        if(!User::find($id)){
            return response()->json([
                'message' => 'No user found',
                'status'=> 404
            ]);

        }
        $user = User::find($id)->toArray();
        return response()->json($user, 200);
    }




    public function update(Request $request, $id)
    {
        $user = User::all()->toArray();
        if(!User::find($id)){
            return response()->json([
                 'message' => 'no hay usuarios con ese id'
            ]);
        }
       User::find($id)->update($request->all());
       return response()->json([
           'message' => 'Update Success'
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
        if(!User::find($id)){
            return response()->json([
                 'message' => 'usuario no encontrado'
            ]);
        }
        User::destroy($id);
        return response()->json([
            'message' => 'usuario eliminado'
        ]);
    }
}
