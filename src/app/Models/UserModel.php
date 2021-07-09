<?php


class UserModel
{
    //Funktion schaut, ob es schon einen Benutzer mit demselben namen und Email gibt, wenn ja gibt er ihn zurück
    public function selectUser($firstname, $lastname, $email): int
    {
        $userQuery = db()->prepare('SELECT * FROM users WHERE users.firstname= :firstname AND users.lastname= :lastname AND users.email= :email;');
        $userQuery->bindParam(':firstname', $firstname);
        $userQuery->bindParam(':lastname', $lastname);
        $userQuery->bindParam(':email', $email);
        $userQuery->execute();
        $result = $userQuery->fetch();

        return $result['userid'] ?? 0;
    }

    public function insertUser($firstname, $lastname, $email, $phone) : int {
        $pdo = db();
        $userInsert = $pdo->prepare('INSERT INTO users(firstname, lastname, email, phone) VALUES ( :firstname, :lastname, :email, :phone)');
        $userInsert->bindParam(':firstname', $firstname);
        $userInsert->bindParam(':lastname', $lastname);
        $userInsert->bindParam(':email', $email);
        $userInsert->bindParam(':phone', $phone);
        $userInsert->execute();
        return $pdo->lastInsertId();
    }
}