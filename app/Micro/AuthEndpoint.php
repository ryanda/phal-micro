<?php

namespace App\Micro;

use App\User;
use App\Services\Auth;
use App\Services\Common;

class AuthEndpoint extends Controller
{
    public function login()
    {
        $req = $this->request->get();
        $validation = $this->validation->validate($req, [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
        ]);

        if ($validation->fails())
            return $this->buildResponse($validation->errors()->all()[0], Controller::SUCCESS_FALSE);

        $email = $req['email'];
        $password = $req['password'];

        $user  = User::where('email', $email)->first();
        if (is_null($user))
            return $this->buildResponse('User not found', Controller::SUCCESS_FALSE);

        if (! Common::hashCheck($password, $user->password))
            return $this->buildResponse('Password not match', Controller::SUCCESS_FALSE);

        $jwt = Auth::issueToken($user);

        $response = [
            'user' => $user,
            'jwt' => $jwt,
        ];

        $this->buildResponse($response, Controller::SUCCESS_TRUE);
    }
}
