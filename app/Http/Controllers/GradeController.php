<?php
namespace App\Http\Controllers;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class GradeController extends Controller
{
public function show()
    {
        return grade::all();
    }

public function detail($id) 
    {

    if(grade::where('id_grade', $id)->exists()) {
        $data = grade::where('grade.id_grade', '=', $id)
        ->get();
        return Response()->json($data);
    }
    
    else {
        return Response()->json(['message' => 'not found' ]);
    }
    }


public function store(Request $request)
    {

    $validator=Validator::make($request->all(),
    [
    'grade_name' => 'required'
    ]
    );

    if($validator->fails()) {
        return Response()->json($validator->errors());
    }

    $simpan = grade::create([
    'grade_name' => $request->grade_name
    ]);
    
    if($simpan) {
        return Response()->json([
            'status'=>1, 
            'message'=>'success add data !'
    ]);

    }
    else {
        return Response()->json([
            'status'=>0,
            'message'=>'failed add data !'
    ]);
    }
    }

public function update($id, Request $request)
    {

    $validator=Validator::make($request->all(),
    [
    'grade_name' => 'required'
    ]
    );

    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    
    $ubah = grade::where('id_grade', $id)->update([
    'grade_name' => $request->grade_name
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
    $hapus = grade::where('id_grade', $id)->delete();

    if($hapus) {
        return Response()->json([
            'status' => 1,
            'message' => 'success delete data !'
    ]);
    }

    else {
        return Response()->json([
            'status' => 0,
            'message' => 'failed delete data !'
    ]);
    }
    }
}