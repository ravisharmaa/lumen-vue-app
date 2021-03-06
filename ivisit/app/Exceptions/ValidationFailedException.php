<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 8/27/18
 * Time: 11:12 AM
 */

namespace App\Exceptions;
use Illuminate\Validation\ValidationException;


class ValidationFailedException extends ValidationException
{
    public function __construct(\Illuminate\Contracts\Validation\Validator $validator, ?\Symfony\Component\HttpFoundation\Response $response = null, string $errorBag = 'default')
    {
        parent::__construct($validator, $response, $errorBag);
    }

    public function getResponse()
    {
        return response(['errors'=>$this->errors()], 422);
    }
}