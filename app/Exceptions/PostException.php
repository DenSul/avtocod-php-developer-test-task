<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class PostException extends Exception
{
    public function render(Request $request)
    {
        return response()->view(
            'errors.post',
            ['exception' => $this],
            404
        );
    }
}
