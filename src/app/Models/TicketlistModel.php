<?php


class TicketlistModel
{
    public function getTicketlist(){
        $pdo=db();
        $pre=$pdo->prepare('
            SELECT u.userid, u.firstname, u.lastname, u.email, u.phone, r.reduction,
            r.paytime, o.ispayed, o.orderid, c.artist FROM orders AS o JOIN concerts AS c ON o.fk_concertid = c.concertid 
            JOIN users AS u ON o.fk_userid = u.userid
            JOIN reduction AS r ON r.reductionid = u.fk_reductionid; '
        );
        $pre->execute();
        return $pre->fetchAll();
    }

    //Funktion zum eintragen von Funkitonen in die Datenbank, sie wird nur aufgerufen, wenn die daten die Prüfung überstanden haben
    public function newTicket(){
        $pdo=db();
        $userInsert=$pdo->prepare('INSERT INTO users(firstname, lastname, email, phone, fk_reductionid) VALUES ( :firstname, :lastname, :email, :phone, :reductionid)');
        $userInsert->bindParam(':firstname', $_POST['firstname']);
        $userInsert->bindParam(':lastname', $_POST['lastname']);
        $userInsert->bindParam(':email', $_POST['email']);
        $userInsert->bindParam(':phone', $_POST['tel']);
        $userInsert->bindParam(':reductionid', $_POST['reduction']);
        $userInsert->execute();

        $lastid = $pdo->lastInsertId();
        $orderInsert=$pdo->prepare('INSERT INTO orders(fk_userid, fk_concertid) VALUES (:userid, :concertid)');
        $orderInsert->bindParam(':userid', $lastid);
        $orderInsert->bindParam(':concertid', $_POST['concert']);
        $orderInsert->execute();
    }
}
