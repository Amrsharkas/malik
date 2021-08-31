<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required' ,
            'name'=>'alpha_num|required' ,
            'description'=>'' ,
            'admin_show'=>'' ,
            'stuff_order'=>'' ,
            'created_at'=>'' ,
            'updated_at'=>'' ,

        ];
    }



/*
    public static function ServerSideValidation($request)
    {
        $errors = [];
//        Validate single input
        if ($request->stage_id == "") {
            array_push($errors,
                [
                    'msg' => 'stage is required',
                    "action_chain" => "Run function:sampleValidation",
                    "input_selector" => "stage_id"

                ]
            );

        }

//        Validate multiple input
        foreach ($request->name as $key => $name) {
            $k = $key + 1;


            if ($name == "") {
                array_push($errors,
                    [
                        'msg' => 'name is required',
                        "action_chain" => "Run function:sampleValidation",
                        "input_selector" => "#name" . $k

                    ]
                );
            }
        }
        //dd(['success' => false, 'errors' => $errors]);
        if (count($errors) > 0) {
            return ['success' => false, 'errors' => $errors];

        } else {
            return ['success' => true];
        }


    }*/

   // --@messages_fn@--
}
