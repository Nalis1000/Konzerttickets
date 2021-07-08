<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
</head>
<body>
    <form action="buyvalidation" id="loginForm" method="Post">
        <label for="personal_data">Personal Data:</label>
        <fieldset id="personal_data">
            <label for="lastname">Lastname: </label>
            <input type="text" id="lastname" name="lastname"><br>
            <label for="firstname">Firstname: </label>
            <input type="text" id="firstname" name="firstname"><br>
            <label for="email">EMail: </label>
            <input type="email" id="email" name="email"><br>
            <label for="tel">phone number: </label>
            <input type="text" id="tel" name="tel"><br>
            <label for="reduction">Reduction: </label><br>
            <select class=selectreduciton id="reduction" name="reduction" style="width:100%">
                <option value="">Select a Reduction....</option>
                <?php foreach ($reductions as $reduction) {
                    echo '<option value="' . $reduction['reductionid'] . '">' . $reduction['reduction'] . '%</option>';
                } ?>
            </select>
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
        <input type="reset" name="reset" value="Cancel">
        <input type="submit" name="submit" value="Buy Ticket">
    </form>
</body>
</html>