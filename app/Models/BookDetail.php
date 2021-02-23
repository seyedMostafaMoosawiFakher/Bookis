<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;
    protected $table = 'book_details';
    protected $fillable = [
        'writter_id',
        'publisher_id',
        'publication_date',
        'publication_place',
        'edition',
        'edit_version',
        'number_of_pages',
        'translation',
        'translator',
        'resources',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(book::class);
    }

    public function getPublicationDateAttribute($date)
    {
        if($date==null){return;}
        return Carbon::make($date)->format('yyyy-mm-dd');
    }
//
//    public function getAsdAttribute()
//    {
//        return 'hi';
//    }
}
