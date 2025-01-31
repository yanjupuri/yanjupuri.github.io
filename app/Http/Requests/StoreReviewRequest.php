<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
        $rules = [
            'types' => 'required',
            'rating' => 'required',
        ];
    
        if ($this->input('types') === 'product') {
            $rules['product'] = 'required';
        } elseif ($this->input('types') === 'service') {
            $rules['service'] = 'required';
        }
    
        return $rules;
    }    
}
