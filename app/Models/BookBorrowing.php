<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BookBorrowing extends Model
{
    use HasFactory;
    protected $table = 'book_borrowing';
    public $timestamps = false;
    protected $fillable = ['id_student', 'borrow_date', 'return_date'];
}