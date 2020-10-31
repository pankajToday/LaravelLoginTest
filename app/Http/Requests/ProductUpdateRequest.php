<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'product_name'       =>  'required|regex:/^[(a-zA-Z0-9\-\s)]+$/u|min:3|max:50',
            'product_code'       => 'required|max:10|regex:/^[(a-zA-Z0-9)]+$/u',
            'quantity'           => 'required|regex:/^[(0-9)]+$/u|min:1|max:10',
            'price'              => 'required|regex:/^[(0-9.)]+$/u|min:1|max:10',
            'category_id'        => 'required|min:1|max:10|regex:/^[(0-9)]+$/u',
            'description'        => 'regex:/^[(a-zA-Z0-9.&\-\s)]+$/u|max:200',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'Please enter value for :attribute',
            'regex' => 'Please enter correct format for :attribute.' ,
            'unique' => ':attribute Already Exist. Try Another!.',
            'min' => 'Minimum length should be :min for :attribute',
            'max' => 'Max length should be :max for :attribute',
            'confirmed' => 'Confirm :attribute not matched.'
        ];
    }

    public function attributes()
    {
        return [
            'product_name'       =>"Product Name",
            'product_code'       => "Product Code",
            'quantity'           => "Quantity",
            'price'              =>"Price",
            'category_id'        => "Category Name",
            'description'        => "Description",

        ];
    }


}
