<?php


class buyTicketController
{
function index(){
    $pdo=db();
    $pre=$pdo->prepare('SELECT * FROM concerts ORDER BY artist ASC, concertid ');
    $pre->execute();
    $concerts=$pre->fetchAll();
    require "app/views/buyTicket.view.php";
}
}