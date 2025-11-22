<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
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
            'package_id' => ['required', 'exists:packages,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'content_type' => ['required', 'in:video,image'],
            'source_type' => ['required', 'in:file,url'],
            'source' => $this->input('source_type') === 'file' ?
                ['required_if:source_type,file', $this->input('content_type') === 'video' ? 'file' : 'image', $this->input('content_type') === 'video' ? 'mimes:mp4,mov,avi' : 'mimes:jpeg,png,jpg'] :
                ['required_if:source_type,url', 'url'],
            'thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'is_premium' => ['nullable', 'boolean'],
        ];
    }
}
