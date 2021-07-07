<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
</head>
<body>
    <table>
        <thead>>
        <tr><th></th><th>Ticket</th><th>Action</th></tr>
        </thead>
        <?php foreach($tickets as $ticket){ ?>

        <?php } ?>
        <td><button id="add">Add</button></td>
    </table>



</body>
</html>