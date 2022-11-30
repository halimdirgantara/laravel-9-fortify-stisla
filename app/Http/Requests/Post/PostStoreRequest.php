<?php

namespace App\Http\Requests\Post;

use App\Enums\StatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|max:2048',
            'category' => 'required|exists:categories,id',
            'status'    => new Enum(StatusEnum::class),
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title can not be empty',
            'content.required' => 'Content can not be empty',
            'image.required' => 'Image can not be empty',
            'image.image' => 'Only images are allowed',
            'image.max' => 'Image file max size 2MB',
            'category_id.required' => 'Category can not be empty',
            'category_id.exist' => 'Category not exists',
            'status.required' => 'Status can not be empty',
        ];
    }
}
