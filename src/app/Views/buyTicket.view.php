<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>New Buy Order</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
<body>
    <form action="buyvalidation" id="loginForm" method="Post">
        <label for="personal_data">Personal Data:</label>
        <fieldset id="personal_data">
            <table>
                <tablebody>
                    <tr>
                        <td><label for="firstname">Firstname: </label></td>
                        <td><input type="text" id="firstname" name="firstname" value="<?php if(isset($firstname)) echo $firstname; ?>"></td>
                        <td><?php if(isset($errors['firstname'])) echo $errors['firstname'] ?></td>
                    </tr>
                    <tr>
                        <td><label for="lastname">Lastname: </label></td>
                        <td><input type="text" id="lastname" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>">
                        <td><?php if(isset($errors['lastname'])) echo $errors['lastname'] ?></td>
                    </tr>
                    <tr>
                        <td><label for="email">EMail: </label></td>
                        <td><input type="email" id="email" name="email" value="<?php if(isset($email)) echo $email; ?>"></td>
                        <td><?php if(isset($errors['email'])) echo $errors['email'] ?></td>
                    </tr>
                    <tr>
                        <td><label for="tel">phone number: </label></td>
                        <td><input type="text" id="tel" name="tel" value="<?php if(isset($phone)) echo $phone; ?>"></td>
                        <td><?php if(isset($errors['phone'])) echo $errors['phone'] ?></td>
                    </tr>
                    <tr>
                        <td><label for="reduction">Reduction: </label></td>
                        <td>
                            <select class=selectreduciton id="reduction" name="reduction" style="width:100%">
                                <option value="">Select a Reduction....</option>
                                <?php foreach ($reductions as $reduction) {
                                    echo '<option value="' . $reduction['reductionid'] . '"';
                                    if(isset($reductionid)){
                                        if($reductionid === $reduction['reductionid']) echo 'selected';
                                    }
                                    echo '>' . $reduction['reduction'] . '%</option>';
                                } ?>
                            </select>
                        </td>
                        <td><?php if(isset($errors['reduction'])) echo $errors['reduction'] ?></td>
                    </tr>
                </tablebody>
            </table>
        </fieldset>
        <label for="concert_data">Concert Data: </label>
        <fieldset id="concert_data">
            <table>
                <tablebody>
                    <tr>
                        <td><label for="concert">Concert: </label></td>
                        <td>
                            <select class=selectconcert id="concert" name="concert" style="width:100%">
                                <option value="">Select an Artist....</option>
                                <?php foreach ($concerts as $concert) {
                                    echo '<option value="' . $concert['concertid'] . '"';
                                    if(isset($concertid)){
                                        if($concertid === $concert['concertid']) echo 'selected';
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