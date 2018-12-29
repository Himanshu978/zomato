<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'restaurant_id' => ['required'],
            'cuisine_id' => ['required'],
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
            'price.required' => 'Price is required!',
            'restaurant_id.required' => 'Restaurant is required!',
            'cuisine_id.required' => 'Cuisine is required!'
        ];
    }

}
