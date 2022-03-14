<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BookReturn extends Model
{
    use HasFactory;
    protected $table = 'book_return';
    public $timestamps = false;
    protected $fillable = ['id_book_borrowing', 'return_date', 'amercement'];
}