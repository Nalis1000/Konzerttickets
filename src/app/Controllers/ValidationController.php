<?php


class ValidationController
{
    var $ticketlistModel = '';
    var $concertModel = '';
    var $reducitonModel = '';

    function ticketBuyValidation(){
        //require 'app/Models/ConcertModel.php';
        //require 'app/Models/ReductionModel.php';

        if($_SERVER['REQUEST_METHOD']==='POST') {
            //require 'app/Models/TicketlistModel.php';


            $errors = [
                'errorCount' => 0,
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'phone' => '',
                'reduction' => '',
                'concert' => '',
            ];

            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['tel']);
            $reductionid = trim($_POST['reduction']);
            $concertid = trim($_POST['concert']);

            if(strlen($firstname) < 1){
                $errors['errorCount']++;
                $errors['firstname'] = 'Firstname must consist of more than 0 characters';
            }
            if(strlen($lastname) < 1){
                $errors['errorCount']++;
                $errors['lastname'] = 'Lastname must consist of more than 0 characters';
            }
            if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)){
                $errors['errorCount']++;
                $errors['email'] = 'Email invalid, please check input';
            }
            if($reductionid === ""){
                $errors['errorCount']++;
                $errors['reduction'] = 'Please Select a reduction';
            }
            if($concertid === ""){
                $errors['errorCount']++;
                $errors['concert'] = 'Please Select a concert';
            }
            if(!preg_match('/^[\+\-\/ 0-9]+$/', $phone) && strlen($phone) > 0){
                $errors['errorCount']++;
                $errors['phone'] = 'Phone number may only contain + and numbers [0-9]';
            }

            if($errors['errorCount'] === 0) {
                if ($this->ticketlistModel === '') {
                    $this->ticketlistModel = new TicketlistModel();
                }
                $this->ticketlistModel->insertTicket($firstname, $lastname, $email, $phone, $reductionid, $concertid);

                header('Location: ' . ROOT_URL . '/newticket');
            }
        }
        //Erstellen neue ConcertModel und ReductionModel objekte falls noch keine vorhanden
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        $concerts=$this->concertModel->getConcerts();
        $reductions=$this->reducitonModel->getReduction();

        require 'app/Views/buyTicket.view.php';
    }
}