<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id)
    {
        $book = Book::with('user')->findOrFail($id);
        return view('reviews.create', compact('book'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:2048',
            'valoration' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'title' => $request->title,
            'text' => $request->text,
            'valoration' => $request->valoration,
        ]);

        return redirect()->route('view.book', $id)->with('success', 'Review added successfully.');
    }

    public function details($id)
    {
        // Carreguem la review amb els seus comentaris i els usuaris que els han creat
        $review = Review::with(['user', 'comments.user'])->findOrFail($id);

        // Retornem la vista amb la review i els seus comentaris
        return view('reviews.details', compact('review'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Comprovar si l'usuari autenticat és el propietari de la ressenya
        if ($review->user_id !== Auth::id()) {
            return redirect()->route('view.book', $review->book_id)->with('error', 'No tens permís per eliminar aquesta ressenya.');
        }

        $review->delete();

        return redirect()->route('view.book', $review->book_id)->with('success', 'Ressenya eliminada correctament.');
    }
}
