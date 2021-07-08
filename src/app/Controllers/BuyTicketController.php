<?php


class buyTicketController
{
function index(){
    require 'app/Models/DatabaseRequests.php';

    //$concerts=DatabaseRequests->getConcerts();

    require "app/views/buyTicket.view.php";
}
}