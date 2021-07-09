<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">

    <!-- Einbinden der Scripts aus navbarHead -->
    <?php require 'app/Views/navbarHead.view.php'?>
</head>
<body onload="validation('buyTicket')">
    <!-- Einbinden der Navbar -->
    <?php require 'app/Views/navbarBody.view.php'?>

    <!-- Form validation (Collapsable) -->
    <form action="buyvalidation" id="loginForm" method="Post">
        <label for="personal_data">Insert Date</label>
        <fieldset id="personal_data">

            <!-- Tabellenstruktur für design -->
            <table>
                <tablebody>
                    <tr>
                        <!-- Vornamenfeld -->
                        <td><label for="firstname">Firstname: </label></td>
                        <td><input type="text" id="firstname" name="firstname" value="<?php if(isset($ticketdata['firstname'])) echo$ticketdata['firstname']; ?>"></td>
                        <td><?php if(isset($errors['firstname'])) echo $errors['firstname'] ?></td>
                    </tr>
                    <tr>
                        <!-- Nachnamenfeld -->
                        <td><label for="lastname">Lastname: </label></td>
                        <td><input type="text" id="lastname" name="lastname" value="<?php if(isset($ticketdata['lastname'])) echo $ticketdata['lastname']; ?>">
                        <td><?php if(isset($errors['lastname'])) echo $errors['lastname'] ?></td>
                    </tr>
                    <tr>
                        <!-- Emailfeld -->
                        <td><label for="email">EMail: </label></td>
                        <td><input type="email" id="email" name="email" value="<?php if(isset($ticketdata['email'])) echo $ticketdata['email']; ?>"></td>
                        <td><?php if(isset($errors['email'])) echo $errors['email'] ?></td>
                    </tr>
                    <tr>
                        <!-- Telefonnummer -->
                        <td><label for="tel">phone number: </label></td>
                        <td><input type="text" id="tel" name="tel" value="<?php if(isset($ticketdata['phone'])) echo $ticketdata['phone']; ?>"></td>
                        <td><?php if(isset($errors['phone'])) echo $errors['phone'] ?></td>
                    </tr>
                    <tr>
                        <!-- Reduktion (Selected Wert anhand der Daten aus Datenbank) -->
                        <td><label for="reduction">Reduction: </label></td>
                        <td>
                            <select class=selectreduciton id="reduction" name="reduction" style="width:100%" onchange="calcPayDate(this, 'payDateLabel')">
                                <option value="">Select a Reduction....</option>
                                <?php foreach ($reductions as $reduction) {
                                    echo '<option value="' . $reduction['reductionid'] . '"';
                                    if(isset($ticketdata['reductionid'])){
                                        if($ticketdata['reductionid'] === $reduction['reductionid']) echo 'selected';
                                    }
                                    echo '>' . $reduction['reduction'] . '%</option>';
                                } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['reduction'])) echo $errors['reduction'] ?></td>
                    </tr>
                    <tr>
                        <!-- js Zahlvariable (zu zahlen bis) -->
                        <td><label for="payDateLabel">To pay until:</label></td>
                        <td><label id="payDateLabel" class="payDateLabel"></label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <!-- Concertfeld -->
                        <td><label for="concert">Concert: </label></td>
                        <td>
                            <select class=selectconcert id="concert" name="concert" style="width:100%">
                                <option value="">Select an Artist....</option>
                                <?php foreach ($concerts as $concert) {
                                    echo '<option value="' . $concert['concertid'] . '"';
                                    if(isset($ticketdata['concertid'])){
                                        if($ticketdata['concertid'] === $concert['concertid']) echo 'selected';
                                    }
                                    echo '>' . $concert['artist'] . '</option>';
                                } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['concert'])) echo $errors['concert'] ?></td>
                    </tr>
                </tablebody>
            </table>
        </fieldset>
        <input type="reset" name="reset" value="Cancel">
        <input type="submit" name="submit" value="Buy Ticket">
    </form>
</body>
</html>