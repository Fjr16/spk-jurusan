<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaType;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    public $criteriaType;
    public $criteria;
    public $subCriteria;
    public function __construct(CriteriaType $criteriaType, Criteria $criteria, SubCriteria $subCriteria) {
        $this->criteriaType = $criteriaType;
        $this->criteria = $criteria;
        $this->subCriteria = $subCriteria;
    }

    // crud model criteriaType
    public function indexType() {
        $data = $this->criteriaType->latest();
        return view('', [
            'title' => 'Data Tipe Kriteria',
            'data' => $data,
        ]);
    }
    public function editType($id){
        $item = $this->criteriaType->find($id);
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

    public function storeType(Request $request){
        $id_to_update = $request->id ? decrypt($request->id) : null;
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'value' => 'required',
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
                    ? $this->criteriaType->findOrFail(decrypt($id_to_update))
                    : new CriteriaType;

            $item->name = $request->name;
            $item->value = $request->value;
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

    public function destroyType($id){
        $item = $this->criteriaType->findOrFail(decrypt($id));
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
    // end crud model criteriaType

    // crud model criteria
    public function index() {
        $data = $this->criteria->latest();
        return view('', [
            'title' => 'Data Kriteria',
            'data' => $data,
        ]);
    }
    public function edit($id){
        $item = $this->criteria->find($id);
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
            'criteria_type_id' => 'required|exists:criteria_types,id',
            'code' => ['required', Rule::unique('criterias', 'code')->ignore($id_to_update)],
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
                    ? $this->criteria->findOrFail(decrypt($id_to_update))
                    : new Criteria;

            $item->criteria_type_id = $request->criteria_type_id;
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
        $item = $this->criteria->findOrFail(decrypt($id));
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
    // end crud model criteria


    // Crud untuk model SubCriteria
    public function indexSub() {
        $data = $this->subCriteria->latest();
        return view('', [
            'title' => 'Data Kriteria',
            'data' => $data,
        ]);
    }
    public function editSub($id){
        $item = $this->subCriteria->find($id);
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

    public function storeSub(Request $request){
        $id_to_update = $request->id ? decrypt($request->id) : null;
        $validators = Validator::make($request->all(), [
            'criteria_id' => 'required|exists:criterias,id',
            'code' => ['required', Rule::unique('sub_criterias', 'code')->ignore($id_to_update)],
            'name' => 'required',
            'value' => 'required',
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
                    ? $this->subCriteria->findOrFail(decrypt($id_to_update))
                    : new SubCriteria;

            $item->criteria_id = $request->criteria_id;
            $item->code = $request->code;
            $item->name = $request->name;
            $item->value = $request->value;
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

    public function destroySub($id){
        $item = $this->subCriteria->findOrFail(decrypt($id));
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
    // end Crud untuk model SubCriteria
}
