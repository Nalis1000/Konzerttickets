<?php


class ValidationController
{
    var $ticketlistModel = '';

    function ticketBuyValidation(){
        if($_SERVER['REQUEST_METHOD']==='POST') {
            require 'app/Models/TicketlistModel.php';

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
            $reduction = trim($_POST['reduction']);
            $concert = trim($_POST['concert']);

            if(strlen($firstname) < 1){
                $errors['firstname'] = 'Firstname must consist of more than 0 characters';
            }

            if(!preg_match('/^[\+\-\/ 0-9]+$/', $phone)){
                $errors['phone'] = 'Phone number may only contain + and numbers [0-9]';
            }

            if($errors['errorCount'] === 0) {
                if ($this->ticketlistModel === '') {
                    $this->ticketlistModel = new TicketlistModel();
                }
                $this->ticketlistModel->newTicket();

                var_dump($this->ticketlistModel->getTicketlist());
                header('Location: ' . ROOT_URL . '/newTicket');
            }else{
                //Error Message
            }
        }
    }
}