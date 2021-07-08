<?php


class ReductionModel
{
    //Erhalten der Reduktion anhand der Eingetragenen daten
    public function getReduction(){
        $pdo=db();
        $pre=$pdo->prepare('SELECT * FROM reduction ORDER BY reductionid ASC');
        $pre->execute();
        return $pre->fetchAll();
    }
}