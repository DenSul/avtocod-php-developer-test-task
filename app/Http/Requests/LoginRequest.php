<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /** @var string  */
    const LOGIN_COLUMN = 'login';
    /** @var string  */
    const PASS_COLUMN  = 'password';

    /**
     * LoginRequest constructor.
     */
    public function __construct()
    {

        $this->redirect = route('login');
    }

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
            self::LOGIN_COLUMN => 'required|string',
            self::PASS_COLUMN  => 'required|string'
        ];
    }

    /**
     * @return array
     */

    public function messages(): array
    {
        return [
            self::LOGIN_COLUMN.'.required'   => 'Поле логин обязательное!',
            self::LOGIN_COLUMN.'.string'     => 'Обязательно строка!',
            self::PASS_COLUMN.'.required'    => 'Поле логин обязательное!',
            self::PASS_COLUMN.'.string'      => 'Обязательно строка!',
        ];
    }
}
