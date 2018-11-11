<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /** @var string  */
    const USERNAME_COLUMN = 'login';
    /** @var string  */
    const PASSWORD_COLUMN = 'password';
    /** @var string  */
    const NAME_COLUMN     = 'name';

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
     * Пришлось в массиве писать из за регулярок.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            self::USERNAME_COLUMN   => ['required', 'alpha_dash', 'min:8', 'unique:users,login'],
            self::PASSWORD_COLUMN   => [
                'min:6',
                'required',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed'
            ],
            self::NAME_COLUMN       => ['required', 'string', 'max:255']
        ];
    }

    /**
     * @return array
     */

    public function messages(): array
    {
        return [
            self::USERNAME_COLUMN.'.required'   => 'Поле логин обязательное!',
            self::USERNAME_COLUMN.'.unique'     => 'Такой логин уже есть!',
            self::USERNAME_COLUMN.'.min'        => 'Минимальная длинна логина 8 символов',
            self::USERNAME_COLUMN.'.regex'      => 'Доступна только маска [a-Z0-9]',
            self::USERNAME_COLUMN.'.alpha_dash' => 'Логин - только альфа-символы (a-z) (в любом регистре) + возможно цифры (0-9)',

            self::PASSWORD_COLUMN.'.required'   => 'Поле пароль обязательно к заполнению',
            self::PASSWORD_COLUMN.'.min'        => 'Минимальная длинна поля пароль 8 символов',
            self::PASSWORD_COLUMN.'.confirmed'  => 'Поле пароль и поле подтверждения пароля не совпадают',
            self::PASSWORD_COLUMN.'.regex'      => 'Пароль - обязательно символы в верхнем и нижнем регистрах + цифры,',

            self::NAME_COLUMN.'.required'       => 'Поле имя обязательное',
            self::NAME_COLUMN.'.max'            => 'поле имя не более 255 символов'
        ];
    }
}
