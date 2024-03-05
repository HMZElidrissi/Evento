<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date'],
            'location' => ['required'],
            'number_attendees' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'A description is required',
            'date.required' => 'A date is required',
            'date.date' => 'The date must be a valid date',
            'location.required' => 'A location is required',
            'number_attendees.required' => 'The number of attendees is required',
            'number_attendees.integer' => 'The number of attendees must be an integer',
            'category_id.required' => 'A category is required',
            'category_id.exists' => 'The selected category does not exist'
        ];
    }
}
