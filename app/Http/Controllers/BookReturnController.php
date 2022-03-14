<?php
namespace App\Http\Controllers;
use App\Models\BookReturn;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BookReturnController extends Controller
{
public function show(){
    //menampilkan seluruh data dari table book return
        return bookreturn::all();
}

public function detail($id){
    //menampilkan data dari table book return
    if(DB::table('book_return')->where('id_book_return', $id)->exists()){
        $detail = DB::table('book_return')
        ->select('book_return.*')
        ->join('book_borrowing', 'book_borrowing.id_book_borrowing', '=', 'book_return.id_book_borrowing')
        ->where('id_book_return', $id)
        ->get();
        return Response()->json($detail);
    }else{
        return Response()->json(['message' => 'not found']);
    }
}
    
public function returningbook(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id_book_borrowing'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $cek_again=BookReturn::where('id_book_borrowing',$req->id_book_borrowing);
        if($cek_again->count() == 0){
            $dt_returning = BookBorrowing::where('id_book_borrowing',$req->id_book_borrowing)->first();
            $date_now = Carbon::now()->format('Y-m-d');
            $return_date = new Carbon($dt_returning->return_date);
            $dendaperhari = 1500;
            if(strtotime($date_now) > strtotime($return_date)){
                $jumlah_hari = $return_date->diff($date_now)->days;
                $denda = $jumlah_hari*$dendaperhari;
            }else {
                $denda = 0;
            }
            $save = BookReturn::create([
                'id_book_borrowing'    => $req->id_book_borrowing,
                'return_date'  => $return_date,
                'amercement'                 => $denda,
            ]);
            if($save){
                $data['status'] = 1;
                $data['message'] = 'success returned !';
            } else {
                $data['status'] = 0;
                $data['message'] = 'failed returned !';
            }
        } else {
            $data = ['status'=>0,'message'=>'it has been returned'];
        }
        return response()->json($data);
    }

public function update($id, Request $request){
        //mengubah data dari table book return
        $validator=Validator::make($request->all(),
        [
            'id_book_borrowing' => 'required',
            'return_date' => 'required',
            'amercement' => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('book_return')
        ->where('id_book_return', '=', $id)
        ->update([
            'id_book_borrowing' => $request->id_book_borrowing,
            'return_date' => $request->return_date,
            'amercement' => $request->amercement
        ]);

        $data=BookReturn::where('id_book_return', '=', $id)->get();
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
        //menghapus data dari table book return
        $delete = DB::table('book_return')
        ->where('id_book_return', '=', $id)
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