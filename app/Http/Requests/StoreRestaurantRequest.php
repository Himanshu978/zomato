<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
      /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true is user type is of restaurant
        if(auth()->user()->type == 2){
            return true;
        }

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

            'name' => ['required', 'string', 'max:60'],
            'description' => ['required'],
            'phone' => ['required', 'digits_between:8,15'],
            'opening' => ['required'],
            'closing' => ['required'],
            'address_id' => ['required'],

        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'description.required' => 'Description is required!',
            'phone.required' => 'Phone is required!',
            'opening.required' => 'Opening time is required!',
            'closing.required' => 'Closing time is required!',
            'address_id' => 'Address is required!',

        ];
    }


     /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [

        ];
    }
}
