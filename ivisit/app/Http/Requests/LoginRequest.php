<?php
/**
 * Created by PhpStorm.
 * User: ravibastola
 * Date: 9/2/18
 * Time: 6:23 PM.
 */

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginRequest
{
    public function validate()
    {
        $validator = Validator::make((new Request())->all(), [
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }

        return $this;
    }
}
