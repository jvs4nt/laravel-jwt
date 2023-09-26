<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function recuperar(User $id)
    {
        return response()->json($id);
    }

    public function listar()
    {
        return null;
    }

    public function editar(Request $request,$id)
    {
       $usuario = User::find($id);
       
       $usuario -> name = $request -> get("name");
       $usuario -> email = $request -> get("email");
       $usuario -> genero = $request -> get("genero");
       $usuario -> cpf = $request -> get("cpf");
       $usuario -> birthdate = $request -> get("data");
       $usuario -> telefone = $request -> get("telefone");
       $usuario -> estado = $request -> get("estado");
       $usuario -> cidade = $request -> get("cidade");
       $usuario -> bairro = $request -> get("bairro");
       $usuario -> rua = $request -> get("rua");

       $usuario -> save();
       
       return response()->json($usuario);
    }

    public function cadastrar(Request $request)
    {
       $usuario = new User();
       
       $usuario -> name = $request -> get("name");
       $usuario -> genero = $request -> get("sexo");
       $usuario -> save();
       
       return response()->json($usuario);
    }
}
