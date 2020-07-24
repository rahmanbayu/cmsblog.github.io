<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'title' => ['required', 'unique:posts,title'],
            'description' => ['required'],
            'content' => ['required'],
            'image' => ['required', 'mimes:jpg,png,jpeg'],
            'published_at' => ['required', 'date'],
        ];
    }
}
