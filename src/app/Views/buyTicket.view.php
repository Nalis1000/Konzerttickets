<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <!--<link rel="stylesheet" href="public/css/app.css">-->
</head>
<body>
    <form>
        <label for="personal_data" >Personal Data:</label>
        <fieldset id="personal_data">
            <label for="lastname">Lastname: </label>
            <input type="text" id="lastname" name="lastname"><br>
            <label for="firstname">Firstname: </label>
            <input type="text" id="firstname" name="firstname"><br>
            <label for="tel">telephone number: </label>
            <input type="text" id="tel" name="tel"><br>
        </fieldset>
        <label for="concert_data">Concert Data: </label>
        <fieldset id="concert_data">
            <label for="concert">Concert: </label>
            <select id="concert" name="concert">
            <?php foreach($concerts as $concert){?>
                <option value=<?php $concert['artist']?>
            <?php }?>

            </select>
        </fieldset>

    </form>


</body>
</html>