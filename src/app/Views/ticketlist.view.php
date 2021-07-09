<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>TicketList</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <script src="public/js/paid.js"></script>
    <link rel="stylesheet" href="public/css/collapsiblestylesheet.css">
     <script src="public/js/collapsible.js"></script>
    <?php require 'app/Views/navbarHead.view.php'?>
</head>
<body>
    <?php require 'app/Views/navbarBody.view.php'?>
    <table>
        <thead>
        <tr><th><input type="checkbox" id="paid" name="paid"value=""></th><th>Ticket</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php /** @var TYPE_NAME $tickets */
        foreach($tickets as $ticket): ?>
        <tr>
            <td>

                <form name="<?= $ticket['orderid']?>">
                    <input type="hidden" name="orderid" value=<?= $ticket['orderid']?>>
                    <input type="checkbox" name="ispayed" id="ispayed" value=<?= $ticket['ispayed']?> onclick="pay(this.form)">
                </form>

            </td>
            <td>
                <button type="button" class="collapsible">
                    <?=$ticket['paydate']." Name: ".$ticket['lastname']." ".$ticket['firstname']."   "."Concert: ".$ticket['artist']?>
                </button>
                <div class="content">
                    <div class="container">
                        <form id="editTicket" name="editTicket" action="editvalidation" method="post">
                        <table>
                            <tbody>
                            <input type="hidden" name="orderid" id="orderid" value="<?= $ticket['orderid']?>">
                                <tr>
                                    <td><label for="firstname">Firstname: </label></td>
                                    <td><input type="text" id="firstname" name="firstname" value="<?= $ticket['firstname']?>"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="lastname">Lastname: </label></td>
                                    <td><input type="text" id="lastname" name="lastname" value="<?= $ticket['lastname']?>"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="email">EMail: </label></td>
                                    <td><input type="email" id="email" name="email" value="<?= $ticket['email']?>"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="tel">phone number: </label></td>
                                    <td><input type="text" id="tel" name="tel" value="<?= $ticket['phone']?>"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="reduction">Reduction: </label></td>
                                    <td>
                                        <select class=selectreduction id="reduction" name="reduction" style="width:100%">
                                            <option value="">Select a Reduction....</option>
                                            <?php foreach ($reductions as $reduction) {
                                                echo '<option value="' . $reduction['reductionid'] . '"';
                                                if($ticket['reductionid']===$reduction['reductionid']) echo 'selected';
                                                echo'>' . $reduction['reduction'] .'</option>';
                                            } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="concert">Concert: </label></td>
                                    <td>
                                        <select class=selectconcert id="concert" name="concert" style="width:100%">
                                            <option value="">Select an Artist....</option>
                                            <?php foreach ($concerts as $concert) {
                                                echo '<option value="' . $concert['concertid'] . '"';
                                                if($ticket['concertid']===$concert['concertid']) echo 'selected';
                                                echo '>' . $concert['artist'] . '</option>';
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            <tr>
                                <td><input type="reset" id="reset" name="reset" value="Cancel"></td>
                                <td><input type="submit" name="submit" value="Edit Entry"></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr><td><button id="add">Add</button></td></tr>
        </tbody>

    </table>



</body>
</html>