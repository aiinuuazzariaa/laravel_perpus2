<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DetailBookBorrowing extends Model
{
    use HasFactory;
    protected $table = 'detail_book_borrowing';
    public $timestamps = false;
    protected $fillable = ['qty', 'id_book_borrowing', 'id_book' ];
}