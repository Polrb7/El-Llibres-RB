<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $query = Book::with('user');
        $books = $query->get();
        return view('admin.dashboard', compact('books'));
    }

    public function viewUsers()
    {
        $users = User::all();

        return view('admin.viewUsers', compact('users'));
    }

    public function viewBooks()
    {
        $books = Book::all();

        return view('admin.viewBooks', compact('books'));
    }

    public function viewReviews()
    {
        $reviews = Review::all();

        return view('admin.viewReviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('admin.viewReviews')->with('success', __('Review deleted successfully.'));
    }
}
