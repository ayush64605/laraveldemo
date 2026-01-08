<?php

namespace App\Http\Requests;

use App\Rules\PanNumberValidation;
use App\Rules\projectValidation;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projects = session('projects', []);
        $projectId = (int) $this->id;

        $exists = collect($projects)->contains(fn($item) => $item['id'] == $projectId);

        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'project_code' => ['required', 'string', 'max:20', 'alpha_dash', new projectValidation()],
            'status' => ['nullable', 'in:Active,Completed'],
            'priority' => ['required', 'in:Low,Medium,High'],
            'progress' => ['nullable', 'integer', 'min:0', 'max:100'],
            'budget' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'project_type' => ['nullable', 'in:Internal,Client'],
            'description' => ['nullable', 'string', 'max:1000'],

            'start_date' => ['required', 'date'],
            'complete_date' => ['required_if:status,Completed', 'after_or_equal:start_date'],
            'deadline_time' => ['nullable', 'date_format:H:i'],

            'image' => [
                $exists ? 'nullable' : 'required',
                'image',    
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],

            'client_name' => ['required', 'string', 'min:3', 'max:100'],
            'client_email' => ['required', 'email', 'max:150'],
            'client_pan' => ['required', new PanNumberValidation()],
            'client_phone' => ['nullable', 'regex:/^[0-9+\-\s]{7,20}$/'],
            'client_company' => ['nullable', 'string', 'max:150'],
            'client_website' => ['nullable', 'url', 'max:255'],
            'client_address' => ['nullable', 'string', 'max:300'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Name Field is Required.',
        ];
    }
}
