<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 9/4/18
 * Time: 5:36 PM.
 */

namespace App\Http\Requests;

use Illuminate\Http\Request;

abstract class ValidationRequest
{
    abstract public function validate(Request $request);
}
