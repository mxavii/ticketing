<?php

namespace App\Controllers;

use App\Models\Agent;
use App\Models\Auth;
use \Firebase\JWT\JWT;

class AgentController extends BaseController
{
    private $key = 'rahasia';

    public function login($request, $response)
    {
        $username = $request->getParsedBody()["username"];
        $password = $request->getParsedBody()["password"];

        $agent = Agent::where('username',$username)
                 ->where('password',$password)->first();

        if(empty($agent)){
            return $response->withJson([
                'status' => 401,
                'message' => 'username or password false',
                'succes' => false,
            ]);
        }

        $token = [
            'iss' => 'syf',
            'iat' => time(),
            'exp' => time() + 60*100,
            'data'=> [
                'agent_id' => $agent->id
            ]
        ];

        $jwt =  JWT::encode($token, $this->key);

        // $keydecode = Auth::create([
        //     'agent_id'  => $agent['id'],
        //     'key'       => $jwt,
        //     'expired'   => time() + 60 * 2,
        //     'login'     => 1,
        // ]);

        return $response->withJson([
            'status'  => 200,
            'message' => 'loged in successfully',
            'succes' => true,
            'key  '  =>  $jwt,
        ]);
    }

    public function show($request, $response, $args)
    {
        $agent = Agent::find($args['id']);
        return $response->withJson($agent);
    }
}
