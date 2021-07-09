<?php


class TicketlistModel
{
    var $userModel = '';

    //Hauptrückgabe aller daten für die Ticketlist ausgabe
    public function getTicketlist(){
        $pdo=db();
        //QUERY gibt alle wichtigen werte zurück inklusive des berechneten Zahldatums
        $pre=$pdo->prepare('
            SELECT u.userid, u.firstname, u.lastname, u.email, u.phone, r.reductionid, r.reduction,
            r.paytime, o.orderid, o.ispayed, o.orderdate, DATE_FORMAT(DATE_ADD(o.orderdate, INTERVAL 
                (SELECT w.paytime FROM reduction AS w WHERE w.reductionid = r.reductionid) DAY), "%d.%m.%Y")
                                  AS paydate,
                   DATE_FORMAT(DATE_ADD(o.orderdate, INTERVAL 
                (SELECT w.paytime FROM reduction AS w WHERE w.reductionid = r.reductionid) DAY), "%Y.%m.%d") AS sortDate,
                   c.concertid, c.artist FROM orders AS o
            JOIN concerts AS c ON o.fk_concertid = c.concertid
            JOIN users AS u ON o.fk_userid = u.userid
            JOIN reduction AS r ON r.reductionid = o.fk_reductionid 
            WHERE o.ispayed IS NOT TRUE
            ORDER BY sortDate ASC;'
        );
        $pre->execute();
        return $pre->fetchAll();
    }

    //Funktion zum eintragen von Funkitonen in die Datenbank, sie wird nur aufgerufen, wenn die daten die Prüfung überstanden haben
    public function insertTicket($firstname, $lastname, $email, $phone, $reductionid, $concertid){
        $pdo=db();
        //Einbinden des UserModel.php Models, von welcher wir die funkitonen gebrauchen
        require 'UserModel.php';
        if($this->userModel === '') {
            $this->userModel = new UserModel();
        }
        $userid = $this->userModel->selectUser($firstname, $lastname, $email);

        //Fals der User noch nicht exixstiert wird ein neuer angelegt
        if($userid === 0) {
            $userid = $this->userModel->insertUser($firstname, $lastname, $email, $phone);
        }

        //Auslsen des Aktuellen datums (Heute)
        $dateNow = new DateTime("Now");
        $orderDate = $dateNow->format("Y-d-m");

        //Einfügen der Daten in die Datenbank
        $orderInsert=$pdo->prepare('INSERT INTO orders(fk_userid, fk_concertid, orderdate, fk_reductionid, ispayed) VALUES (:userid, :concertid, :orderdate, :reductionid, 0)');
        $orderInsert->bindParam(':userid', $userid);
        $orderInsert->bindParam(':concertid', $concertid);
        $orderInsert->bindParam(':orderdate', $orderDate);
        $orderInsert->bindParam(':reductionid', $reductionid);
        $orderInsert->execute();
    }

    //Funktion zur bearbeitung der Tickets (orders)
    public function editTicket($firstname, $lastname, $email, $phone, $reductionid, $concertid, $orderid){
        //Einbinden UserModel.php da funktionen davon benötigt werden
        require 'UserModel.php';
        $pdo = db();
        if($this->userModel === '') {
            $this->userModel = new UserModel();
        }
        $userid = $this->userModel->selectUser($firstname, $lastname, $email);

        if($userid === 0){
            $userid = $this->userModel->insertUser($firstname, $lastname, $email, $phone);
        }

        //Edittieren der Einträge
        //wird immer ausgeführt, auch wenn keinen änderungen vorgenommen werden
        //Aufgrund der zeit konnten wir das nicht mehr anpassen
        $orderEdit = $pdo->prepare('UPDATE orders SET fk_userid = :userid, fk_reductionid = :reductionid, fk_concertid = :concertid WHERE orderid = :orderid');
        $orderEdit->bindParam(':userid' , $userid);
        $orderEdit->bindParam(':reductionid', $reductionid);
        $orderEdit->bindParam(':concertid', $concertid);
        $orderEdit->bindParam(':orderid', $orderid);
        $orderEdit->execute();

    }
    public function updatepaid($ispayed,$orderid){
        $pdo=db();
        $paidupdate=$pdo->prepare('UPDATE orders SET ispayed=:ispayed WHERE orderid=:orderid');
        $paidupdate->bindParam(':ispayed',$ispayed);
        $paidupdate->bindParam(':orderid',$orderid);
        $paidupdate->execute();
        echo $ispayed;
    }
}
