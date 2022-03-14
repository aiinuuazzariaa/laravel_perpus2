<?php
namespace App\Http\Controllers;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BookBorrowingController extends Controller
{
public function show(){
        //menampilkan seluruh data dari table book borrowing
            return BookBorrowing::all();
    }

public function detail($id){
        //menampilkan data dari table book borrowing
        if(DB::table('book_borrowing')->where('id_book_borrowing', $id)->exists()){
            $detail_book_borrowing = DB::table('book_borrowing')
            ->select('book_borrowing.id_book_borrowing', 'book_borrowing.id_student', 'student.student_name', 'book_borrowing.borrow_date', 'book_borrowing.return_date')
            ->join('student', 'student.id_student', '=', 'book_borrowing.id_student')
            ->where('id_book_borrowing', $id)
            ->get();
            return Response()->json($detail_book_borrowing);
        }else {
            return Response()->json(['message' => 'not found']);
        }
    }
  
public function store(Request $request)
    {
        //menambah data dari table book borrowing
        $validator = Validator::make($request->all(), [
            'id_student' => 'required',
            'borrow_date' => 'required',
            'return_date'  => 'required'
        ]);

        if($validator->fails()){
            return Response() -> json($validator->errors());
        }

        $store = BookBorrowing::create([
            'id_student' => $request->id_student,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date
        ]);

        $data = BookBorrowing::where('id_student', '=', $request->id_student)->get();
        if($store){
            return Response() -> json([
                'status' => 1,
                'message' => 'succes add data !',
               
            ]);
        }else
        {
            return Response() -> json([
                'status' => 0,
                'message' => 'failed add data !'
            ]);
        }
    }

public function update($id, Request $request){
         //mengubah data dari table book borrowing
        $validator=Validator::make($request->all(),
        [
            'id_student' => 'required',
            'borrow_date' => 'required',
            'return_date'  => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('book_borrowing')
        ->where('id_book_borrowing', '=', $id)
        ->update([
            'id_student' => $request->id_student,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date
        ]);

        $data=BookBorrowing::where('id_book_borrowing', '=', $id)->get();
        if($update){
            return Response() -> json([
                'status' => 1,
                'message' => 'success update data !',
                'data' => $data  
            ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'failed update data !'
            ]);
        }
    }
    
public function destroy($id){
        //menghapus data dari table book
        $delete=DB::table('book_borrowing')
        ->where('id_book_borrowing', '=', $id)
        ->delete();

        if($delete){
            return Response() -> json([
                'status' => 1,
                'message' => 'succes delete data!'
        ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'failed delete data!'
        ]);
        }

    }
  
}