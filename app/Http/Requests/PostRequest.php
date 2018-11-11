<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /** @var string  */
    const POST_COLUMN = 'post';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            self::POST_COLUMN => 'required|min:1'
        ];
    }

    /**
     * @return array
     */

    public function messages(): array
    {
        return [
            self::POST_COLUMN.'.required'   => 'Поле сообщение обязательное!',
            self::POST_COLUMN.'.min'        => 'Минимальная длинна сообщения 1 символ',
        ];
    }
}
