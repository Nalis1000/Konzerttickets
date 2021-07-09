<?php


class ticketlistController
{
    var $concertModel = '';
    var $reducitonModel = '';
    var $ticketlistModel= '';

    function index(){
        //Erstellen der Verschiedenen klassen
        if($this->ticketlistModel === ''){
            $this->ticketlistModel = new TicketlistModel();
        }
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        //Bekommen der Daten aus Datenbankquerys (getReduction, getConcert, getTicketlist)
        $reductions=$this->reducitonModel->getReduction();
        $concerts=$this->concertModel->getConcerts();
        $tickets= $this->ticketlistModel->getTicketlist();

        //Einbinden der View
        require 'app/views/ticketlist.view.php';
}
}