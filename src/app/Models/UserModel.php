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
}