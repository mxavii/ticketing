<?php

namespace App\Controllers;

use App\Models\Flight;
use App\Models\Airport;
use \Firebase\JWT\JWT;

class FlightController extends BaseController
{
    private $key = 'rahasia';

    public function index($request, $response)
    {
        $flight  = Flight::all();

        if(empty($flight)){
            return $response->withJson([
                'status' => 400,
                'message' => 'Flight unavailable',
                'succes' => false,
            ]);
        } else {
            return $response->withJson([
                'status' => 200,
                'message' => 'All flight available',
                'succes' => true,
                'succes' => $flight,
            ]);
        }
    }

    public function search($request, $response)
    {
        $from = Airport::where('code',$request->getParsedBody()["from"])->first();
        $to = Airport::where('code',$request->getParsedBody()["to"])->first();
        $date = $request->getParsedBody()["date"];

        $flight = Flight::where('airport_from_id',$from['id'])
                        ->where('airport_to_id',$to['id'])
                        ->where('departure_date',$date)
                        ->where('availability',1)
                        ->get();
    // var_dump($from);
    // die();

        if(empty($flight)){
            return $response->withJson([
                'status' => 400,
                'message' => 'Flight unavailable',
                'succes' => false,
            ]);
        } else {
            return $response->withJson([
                'status' => 200,
                'message' => 'Flight available',
                'succes' => true,
                'succes' => $flight,
            ]);
        }
    }

    public function show($request, $response, $args)
    {
        $flight = Flight::find($args['id']);

        if(empty($flight)){
            return $response->withJson([
                'status' => 400,
                'message' => 'Flight unavailable',
                'succes' => false,
            ]);
        } else {
            return $response->withJson($flight);
        }
    }
}
