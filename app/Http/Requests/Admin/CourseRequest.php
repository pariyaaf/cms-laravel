<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        if($this->method() == 'POST') {
            return [
                'title' =>['required ','max:250'],
                'body' => ['required '] ,
                // 'description' => ['required '] ,
                'images' => ['required ', 'mimes:png,jpg,jpeg,bmp'],
                'tags' => ['required '],
                'price' =>  ['required '],
                'type' =>  ['required '],
                //
            ];
        } 
        return [
            'title' =>['required ','max:250'],
            'body' => ['required '] ,
            // 'description' => ['required '] ,
            'images' => ['mimes:png,jpg,jpeg,bmp'],
            'tags' => ['required '],
            'price' =>  ['required '],
            'type' =>  ['required '],
        ];
    }
}
