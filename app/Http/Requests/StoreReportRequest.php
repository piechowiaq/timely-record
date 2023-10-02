<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'report_date' => ['required', 'date'],
            'notes' => ['string', 'max:255'],
            'company_id' => ['required','exists:companies,id'],
            'registry_id' => ['required', 'exists:registries,id'],
        ];
    }
}
