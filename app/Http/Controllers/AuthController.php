<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request){
        //dd($request->request->all()); 
        try{
            $validator = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'cpf' => 'required|string|max:50',
                'idade' => 'required|integer'
            ]);
    
            $errors = null;
                $dados = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'cpf' => $request->cpf,
                    'idade' => $request->idade,
                ];
               // dd($dados);
                $user = User::create($dados);
    
                $retorno = [
                    'status' => true,
                    'message' => 'User created successfully',
                    'user' => $user,
                    ];
                    return response()->json($retorno);
    
             
        } catch(\Exception $e)
        
         {

            $retorno = [
                'status' => false,
                'message' => 'erro ao cadastrar usuario',
                'user' => null,
                "error" => $e -> getMessage(),
                ];
                return response()->json($retorno);
         }
     
         // Retrieve errors message bag
         

        
        return response()->json($retorno);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}