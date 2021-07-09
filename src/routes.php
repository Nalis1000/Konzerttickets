<?php
$routes = [
    '' => 'WelcomeController@index',
    'newticket'=>'buyTicketController@index',
    'ticketlist'=>'ticketlistController@index',
    'buyvalidation' => 'ValidationController@ticketBuyValidation',
    'editvalidation' => 'ValidationController@ticketEditValidation',
];