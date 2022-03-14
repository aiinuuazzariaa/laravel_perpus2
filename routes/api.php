<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => ['jwt.verify']], function (){

Route::get('/book_return', 'BookReturnController@show');
Route::get('/book_return/{id}', 'BookReturnController@detail');
Route::post('/book_return', 'BookReturnController@returningbook');
Route::put('/book_return/{id}', 'BookReturnController@update');
Route::delete('/book_return/{id}', 'BookReturnController@destroy');    

Route::get('/book_borrowing', 'BookBorrowingController@show');
Route::get('/book_borrowing/{id}', 'BookBorrowingController@detail');
Route::post('/book_borrowing', 'BookBorrowingController@store');
Route::put('/book_borrowing/{id}', 'BookBorrowingController@update');
Route::delete('/book_borrowing/{id}', 'BookBorrowingController@destroy');

Route::get('/detail_book_borrowing', 'DetailBookBorrowingController@show');
Route::get('/detail_book_borrowing/{id}', 'DetailBookBorrowingController@detail');
Route::post('/detail_book_borrowing', 'DetailBookBorrowingController@store');
Route::put('/detail_book_borrowing/{id}', 'DetailBookBorrowingController@update');
Route::delete('/detail_book_borrowing/{id}', 'DetailBookBorrowingController@destroy');

Route::get('/book', 'BookController@show');
Route::get('/book/{id}', 'BookController@detail');
Route::post('/book', 'BookController@store');
Route::put('/book/{id}', 'BookController@update');
Route::delete('/book/{id}', 'BookController@destroy');
Route::get('/book/search','BookController@index');

Route::get('/grade', 'GradeController@show');
Route::get('/grade/{id}', 'GradeController@detail');
Route::post('/grade', 'GradeController@store');
Route::put('/grade/{id}', 'GradeController@update');
Route::delete('/grade/{id}', 'GradeController@destroy');

Route::get('/student', 'StudentController@show');
Route::get('/student/{id}', 'StudentController@detail');
Route::post('/student', 'StudentController@store');
Route::put('/student/{id}', 'StudentController@update');
Route::delete('/student/{id}', 'StudentController@destroy');
});