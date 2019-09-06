<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemValidator extends FormRequest
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
            'item_name' => 'required',
            'barcode' => 'required|unique:items,barcode',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'sale_price' => 'required',
            'group' => 'required',
            'piece_in_box' => 'required',
            'meter_per_box' => 'required',
            'size' => 'required',
        ];
    }
}
