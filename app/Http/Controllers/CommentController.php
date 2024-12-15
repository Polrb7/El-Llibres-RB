<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Mètode per mostrar el formulari de creació del comentari
    public function create(Review $review)
    {
        return view('comments.create', compact('review'));
    }

    // Mètode per emmagatzemar el comentari
    public function store(Request $request, Review $review)
    {
        // Validar les dades del formulari
        $request->validate([
            'comment' => 'required|string|max:1000', // Ajusta les regles de validació segons les teves necessitats
        ]);

        // Crear un nou comentari
        $comment = new Comment();
        $comment->comment = $request->input('comment'); // Assignar el text del comentari
        $comment->review_id = $review->id; // Associar el comentari amb la ressenya
        $comment->user_id = Auth::id(); // Associar el comentari amb l'usuari autenticat
        $comment->save(); // Desar el comentari a la base de dades

        // Redirigir a la pàgina de la ressenya amb un missatge de confirmació
        return redirect()->route('view.book', $review->book_id)->with('success', __('Comment added successfully!'));
    }
}
