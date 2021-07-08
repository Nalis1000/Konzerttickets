<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <link href="src/public/css/bootstrap-css/bootstrap.css">
    <script href="src/public/js/bootstrap-js/bootstrap.bundle.js"></script>
</head>
<body>
    <table>
        <thead>>
        <tr><th></th><th>Ticket</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach($tickets as $ticket){ ?>
        <tr><td><input type="checkbox" id="paid" name="paid"value="<?php $ticket['orderid']?>"></td>
            <button data-toggle="collapse" data-target="#<?php $ticket['orderid']?>" id="ticket"><?='Name: ' .e($ticket['lastname']." ".e($tickets['firstname']).
                'Concert: ' .e($ticket['artist']);?></button>

            <td></td></tr>
        <?php } ?>
        </tbody>
        <<td><button id="add">Add</button></td>
    </table>



</body>
</html>