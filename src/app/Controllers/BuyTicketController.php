<?php


class buyTicketController
{
    var $concertModel = '';
    var $reducitonModel = '';

    function index(){

        //Erstellen neue ConcertModel und ReductionModel objekte falls noch keine vorhanden
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        //Aufrufen der getConcerts und getReduction methoden, welche beide daten zurückgeben
        $concerts=$this->concertModel->getConcerts();
        $reductions=$this->reducitonModel->getReduction();

        //Anzeigen des View
        require "app/views/buyTicket.view.php";
    }
}