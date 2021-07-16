<?php

namespace App\Http\Requests;

use App\Rules\UniqueLike;
use Illuminate\Foundation\Http\FormRequest;

class StoreLikeRequest extends FormRequest
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
            'user_id' => ['required'],
            'type' => new UniqueLike(request()->user_id, request()->id, request()->type)
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'You need to be registered to vote'
        ];
    }
}
