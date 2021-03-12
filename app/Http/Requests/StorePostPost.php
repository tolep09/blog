<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostPost extends FormRequest
{

    public static function myRules()
    {
        return [
            'title' => 'required|min:6|max:500',
            'url_clean' => 'max:500|unique:posts',
            'content' => 'required|min:6',
            'category_id' => 'required',
            'posted' => 'required',
            'tags_id' => 'required'
        ];
    }
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
        return $this->myRules();
    }
}
