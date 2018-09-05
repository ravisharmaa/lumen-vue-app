<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 9/4/18
 * Time: 3:31 PM.
 */

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationFailedException;

class AppUsersRequest extends ValidationRequest
{
    /**
     * @param Request $request
     * @throws ValidationFailedException
     */
    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserName' => 'required',
            'SalesRepName' => 'required',
            'SalesRepDepartment' => 'required',
            'Password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            throw new ValidationFailedException($validator);
        }
    }
}
