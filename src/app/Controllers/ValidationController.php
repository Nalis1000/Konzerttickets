<?php


class ValidationController
{
    //Membervariablen zum Lokalen speichern der Objekte
    var $ticketlistModel = '';
    var $concertModel = '';
    var $reducitonModel = '';

    //Validierung von buyTicket.View eingabedaten (Serverside)
    function ticketBuyValidation(){
        //Validirung der Daten
        if($_SERVER['REQUEST_METHOD']==='POST') {

            //getPostData gebt die Daten aus dem $_POST zurück (als array)
            $ticketdata = $this->getPostData();

            //Validiert die ganzen daten (Serverside Validation)
            $errors = $this->validate($ticketdata);

            //Falls keine Fehler / eingabefehler
            if($errors['errorCount'] === 0) {
                if ($this->ticketlistModel === '') {
                    $this->ticketlistModel = new TicketlistModel();
                }
                //Daten werden in Datenbank eingetragen
                $this->ticketlistModel->insertTicket($ticketdata['firstname'], $ticketdata['lastname'],
                    $ticketdata['email'], $ticketdata['phone'], $ticketdata['reductionid'], $ticketdata['concertid']);

                //Zurück zum Form, falls man mehrere Einträge machen möchte
                header('Location: ' . ROOT_URL . '/newticket');
            }
        }
        //Erstellen neue ConcertModel und ReductionModel objekte falls noch keine vorhanden
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        //Aufrufen der Funktionen
        $concerts=$this->concertModel->getConcerts();
        $reductions=$this->reducitonModel->getReduction();

        //Einbinden des Views (nur bei Falschinformationen)
        require 'app/Views/buyTicket.view.php';
    }

    //Funktion die von ticketlist.View.php als validierung aufgerufen wird
    function ticketEditValidation(){
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $editdata = $this->getPostData();
            $errors = $this->validate($editdata);


            if($errors['errorCount'] === 0) {
                if ($this->ticketlistModel === '') {
                    $this->ticketlistModel = new TicketlistModel();
                }
                //Funktion zum bearbeiten der daten
                $this->ticketlistModel->editTicket($editdata['firstname'], $editdata['lastname'],
                    $editdata['email'], $editdata['phone'], $editdata['reductionid'], $editdata['concertid'], $editdata['orderid']);

                header('Location: ' . ROOT_URL . '/ticketlist');
            }
        }

        if ($this->ticketlistModel === '') {
            $this->ticketlistModel = new TicketlistModel();
        }
        if($this->concertModel === ''){
            $this->concertModel = new ConcertModel();
        }
        if($this->reducitonModel === ''){
            $this->reducitonModel = new ReductionModel();
        }

        //Laden der Daten aus Datenbank für anzeigen des Views (wird nur bei falscheingabe ausgeführt)
        $concerts=$this->concertModel->getConcerts();
        $reductions=$this->reducitonModel->getReduction();
        $tickets=$this->ticketlistModel->getTicketlist();

        //Einfache Warnmeldung bei Versuchter Falscheingabe im Bearbeiten Form (keine zeit für ausführliche Fehlermeldung)
        echo '<script> alert(\'Values not allowed, Changes Reset and not Pushed in Database\nFor more details open edited Ticket\') </script>';

        require 'app/Views/ticketlist.view.php';

    }

    //Validiert die per array mitgegebenen Daten und gibt das Fehlerarray zurück
    public function validate(array $data) : array {
        $errors = [
            'errorCount' => 0,
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'phone' => '',
            'reduction' => '',
            'concert' => '',
        ];

        if(strlen($data['firstname']) < 1){
            $errors['errorCount']++;
            $errors['firstname'] = 'Firstname must consist of more than 0 characters';
        }
        if(strlen($data['lastname']) < 1){
            $errors['errorCount']++;
            $errors['lastname'] = 'Lastname must consist of more than 0 characters';
        }
        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $data['email'])){
            $errors['errorCount']++;
            $errors['email'] = 'Email invalid, please check input';
        }
        if($data['reductionid'] === ""){
            $errors['errorCount']++;
            $errors['reduction'] = 'Please Select a reduction';
        }
        if($data['concertid'] === ""){
            $errors['errorCount']++;
            $errors['concert'] = 'Please Select a concert';
        }
        if(!preg_match('/^[\+\-\/ 0-9]+$/', $data['phone']) && strlen($data['phone']) > 0){
            $errors['errorCount']++;
            $errors['phone'] = 'Phone number may only contain + and numbers [0-9]';
        }

        return $errors;
    }

    // Holt einträge aus Post und speichert diese in einem Array
    public function getPostData() : array {
        $postData = [
            'firstname' => strtolower(trim($_POST['firstname'])),
            'lastname' => strtolower(trim($_POST['lastname'])),
            'email' => strtolower(trim($_POST['email'])),
            'phone' => strtolower(trim($_POST['tel'])),
            'reductionid' => strtolower(trim($_POST['reduction'])),
            'concertid' => strtolower(trim($_POST['concert'])),
            'orderid' => '',
        ];
        if(isset($_POST['orderid'])){
            $postData['orderid'] = strtolower(trim($_POST['orderid']));
        }

        return $postData;
    }
}