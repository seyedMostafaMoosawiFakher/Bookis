<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDetail;
use Illuminate\Http\Request;

//|| metod     | url                                                | name

//|| POST      | admin/books/{book}/book-details                    | admin.books.book-details.store
//|| GET|HEAD  | admin/books/{book}/book-details                    | admin.books.book-details.index
//|| GET|HEAD  | admin/books/{book}/book-details/create             | admin.books.book-details.create
//|| PUT|PATCH | admin/books/{book}/book-details/{book_detail}      | admin.books.book-details.update
//|| GET|HEAD  | admin/books/{book}/book-details/{book_detail}      | admin.books.book-details.show
//|| DELETE    | admin/books/{book}/book-details/{book_detail}      | admin.books.book-details.destroy
//|| GET|HEAD  | admin/books/{book}/book-details/{book_detail}/edit | admin.books.book-details.edit


class BookDetailController extends Controller
{

    public function index(Book $book)
    {
        $data['book'] = $book;
        $data['book_details'] = $book->bookDetails()->latest()->paginate(10);
        return view('admin.book_detail.index', compact('data'));

    }

    public function create(Book $book)
    {
        $data['book'] = $book;
        return view('admin.book_detail.create', compact('data'));
    }

    public function store(Request $request, Book $book)
    {
        $attributes = $request->validate([
            'book_id' => '',
            'writter_id'  => 'Nullable|Numeric',
            'publisher_id' => 'Nullable|Numeric',
            'publication_date' => 'Nullable|Date',
            'publication_place' => 'Nullable|String',
            'edition' => 'Nullable|Numeric',
            'edit_version' => 'Nullable|Numeric',
            'number_of_pages' => 'Nullable|Numeric',
            'translation' => 'Nullable|String',
            'translator' => 'Nullable|String',
            'resources' => 'Nullable|String',
        ]);

        BookDetail::create($attributes);

        $data['book'] = $book->id;

        return redirect()->action([self::class, 'index'],['book'=>$data['book']])->with(['success' => 'توضیحات جدید برای کتاب با موفقیت ایجاد شد']);
    }

    public function show(Book $book ,BookDetail $book_detail)
    {
        $data['book'] = $book;
        $data['book_detail'] = $book_detail;
        return view('admin.book_detail.show', compact('data'));
    }

    public function edit(Book $book ,BookDetail $bookDetail)
    {
        $data['book'] = $book;
        $data['book_detail'] = $bookDetail;

        return view('admin.book_detail.edit', compact('data'));
    }

    public function update(Request $request,Book $book ,BookDetail $book_detail)
    {
        $attributes = $request->validate([
            'book_id' => '',
            'writter_id'  => 'Nullable|Numeric',
            'publisher_id' => 'Nullable|Numeric',
            'publication_date' => 'Nullable|Date',
            'publication_place' => 'Nullable|String',
            'edition' => 'Nullable|Numeric',
            'edit_version' => 'Nullable|Numeric',
            'number_of_pages' => 'Nullable|Numeric',
            'translation' => 'Nullable|String',
            'translator' => 'Nullable|String',
            'resources' => 'Nullable|String',
        ]);

            $book_detail->book_id = $attributes['book_id'];
            $book_detail->writter_id = $attributes['writter_id'];
            $book_detail->publisher_id = $attributes['publisher_id'];
            $book_detail->publication_date = $attributes['publication_date'];
            $book_detail->publication_place = $attributes['publication_place'];
            $book_detail->edition = $attributes['edition'];
            $book_detail->edit_version = $attributes['edit_version'];
            $book_detail->number_of_pages = $attributes['number_of_pages'];
            $book_detail->translation = $attributes['translation'];
            $book_detail->translator = $attributes['translator'];
            $book_detail->resources = $attributes['resources'];

            $book_detail->save();

        return redirect()->action([self::class, 'index'],['book'=>$book])->with(['success' => 'توضیحات با موفقیت ویرایش شدند']);
    }

    public function destroy(Book $book ,BookDetail $book_detail)
    {
        $book_detail->delete();
        return redirect()->action([self::class, 'index'],['book'=>$book])->with(['success' => 'توضیحات کتاب با موفقیت حذف شد']);
    }
}
