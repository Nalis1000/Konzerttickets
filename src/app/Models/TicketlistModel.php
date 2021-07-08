<?php


class TicketlistModel
{
    //Hauptrüchgabe für
    public function getTicketlist(){
        $pdo=db();
        $pre=$pdo->prepare('
            SELECT u.userid, u.firstname, u.lastname, u.email, u.phone, r.reductionid, r.reduction,
            r.paytime, o.orderid, o.ispayed, o.orderdate, o.paydate, c.artist FROM orders AS o JOIN concerts AS c ON o.fk_concertid = c.concertid 
            JOIN users AS u ON o.fk_userid = u.userid
            JOIN reduction AS r ON r.reductionid = o.fk_reductionid; '
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
        $payDate = $this->getPayDate($reductionid);

        $orderInsert=$pdo->prepare('INSERT INTO orders(fk_userid, fk_concertid, orderdate, paydate, fk_reductionid) VALUES (:userid, :concertid, :orderdate, :paydate, :reductionid)');
        $orderInsert->bindParam(':userid', $userid);
        $orderInsert->bindParam(':concertid', $concertid);
        $orderInsert->bindParam(':orderdate', $orderDate);
        $orderInsert->bindParam(':reductionid', $reductionid);
        $orderInsert->bindParam(':paydate', $payDate);
        $orderInsert->execute();
    }

    //Gibt zurück, bis wann gezahlt werden muss anhand der Auswahl des Bonuses
    public function getPayDate($reductionid){
        $reductionQuery = db()->prepare('SELECT paytime FROM reduction WHERE reductionid = :reductionid');
        $reductionQuery->bindParam(':reductionid', $reductionid);
        $reductionQuery->execute();
        $result = $reductionQuery->fetch();

        //Abspeichern der Zahlzeit (Tage) in Variable
        echo $result['paytime'];
        $addTime = $result['paytime'];

        //erstellen DateTime objekt und hinzufügen der Tage
        $paydate = new DateTime("Now");
        $paydate->modify("+$addTime day");
        return $paydate->format("Y-d-m");
    }
}
