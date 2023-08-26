<?php

namespace App\Http\Requests;

use App\Models\Registry;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistryRequest extends FormRequest
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
        if (! assert($this->route('registry') instanceof Registry)) {
            throw new Exception('Received registry is not the required object');
        }
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'valid_for' => 'required|int',
        ];
    }
}
