<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\CalculationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalculationController extends Controller
{
    public $calculation;
    // public $calDetail;
    public function __construct(Calculation $calculation, CalculationDetail $detail) {
        $this->calculation = $calculation;
        // $this->calDetail = $detail;
    }

    public function index() {
        $data = $this->calculation->latest();
        return view('', [
            'title' => 'Data Perhitungan',
            'data' => $data,
        ]);
    }
    public function edit($id){
        $item = $this->calculation->find($id);
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
            'grading_id' => 'required|exists:gradings,id',
            'major_id' => 'required|exists:majors,id',
            'total_nilai' => 'required',
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
                    ? $this->calculation->findOrFail(decrypt($id_to_update))
                    : new Calculation;

            $item->grading_id = $request->grading_id;
            $item->major_id = $request->major_id;
            $item->total_nilai = $request->total_nilai;
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
        $item = $this->calculation->findOrFail(decrypt($id));
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
