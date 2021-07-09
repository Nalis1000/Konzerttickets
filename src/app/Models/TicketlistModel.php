<?php


class TicketlistModel
{
    var $userModel = '';

    //Hauptrüchgabe für
    public function getTicketlist(){
        $pdo=db();
        $pre=$pdo->prepare('
            SELECT u.userid, u.firstname, u.lastname, u.email, u.phone, r.reductionid, r.reduction,
            r.paytime, o.orderid, o.ispayed, o.orderdate, DATE_FORMAT(DATE_ADD(o.orderdate, INTERVAL 
                (SELECT w.paytime FROM reduction AS w WHERE w.reductionid = r.reductionid) DAY), "%d.%m.%Y")
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
        if($this->userModel === '') {
            $this->userModel = new UserModel();
        }
        $userid = $this->userModel->selectUser($firstname, $lastname, $email);

        //Fals der User noch nicht exixstiert wird ein neuer angelegt
        if($userid === 0) {
            $userid = $this->userModel->insertUser($firstname, $lastname, $email, $phone);
        }

        $dateNow = new DateTime("Now");
        $orderDate = $dateNow->format("Y-d-m");

        $orderInsert=$pdo->prepare('INSERT INTO orders(fk_userid, fk_concertid, orderdate, fk_reductionid, ispayed) VALUES (:userid, :concertid, :orderdate, :reductionid, 0)');
        $orderInsert->bindParam(':userid', $userid);
        $orderInsert->bindParam(':concertid', $concertid);
        $orderInsert->bindParam(':orderdate', $orderDate);
        $orderInsert->bindParam(':reductionid', $reductionid);
        $orderInsert->execute();
    }

    public function editTicket($firstname, $lastname, $email, $phone, $reductionid, $concertid, $orderid){
        require 'UserModel.php';
        $pdo = db();
        if($this->userModel === '') {
            $this->userModel = new UserModel();
        }
        $userid = $this->userModel->selectUser($firstname, $lastname, $email);

        if($userid === 0){
            $userid = $this->userModel->insertUser($firstname, $lastname, $email, $phone);
        }

        //Edit entry
        $orderEdit = $pdo->prepare('UPDATE orders SET fk_userid = :userid, fk_reductionid = :reductionid, fk_concertid = :concertid WHERE orderid = :orderid');
        $orderEdit->bindParam(':userid' , $userid);
        $orderEdit->bindParam(':reductionid', $reductionid);
        $orderEdit->bindParam(':concertid', $concertid);
        $orderEdit->bindParam(':orderid', $orderid);
        $orderEdit->execute();

    }
}
