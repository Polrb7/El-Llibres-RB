<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        return view('books.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:150',
            'genre' => 'required|string|max:150',
            'description' => 'required|string|max:2048',
            'book_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'book_img' => $request->file('book_img')->store('images', 'public')
        ]);
        return redirect()->back()->with('success', 'Book uploaded successfully');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if ($book->user_id === Auth::id() || Auth::user()->admin) {
            $book->delete();
        } else {
            return redirect()->back()->with('error', 'You are not the owner of this book');
        }

        return redirect()->back();
    }

    public function myBooks()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return view('books.mybooks', compact('books'));
    }

    public function allBooks(Request $request)
    {
        $query = Book::with('user');

        // Filtre per títol o autor
        if ($request->filled('title_or_author')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->input('title_or_author') . '%')
                    ->orWhere('author', 'like', '%' . $request->input('title_or_author') . '%');
            });
        }

        // Filtre per gènere
        if ($request->filled('genre')) {
            $query->where('genre', $request->input('genre'));
        }

        // Obtenir els llibres filtrats
        $books = $query->get();

        // Obtenir gèneres únics per al filtre de gènere
        $genres = Book::select('genre')->distinct()->pluck('genre');

        return view('users.dashboard', compact('books', 'genres'));
    }

    public function details($id)
    {
        $book = Book::with(['user', 'reviews.user'])->findOrFail($id);
        return view('books.book', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->genre = $request->input('genre');
        $book->save();

        return redirect()->route('view.mybooks')->with('success', __('Book updated successfully.'));
    }
}
