<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);

        if (!$user) {
            // Trate o caso de o usuário não ser encontrado
        }

        // Passe o usuário para a view da página de perfil
        return view('perfil', ['user' => $user]);
    }

    public function atualizarPerfil(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'telefone' => 'nullable|string',
            'genero' => 'nullable|string',
            'esporteFav' => 'nullable|string',
            'estado' => 'nullable|string',
            'cidade' => 'nullable|string',
            'bairro' => 'nullable|string',
            'rua' => 'nullable|string',
        ]);

        $userId = $request->input('user_id');

        // Encontre o usuário com base no ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não encontrado',
            ], 404);
        }

        $perfil = Perfil::where('user_id', $userId)->first();

        if (!$perfil) {
            $perfil = new Perfil();
            $perfil->user_id = $userId;
        }

        $perfil->telefone = $request->input('telefone');
        $perfil->genero = $request->input('genero');
        $perfil->esporteFav = $request->input('esporteFav');
        $perfil->estado = $request->input('estado');
        $perfil->cidade = $request->input('cidade');
        $perfil->bairro = $request->input('bairro');
        $perfil->rua = $request->input('rua');

        $perfil->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil atualizado com sucesso',
            'perfil' => $perfil,
        ]);
    }
}
