<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'SenderId' => ['required', Rule::exists('customers', 'id')],
            'BeneficiaryId' => ['required', Rule::exists('customers', 'id')],
            'amount'=>'required',
            'PaymentMethod'=>'required|max:25',
            'TransactionType'=>'required|max:25',
            'currency'=>'required|max:5',
            'status'=>'required|max:25',
        ];
    }
}
