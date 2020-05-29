<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
        $parent_id = (int) $this->get('parent_id');
        $id = (int) $this->get('id');

        if ($this->method() == 'PUT') {
            if ($parent_id > 0) {
                $name = 'required|unique:categories,name,'.$id.'id,parent_id'.$parent_id;
            } else {
                $name = 'required|unique:categories,name,'.$id;
            }

            $slug = 'unique:categories,slug,'.$id;
        } else {
            $name = 'required|unique:categories,name,NULL,id,parent_id,'.$parent_id;
            $slug = 'unique:categories,slug';
        }
        return [
            'category_name' => $name,
            'slug' => $slug
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_name.required' => \Lang::get('validation.required'),
            'category_name.unique' => \Lang::get('validation.unique'),
        ];
    }
}
