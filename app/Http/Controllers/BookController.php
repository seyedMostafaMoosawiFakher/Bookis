<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

//| POST      | admin/books             | admin.books.store   | App\Http\Controllers\BookController@store   | w
//| GET|HEAD  | admin/books             | admin.books.index   | App\Http\Controllers\BookController@index   | w
//| GET|HEAD  | admin/books/create      | admin.books.create  | App\Http\Controllers\BookController@create  | w
//| DELETE    | admin/books/{book}      | admin.books.destroy | App\Http\Controllers\BookController@destroy | w
//| PUT|PATCH | admin/books/{book}      | admin.books.update  | App\Http\Controllers\BookController@update  | w
//| GET|HEAD  | admin/books/{book}      | admin.books.show    | App\Http\Controllers\BookController@show    | w
//| GET|HEAD  | admin/books/{book}/edit | admin.books.edit    | App\Http\Controllers\BookController@edit    | w

class BookController extends Controller
{
    public function index()
    {
        $data['books'] = Book::all();

        return view('admin.book.index', compact('data'));
    }

    public function create()
    {
        return view('admin.book.create');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => 'required|string',
//            'subject' => 'required|string',
//            'language' => 'required|string',
//            'description' => 'string|max:2000'
          ]);

        Book::create($attributes);

        return redirect()->action([self::class, 'index'])->with(['success' => 'کتاب جدید با موفقیت ایجاد شد']);
    }

    public function show(Book $book)
    {
        $data['book'] = $book;

        return view('admin.book.show', compact('data'));
    }

    public function edit(Book $book)
    {
        $data['book'] = $book;

        return view('admin.book.edit', compact('data'));
    }

    public function update(Request $request, Book $book)
    {
        $attributes = $request->validate([
            'name' => 'required|string',
//            'subject' => 'required|string',
//            'language' => 'required|string',
//            'description' => 'string|max:2000'
        ]);

        $book->name = $attributes['name'];
        $book->subject = $attributes['subject'];
        $book->language = $attributes['language'];
        $book->description = $attributes['description'];

        $book->save();

        return redirect()->action([self::class, 'index'])->with(['success' => 'کتاب با موفقیت ویرایش شد']);
    }

    public function destroy(Book $book)
    {
       $book->delete();

        return redirect()->action([self::class, 'index'])->with(['success' => 'کتاب با موفقیت حذف شد']);
    }
}
