<?php


class ValidationController
{
    function ticketBuyValidation(){
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phone = $_POST['tel'];
            $reduction = $_POST['reduction'];
            $concert = $_POST['concert'];

        }
        echo'success';
        require 'app/views/buyTicket.view.php';
    }
}