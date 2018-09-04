<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 9/4/18
 * Time: 5:36 PM
 */

namespace App\Http\Requests;
use Illuminate\Http\Request;

abstract class ValidationRequest
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * ValidationRequest constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract public function validate();
}