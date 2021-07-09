<?php


class buyTicketController
{
    var $concertModel = '';
    var $reducitonModel = '';

    function index(){
        //require 'app/Models/ConcertModel.php';
        //require 'app/Models/ReductionModel.php';

        //Erstellen neue ConcertModel und ReductionModel objekte falls noch keine vorhanden
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        $concerts=$this->concertModel->getConcerts();
        $reductions=$this->reducitonModel->getReduction();

        require "app/views/buyTicket.view.php";
    }
}