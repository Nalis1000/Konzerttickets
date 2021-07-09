<?php


class ticketlistController
{
    var $concertModel = '';
    var $reducitonModel = '';
    var $ticketlistModel= '';

    function index(){
    //require "app/Models/TicketlistModel.php";
    //require 'app/Models/ConcertModel.php';
    //require 'app/Models/ReductionModel.php';
    if($this->ticketlistModel === ''){
        $this->ticketlistModel = new TicketlistModel();
    }
    if($this->concertModel === ''){
        $this->concertModel = new ConcertModel();
    }
    if($this->reducitonModel === ''){
        $this->reducitonModel = new ReductionModel();
    }
    $reductions=$this->reducitonModel->getReduction();
    $concerts=$this->concertModel->getConcerts();
    $tickets= $this->ticketlistModel->getTicketlist();

    require 'app/views/ticketlist.view.php';
}
}