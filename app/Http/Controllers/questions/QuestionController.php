<?php

namespace App\Http\Controllers\questions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cycle;
use App\Http\Resources\CycleResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Material;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Http\Resources\CollageResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;


class QuestionController extends Controller
{
    use GeneralTrait;



    public function all_cycles(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'uuid' => 'required|max:4',
                'is-master' =>'required|boolean'
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 422);
            }

            try {
                $material = Material::where('uuid', $request['uuid'])->first();
                if (!$material) {
                    return $this->errorResponse('Undefined uuid', 422);
                }
                $material_id=$material->id;
                $cycles_nums = Material::findOrFail($material_id)->questions->where('is-master', $request['is-master'])->whereNotNull('year')->pluck('year');

                return $this->successResponse($cycles_nums, 'All Cycles .');
            } catch (\Exception $ex) {
                return $this > $this->errorResponse('The name or code uncorrect', 400);
            }
        }



    public function all_cycle_questions(Request $request){


                $validator = Validator::make($request->all(), [
            'uuid' => 'required|max:4',
            'is-master' => 'required|boolean',
            'year' => 'required|max:4'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $material = Material::where('uuid', $request['uuid'])->first();
            if (!$material) {
                return $this->errorResponse('Undefined uuid', 422);
            }
            $material_id=$material->id;
               $cycles_nums = Material::findOrFail($material_id)->questions->where('is-master', $request['is-master'])->where('year',$request['year'])->all();
               return  QuestionResource::Collection($cycles_nums);
        } catch (\Exception $ex) {
            return $this > $this->errorResponse('The name or code uncorrect', 400);
        }
    }

    public function book_questions(Request $request){


        $validator = Validator::make($request->all(), [
        'uuid' => 'required|max:4',
        'is-master' => 'required|boolean',
    ]);
    if ($validator->fails()) {
    return $this->errorResponse($validator->errors(), 422);
    }

    try {
    $material = Material::where('uuid', $request['uuid'])->first();
    if (!$material) {
        return $this->errorResponse('Undefined uuid', 422);
    }
    $material_id=$material->id;
       $book_question = Material::findOrFail($material_id)->questions->where('is-master', $request['is-master'])->whereNull('year')->all();
       return  QuestionResource::Collection($book_question);
    } catch (\Exception $ex) {
    return $this > $this->errorResponse('The name or code uncorrect', 400);
        }

}
public function collage_cycles(Request $request)
{
     $validator = Validator::make($request->all(), [
    'uuid' => 'required|max:4',
   
]);

if ($validator->fails()) {
return $this->errorResponse($validator->errors(), 422);
}

}



}


