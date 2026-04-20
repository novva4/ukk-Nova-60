<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function userCatalog()
    {
        $books = Book::where('stock', '>', 0)->paginate(10);
        return view('user.books.index', compact('books'));
    }

    public function userHistory()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with('book')->orderBy('created_at', 'desc')->get();
        return view('user.transactions.history', compact('transactions'));
    }

    public function borrow(Request $request, Book $book)
    {
        $activeBorrows = Transaction::where('user_id', Auth::id())
                                    ->where('status', 'borrowed')
                                    ->count();
        if ($activeBorrows >= 3) {
            return back()->with('error', 'Anda telah mencapai batas maksimal peminjaman (3 buku).');
        }

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_date' => now()->addDays(7),
            'status' => 'borrowed'
        ]);

        $book->decrement('stock');

        return redirect()->route('user.transactions.history')->with('success', 'Berhasil meminjam buku!');
    }

    public function adminIndex()
    {
        $transactions = Transaction::with(['user', 'book'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function returnBook(Transaction $transaction)
    {
        if ($transaction->status !== 'borrowed') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        $isLate = now() > $transaction->return_date;
        $status = $isLate ? 'late' : 'returned';
        
        $transaction->update([
            'status' => $status
        ]);

        $transaction->book()->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan' . ($isLate ? ' (Terlambat)' : '') . '.');
    }
}