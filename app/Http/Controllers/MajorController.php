<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MajorController extends Controller
{
    public $major;
    public function __construct(Major $major) {
        $this->major = $major;
    }
    public function index() {
        $data = $this->major->latest();
        return view('', [
            'title' => 'Data Jurusan',
            'data' => $data,
        ]);
    }
    public function edit($id){
        $item = $this->major->find($id);
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
            'code' => ['required', Rule::unique('majors', 'code')->ignore($id_to_update)],
            'name' => 'required',
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
                    ? $this->major->findOrFail(decrypt($id_to_update))
                    : new Major;

            $item->code = $request->code;
            $item->name = $request->name;
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
        $item = $this->major->findOrFail(decrypt($id));
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
