<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">

    <link rel="stylesheet" href="public/css/collapsiblestylesheet.css">
    <script src="public/js/collapsible.js"></script>
</head>
<body>
    <table>
        <thead>
        <tr><th></th><th>Ticket</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php /** @var TYPE_NAME $tickets */
        foreach($tickets as $ticket){ ?>
        <tr>
            <td>
                <input type="checkbox" id="paid" name="paid"value="<?php $ticket['orderid']?>">
            </td>
            <td>
                <button type="button" class="collapsible">Name:  <?= $ticket['lastname']." ".$ticket['firstname']."   "."Concert: ".$ticket['artist']?></button>
                <div class="content">
                    <div class="container">
                        <form id="editTicket" name="editTicket" action="ticketlist" method="post">
                        <table>
                            <thead><tr><th></th><th></th><th></th><th></th></tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>
                                    <label for="lastname">Lastname: </label><br>
                                    <label for="firstname">Firstname: </label><br>
                                    <label for="email">EMail: </label><br>
                                    <label for="tel">phone number: </label><br><br><br><br><br><br>

                                </td>
                                <td>
                                    <input type="text" id="lastname" name="lastname"><br>
                                    <input type="text" id="firstname" name="firstname"><br>
                                    <input type="email" id="email" name="email"><br>
                                    <input type="text" id="tel" name="tel">
                                    <label for="reduction">Reduction: </label><br>
                                    <select class=selectreduciton id="reduction" name="reduction" style="width:100%">
                                        <option value="">Select a Reduction....</option>
                                        <?php foreach ($reductions as $reduction) {
                                            echo '<option value="' . $reduction['reductionid'] . '">' . $reduction['reduction'] . '%</option>';
                                        } ?>
                                    </select><br><br>

                                    <input type="reset" name="reset" value="Cancel"><br>

                                </td>
                                <td>

                                    </fieldset>
                                    <label for="concert_data">Concert Data: </label>
                                    <fieldset id="concert_data">
                                        <label for="concert">Concert: </label><br>
                                        <select class=selectconcert id="concert" name="concert" style="width:100%">
                                            <option value="">Select an Artist....</option>
                                            <?php foreach ($concerts as $concert) {
                                                echo '<option value="' . $concert['concertid'] . '">' . $concert['artist'] . '</option>';
                                            } ?>
                                        </select>
                                    </fieldset>

                                        <input type="submit" name="submit" value="Buy Ticket">
                                </td>
                                <td>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
        <tr><td><button id="add">Add</button></td></tr>
        </tbody>

    </table>



</body>
</html>