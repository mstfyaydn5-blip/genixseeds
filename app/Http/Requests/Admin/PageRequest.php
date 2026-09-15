<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage pages');
    }

    public function rules(): array
    {
        $id = $this->route('page')?->id;

        return [
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('pages', 'slug')->ignore($id)],
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'content_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_description_ar' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
