<?php

use App\Middleware\JWTMiddleware;

$app->group('/api', function(){
    $this->post('/login', '\App\Controllers\AgentController:login');

    $this->group('/flight', function(){
        $this->get('', '\App\Controllers\FlightController:index');
        $this->post('/search', '\App\Controllers\FlightController:search')->add(new JWTMiddleware());
    });

    $this->group('/ticket', function(){
        $this->get('', '\App\Controllers\TicketController:index');
        $this->post('/create', '\App\Controllers\TicketController:create')->add(new JWTMiddleware());
        $this->get('/show/{id}', '\App\Controllers\TicketController:search');
        $this->put('/edit/{id}', '\App\Controllers\TicketController:setUpdate')->add(new JWTMiddleware());
        $this->delete('/delete/{id}', '\App\Controllers\TicketController:setDelete')->add(new JWTMiddleware());
    });

});
