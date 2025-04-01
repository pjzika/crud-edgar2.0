<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function create()
    {
        return response()->json('Exibição de formulário de criação de resenha');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'comentario' => 'required|string',
            'nota' => 'required|numeric|min:1|max:5',
        ]);

        $review = new Review;
        $review->titulo = $request->titulo;
        $review->comentario = $request->comentario;
        $review->nota = $request->nota;
        $review->save();

        return response()->json($review, 201);
    }

    public function show(string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Resenha não encontrada'], 404);
        }

        return response()->json($review);
    }

    public function edit(string $id)
    {
        return response()->json('Exibição de formulário de edição de resenha');
    }

    public function update(Request $request, string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Resenha não encontrada'], 404);
        }

        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'comentario' => 'sometimes|required|string',
            'nota' => 'sometimes|required|numeric|min:1|max:5',
        ]);

        $review->titulo = $request->titulo ?? $review->titulo;
        $review->comentario = $request->comentario ?? $review->comentario;
        $review->nota = $request->nota ?? $review->nota;
        $review->save();

        return response()->json($review);
    }

    public function destroy(string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Resenha não encontrada'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Resenha deletada com sucesso']);
    }
}
