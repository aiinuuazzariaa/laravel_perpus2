<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
public function show()
    {
        return student::all();
    }
    
public function detail($id) 
    {

    if(student::where('id_student', $id)->exists()) {
        $data = student::where('student.id_student', '=', $id)
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
    'student_name' => 'required',
    'date_birth' => 'required',
    'gender' => 'required',
    'address' => 'required',
    'id_grade' => 'required'
    ]
    );
    
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }

    $simpan = student::create([
    'student_name' => $request->student_name,
    'date_birth' => $request->date_birth,
    'gender' => $request->gender,
    'address' => $request->address,
    'id_grade' => $request->id_grade
    ]);

    if($simpan)
    {
        return Response()->json([
            'status' => 1,
            'message' => 'success add data !'
    ]);

    }
    else
    {
        return Response()->json([
            'status' => 0,
            'message' => 'failed add data !'
    ]);
    }
    }

public function update($id, Request $request)
    {

    $validator=Validator::make($request->all(),
    [
    'student_name' => 'required',
    'date_birth' => 'required',
    'gender' => 'required',
    'address' => 'required',
    'id_grade' => 'required'
    ]
    );

    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    
    $ubah = student::where('id_student', $id)->update([
    'student_name' => $request->student_name,
    'date_birth' => $request->date_birth,
    'gender' => $request->gender,
    'address' => $request->address,
    'id_grade' => $request->id_grade
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
    $hapus = student::where('id_student', $id)->delete();

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