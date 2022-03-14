<?php
namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BookController extends Controller
{
public function show()
    {
    //menampilkan seluruh data dari table book
        return book::all();
    }

public function detail($id) 
    {
    //menampilkan data dari table book sesuai dengan id_book
    if(book::where('id_book', $id)->exists()) {
        $data = book::where('book.id_book', '=', $id)
        ->get();
        return Response()->json($data);
    }
    
    else {
        return Response()->json(['message' => 'not found' ]);
    }
    }

public function store(Request $request)
    {
    //menambah data dari table book
    $validator=Validator::make($request->all(),
    [
    'book_name' => 'required',
    'author' => 'required',
    'description' => 'required'
    ]
    );
    
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }

    $simpan = book::create([
    'book_name' => $request->book_name,
    'author' => $request->author,
    'description' => $request->description
    ]);

    if($simpan){
        return Response()->json([
            'status' => 1,
            'message' => 'success add data !'
    ]);

    }
    else{
        return Response()->json([
            'status' => 0,
            'message' => 'failed add data !'
    ]);
    }
    }
public function update($id, Request $request)
    {
    //mengubah data dari table book
    $validator=Validator::make($request->all(),
    [
    'book_name' => 'required',
    'author' => 'required',
    'description' => 'required'
    ]
    );

    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    
    $ubah = book::where('id_book', $id)->update([
    'book_name' => $request->book_name,
    'author' => $request->author,
    'description' => $request->description
    ]);

    if($ubah) {
        return Response()->json([
            'status' => 1,
            'message' => 'success update data !'
    ]);
    }

    else {
        return Response()->json([
            'status' => 0,
            'message' => 'failed update data !'
    ]);
    }
    }

public function destroy($id)
    {
    //menghapus data dari table book
    $hapus = book::where('id_book', $id)->delete();

    if($hapus) {
        return Response()->json([
            'status' => 1,
            'message' => 'success delete data !'
    ]);
    }

    else {
        return Response()->json([
            'status' => 0,
            'message' => 'failed delete data !d'
    ]);
    }
    }
 
public function index(Request $request)
	{
		// menangkap data pencarian
		$index = book::where('book_name', $id)->index();

        if($index) {
            return Response()->json([
                'status' => 1,
                'message' => 'success delete data !'
        ]);
        }
    
        else {
            return Response()->json([
                'status' => 0,
                'message' => 'failed delete data !d'
        ]);
        }
        }
        }