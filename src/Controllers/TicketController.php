<?php

namespace App\Controllers;

use App\Models\Ticket;
use App\Models\Agent;
use App\Models\Airport;
use App\Models\Fare;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\Passenger;
use \Firebase\JWT\JWT;

class TicketController extends BaseController
{
    private $key = 'rahasia';

    public function search($request, $response, $args)
    {
        $ticket = Ticket::where('id',$args['id'])->first();

        if(empty($ticket)){
            return $response->withJson([
                'status' => 400,
                'message' => 'Ticket not found',
                'succes' => false,
            ]);
        } else {
            $passenger = Passenger::where('id',$ticket['passenger_id'])->first();
            $fare =  Fare::where('id',$ticket['fare_id'])->first();
            $flight = Flight::where('id',$fare["flight_id"])->first();
            $airline = Airline::where('id',$flight['airline_id'])->first();
            $airport1 = Airport::where('id',$flight['airport_from_id'])->first();
            $airport2 = Airport::where('id',$flight['airport_to_id'])->first();

            return $response->withJson([
                'status' => 200,
                'message' => 'Ticket found',
                'succes' => true,
                'succes' => [
                    'ticket'         => $ticket['id'],
                    'name'           => $passenger['name'],
                    'title'          => $passenger['title'],
                    'airline'        => $airline['name'],
                    'flight_code'    => $airline['flight_code'],
                    'from'           => $airport1['name'],
                    'code_from'      => $airport1['code'],
                    'city_from'      => $airport1['city'],
                    'to'             => $airport2['name'],
                    'code_to'        => $airport2['code'],
                    'city_to'        => $airport2['city'],
                    'departure_date' => $flight['departure_date'],
                    'departure_time' => $flight['departure_time'],
                    'arrival_date'   => $flight['arrival_date'],
                    'arrival_time'   => $flight['arrival_time'],
                    'airport_tax'    => $airport1['tax'],
                    'fare'           => $fare['fare'],
                ],
            ]);
        }
    }

    public function create($request, $response)
    {
        $this->validation->rule('required', ['name', 'title', 'phone', 'email', 'address']);

        if ($this->validation->validate()) {
            $passenger = Passenger::create([
                'name' => $request->getParsedBody()['name'],
                'title' => $request->getParsedBody()['title'],
                'phone' => $request->getParsedBody()['phone'],
                'email' => $request->getParsedBody()['email'],
                'address' => $request->getParsedBody()['address'],
            ]);

            $fare = Fare::where('flight_id',$request->getParsedBody()["flight"])->first();
            $flight = Flight::where('id',$request->getParsedBody()["flight"])->first();
            $airport1 = Airport::where('id',$flight['airport_from_id'])->first();
            $airport2 = Airport::where('id',$flight['airport_to_id'])->first();
            $airline = Airline::where('id',$flight['airline_id'])->first();

            $ticket = Ticket::create([
                'passenger_id' => $passenger['id'],
                'fare_id' => $fare['id'],
            ]);

            return $response->withJson([
                'status' => 201,
                'message' => 'Ticket successfully created',
                'succes' => true,
                'succes' => [
                    'ticket'         => $ticket['id'],
                    'name'           => $passenger['name'],
                    'title'          => $passenger['title'],
                    'airline'        => $airline['name'],
                    'flight_code'    => $airline['flight_code'],
                    'from'           => $airport1['name'],
                    'code_from'      => $airport1['code'],
                    'city_from'      => $airport1['city'],
                    'to'             => $airport2['name'],
                    'code_to'        => $airport2['code'],
                    'city_to'        => $airport2['city'],
                    'departure_date' => $flight['departure_date'],
                    'departure_time' => $flight['departure_time'],
                    'arrival_date'   => $flight['arrival_date'],
                    'arrival_time'   => $flight['arrival_time'],
                    'airport_tax'    => $airport1['tax'],
                    'fare'           => $fare['fare'],
                ],
            ], 201);
        } else{
            return $response->withJson([
                'status' => 400,
                'message' => 'Invalid data',
                'succes' => false,
            ]);
        }
    }

    public function setUpdate($request, $response, $args)
    {
        $this->validation->rule('required', ['name', 'title', 'phone', 'email', 'address']);

        if ($this->validation->validate()) {
            $get_ticket = Ticket::where('id',$args['id'])->first();

            if(empty($get_ticket)){
                return $response->withJson([
                    'status' => 400,
                    'message' => 'Ticket not found',
                    'succes' => false,
                ]);
            } else {
                $passenger = Passenger::where('id',$get_ticket['passenger_id'])->first();
                Passenger::find($get_ticket['passenger_id'])->update([
                    'name' => $request->getParsedBody()['name'],
                    'title' => $request->getParsedBody()['title'],
                    'phone' => $request->getParsedBody()['phone'],
                    'email' => $request->getParsedBody()['email'],
                    'address' => $request->getParsedBody()['address'],
                ]);

                $fare = Fare::where('id',$get_ticket['fare_id'])->first();
                $flight = Flight::where('id',$fare["flight_id"])->first();
                $airline = Airline::where('id',$flight['airline_id'])->first();
                $airport1 = Airport::where('id',$flight['airport_from_id'])->first();
                $airport2 = Airport::where('id',$flight['airport_to_id'])->first();

                Ticket::find($args['id'])->update([
                    'passenger_id' => $get_ticket['passenger_id'],
                    'fare_id' => $fare['id'],
                ]);

                return $response->withJson([
                    'status' => 201,
                    'message' => 'Ticket successfully updated',
                    'succes' => true,
                    'succes' => [
                        'ticket'         => $get_ticket['id'],
                        'name'           => $passenger['name'],
                        'title'          => $passenger['title'],
                        'airline'        => $airline['name'],
                        'flight_code'    => $airline['flight_code'],
                        'from'           => $airport1['name'],
                        'code_from'      => $airport1['code'],
                        'city_from'      => $airport1['city'],
                        'to'             => $airport2['name'],
                        'code_to'        => $airport2['code'],
                        'city_to'        => $airport2['city'],
                        'departure_date' => $flight['departure_date'],
                        'departure_time' => $flight['departure_time'],
                        'arrival_date'   => $flight['arrival_date'],
                        'arrival_time'   => $flight['arrival_time'],
                        'airport_tax'    => $airport1['tax'],
                        'fare'           => $fare['fare'],
                        ],
                    ], 201);
                    }
                }
            }

    public function setDelete($request, $response, $args)
    {
        $ticket = Ticket::where('id',$args['id'])->first();

        if(empty($ticket)){
            return $response->withJson([
                'status' => 400,
                'message' => 'Ticket not found',
                'succes' => false,
            ]);
        } else {
            Ticket::find($args['id'])->delete();
            Passenger::find($ticket['passenger_id'])->delete();

            return $response->withJson([
                'status' => 200,
                'message' => 'Ticket successfully deleted',
                'succes' => true,
            ]);
        }
    }
}
