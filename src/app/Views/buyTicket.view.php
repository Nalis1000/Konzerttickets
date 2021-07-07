<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
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
            <label for="concert">Concert: </label><br>
            <select class=selectconcert id="concert" name="concert" style="width:100%">
                <option value="">Select a state....</option>
            <?php foreach($concerts as $concert){
                echo '<option value="'. $concert['artist'].'">'.$concert['artist'].'</option>';
            }?>

            </select>
        </fieldset>

    </form>


</body>
</html>