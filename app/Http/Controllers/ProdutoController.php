<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Exibe todos os produto.
     */
    public function index()
    {
        return response()->json(Produto::all());  // Retorna todos os itens do banco
    }

    /**
     * Exibe o formulário de criação de um produto.
     */
    public function create()
    {
        return response()->json('Formulário de criação de item Geek');
    }

    /**
     * Armazena um novo produto no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
        ]);

        $item = Produto::create([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
        ]);

        return response()->json($item, 201);  // Retorna o item criado
    }

    /**
     * Exibe um produto específico.
     */
    public function show(string $id)
    {
        $item = Produto::find($id);
        if (!$item) return response()->json(['message' => 'Item não encontrado'], 404);
        return response()->json($item);
    }

    /**
     * Exibe o formulário de edição de um produto.
     */
    public function edit(string $id)
    {
        return response()->json('Formulário de edição de item Geek');
    }

    /**
     * Atualiza um produto no banco.
     */
    public function update(Request $request, string $id)
    {
        $item = Produto::find($id);
        if (!$item) return response()->json(['message' => 'Item não encontrado'], 404);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|string|max:100',
        ]);

        $item->update([
            'nome' => $request->nome ?? $item->nome,
            'tipo' => $request->tipo ?? $item->tipo,
        ]);

        return response()->json($item);
    }

    /**
     * Remove um produto do banco.
     */
    public function destroy(string $id)
    {
        $item = Produto::find($id);
        if (!$item) return response()->json(['message' => 'Item não encontrado'], 404);

        $item->delete();
        return response()->json(['message' => 'Item deletado com sucesso']);
    }
}
