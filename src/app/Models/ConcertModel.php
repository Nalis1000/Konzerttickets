<?php


class ConcertModel
{
    //Funktion um alle Konzerte als Array zu erhalten
    public function getConcerts(){
        $pdo=db();
        $pre=$pdo->prepare('SELECT * FROM concerts ORDER BY artist ASC, concertid ');
        $pre->execute();
        return $pre->fetchAll();
    }

    public function addConcerts(){

    }
}