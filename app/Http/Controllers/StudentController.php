<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public $mStudent;
    public function __construct(Student $student) {
        $this->mStudent = $student;
    }
    public function index() {
        $data = $this->mStudent->latest();
        return view('', [
            'title' => 'Data Siswa',
            'data' => $data,
        ]);
    }
    public function edit($id){
        $item = $this->mStudent->find($id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => "Data Not Found",
            ]);
        }
        return response()->json([
            'status' => true,
            'item' => $item
        ]);
    }

    public function store(Request $request){
        $id_to_update = $request->id ? decrypt($request->id) : null;
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'nisn' => ['required', Rule::unique('students', 'nisn')->ignore($id_to_update)],
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);
        if ($validators->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validators->errors()->first(),
            ]);
        }

        try {
            DB::beginTransaction();
            $item = $id_to_update
                    ? $this->mStudent->findOrFail(decrypt($id_to_update))
                    : new Student;

            $item->name = $request->name;
            $item->nisn = $request->nisn;
            $item->tgl_lahir = $request->tgl_lahir;
            $item->alamat = $request->alamat;
            $item->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Sukses memperbarui data',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy($id){
        $item = $this->mStudent->findOrFail(decrypt($id));
        if ($item) {
            $item->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sukses menghapus data',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
            ]);
        }
    }
}
