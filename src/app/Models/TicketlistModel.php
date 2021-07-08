<?php


class TicketlistModel
{
    //Hauptrüchgabe für
    public function getTicketlist(){
        $pdo=db();
        $pre=$pdo->prepare('
            SELECT u.userid, u.firstname, u.lastname, u.email, u.phone, r.reductionid, r.reduction,
            r.paytime, o.orderid, o.ispayed, o.orderdate, DATE_ADD(o.orderdate, INTERVAL 
                (SELECT w.paytime FROM reduction AS w WHERE w.reductionid = r.reductionid) DAY)
                AS paydate, c.concertid, c.artist FROM orders AS o
            JOIN concerts AS c ON o.fk_concertid = c.concertid
            JOIN users AS u ON o.fk_userid = u.userid
            JOIN reduction AS r ON r.reductionid = o.fk_reductionid 
            WHERE o.ispayed IS NOT TRUE
            ORDER BY paydate ASC;'
        );
        $pre->execute();
        return $pre->fetchAll();
    }

    //Funktion zum eintragen von Funkitonen in die Datenbank, sie wird nur aufgerufen, wenn die daten die Prüfung überstanden haben
    public function insertTicket($firstname, $lastname, $email, $phone, $reductionid, $concertid){
        $pdo=db();
        //Einbinden des UserModel.php Models
        require 'UserModel.php';
        $userModel = new UserModel();
        $userid = $userModel->selectUser($firstname, $lastname, $email);

        //Fals der User noch nicht exixstiert wird ein neuer angelegt
        if($userid === 0) {
            $userInsert = $pdo->prepare('INSERT INTO users(firstname, lastname, email, phone) VALUES ( :firstname, :lastname, :email, :phone)');
            $userInsert->bindParam(':firstname', $firstname);
            $userInsert->bindParam(':lastname', $lastname);
            $userInsert->bindParam(':email', $email);
            $userInsert->bindParam(':phone', $phone);
            $userInsert->execute();
            $userid = $pdo->lastInsertId();
        }

        $dateNow = new DateTime("Now");
        $orderDate = $dateNow->format("Y-d-m");

        $orderInsert=$pdo->prepare('INSERT INTO orders(fk_userid, fk_concertid, orderdate, fk_reductionid) VALUES (:userid, :concertid, :orderdate, :reductionid)');
        $orderInsert->bindParam(':userid', $userid);
        $orderInsert->bindParam(':concertid', $concertid);
        $orderInsert->bindParam(':orderdate', $orderDate);
        $orderInsert->bindParam(':reductionid', $reductionid);
        $orderInsert->execute();
    }
}
