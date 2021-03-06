<?php


class ticketlistController
{
    var $concertModel = '';
    var $reducitonModel = '';
    var $ticketlistModel = '';

    function index(){
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


        require 'app/Views/ticketlist.view.php';
    }

    function addpaid()
    {
        if ($this->ticketlistModel === '') {
            $this->ticketlistModel = new TicketlistModel();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $orderid = $_POST['orderid'];
                $ispayed = $_POST['ispayed'];
                var_dump($orderid);
                if ($ispayed == 0 || $ispayed == "")
                    $ispayed = 1;
                else
                    $ispayed = 0;
                $this->ticketlistModel->updatepaid($ispayed, $orderid);
            }
        }
    }

}