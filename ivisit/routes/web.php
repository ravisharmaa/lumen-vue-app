<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/login', 'AuthController@login');
$router->get('/app-users', 'AppUsersController@index');
$router->post('/app-users/store','AppUsersController@store');

$router->get('/',
    function (Request $request) {
        $data =
            [
                'UserName'              => 'test@gmail.com',
                'Password'              => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
                'SalesRepDepartment'    => 'VOLUPTAS DEBITIS TEMPORA',
                'SalesRepName'          => 'Cordie Kertzmann',
                'SalesRepLanguage'      => 'DE,EN,ES,FR,NL,PT',
                'visitLimit'            => 8,
                'UserToken'             => '0.0.0',
                'Password_confirmation' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
            ];

        $validator = Validator::make($data,
            [
                'UserName'           => 'required',
                'SalesRepName'       => 'required',
                'SalesRepDepartment' => 'required',
                'Password'           => 'required|confirmed',
            ]);

        return response()->json(
            [
                'fails'  => $validator->fails(),
                'failed' => $validator->failed(),
                'errors' => $validator->getMessageBag(),
            ],
            200);
    });



