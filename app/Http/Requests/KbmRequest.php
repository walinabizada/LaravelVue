<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KbmRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_name' => ['required', 'max:255'],
            'implementation_side' => [],
            'time_frame' => [],
            'needed_document' => [],
            'fees' => [],
            'legal_document' => [],
            'implementation_procedures' => [],
            'course_of_action' => []
        ];
    }
}
