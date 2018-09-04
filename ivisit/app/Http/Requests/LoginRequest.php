<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 9/4/18
 * Time: 3:31 PM.
 */

namespace App\Http\Requests;
use App\Exceptions\ValidationFailedException;
use Illuminate\Support\Facades\Validator;


class LoginRequest extends ValidationRequest
{
    /**
     * @throws ValidationFailedException
     */
    public function validate()
    {
        $validator = Validator::make($this->request->all(), [
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationFailedException($validator);
        }
    }
}
