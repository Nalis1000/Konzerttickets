<?php


class buyTicketController
{
    var $concertModel = '';

    function index(){
        require 'app/Models/ConcertModel.php';

        //Erstellen neues ConcertModel objekt if noch keines vorhanden
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }

        $concerts=$this->concertModel->getConcerts();

        require "app/views/buyTicket.view.php";
    }
}