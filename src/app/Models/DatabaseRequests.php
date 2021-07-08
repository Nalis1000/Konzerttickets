<?php


class DatabaseRequests
{
    public static function getConcerts(){
        $pdo=db();
        $pre=$pdo->prepare('SELECT * FROM concerts ORDER BY artist ASC, concertid ');
        $pre->execute();
        return $pre->fetchAll();
    }
}