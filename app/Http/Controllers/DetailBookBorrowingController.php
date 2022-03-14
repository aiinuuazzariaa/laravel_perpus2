<?php
namespace App\Http\Controllers;
use App\Models\DetailBookBorrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DetailBookBorrowingController extends Controller
{
public function show(){
    //menampilkan seluruh data dari table detail book borrowing
        return DetailBookBorrowing::all();
    }

public function detail($id){
    //menampilkan data dari table detail book borrowing
        if(DB::table('detail_book_borrowing')->where('id_detail_book_borrowing', $id)->exists()){
            $detail = DB::table('detail_book_borrowing')
            ->select('detail_book_borrowing.*')
            ->join('book_borrowing', 'book_borrowing.id_book_borrowing', '=', 'detail_book_borrowing.id_book_borrowing')
            ->join('book', 'book.id_book', '=', 'id_detail_book_borrowing')
            ->where('id_detail_book_borrowing', $id)
            ->get();
            return Response()->json($detail);
        }else {
            return Response()->json(['message'=>'not found']);
        }
    }
   
public function store(Request $request)
    {
        //menambahkan data dari table detail book borrowing
        $validator = Validator::make($request->all(),[
            'id_book_borrowing' => 'required',
            'id_book' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()){
            return Response() -> json($validator->errors());
        }

        $store = DetailBookBorrowing::create([
            'id_book_borrowing' => $request->id_book_borrowing,
            'id_book' => $request->id_book,
            'qty' => $request->qty
        ]);

        $data = DetailBookBorrowing::where('id_book_borrowing', '=', $request->id_book_borrowing)->get();
        if($store){ 
            return Response()->json([
                'status' => 1,
                'message' => 'succes add data !',
                'data' => $data
            ]);
        }else {
            return Response() -> json([
                'status' => 0,
                'message' => 'failed add data !'
            ]);
        }
    }

public function update($id, Request $request){
        //mengubah data dari table detail book borrowing
        $validator=Validator::make($request->all(),
        [
            'id_book_borrowing' => 'required',
            'id_book' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('detail_book_borrowing')
        ->where('id_detail_book_borrowing', '=', $id)
        ->update(
            [
                'id_book_borrowing' => $request->id_book_borrowing,
                'id_book' => $request->id_book,
                'qty' => $request->qty
            ]);

        $data=DetailBookBorrowing::where('id_detail_book_borrowing', '=', $id)->get();
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
        //menghapus data dari table detail book borrowing
        $delete = DB::table('detail_book_borrowing')
        ->where('id_detail_book_borrowing', '=', $id)
        ->delete();

        if($delete){
            return Response() -> json([
                'status' => 1,
                'message' => 'succes delete data !'
        ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'failed delete data !'
        ]);
        }

    }
    
}