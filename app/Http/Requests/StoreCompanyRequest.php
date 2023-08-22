<?php

namespace App\Http\Requests;

use App\Models\Company;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws Exception
     */
    public function rules(): array
    {

        if (! assert($this->route('company') instanceof Company)) {
            throw new Exception('Received company is not the required object');
        }

        return [
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255|email',
            'phone' => 'nullable|string|max:255',
        ];
    }
}
