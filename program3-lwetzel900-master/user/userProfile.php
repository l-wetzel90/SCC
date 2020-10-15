<?php include '../view/header.php'; ?>
<?php if(!isset($_SESSION)){
    header("Location: .");
}?>
<main>
    <br>
    <p>Welcome <?php echo htmlspecialchars("$fName $lName") ?></p>
    <br>
    <input type="hidden" name="action" value="userProfile">
    <?PHP if (empty($allTogether)) : ?>
        <p>You haven't picked out anything yet...</p>
        <br>
        <p>Please choose some <a href=".?action=showOptions">options</a> from our venues and services</p>
        <br>
    <?php else: ?>
        <p>your options</p>
        <br>
        <?php foreach ($allTogether as $key => $something) : ?>
            <table>
                <tr>
                    <th><?php echo htmlspecialchars("$key") ?></th>
                </tr>

                <?php foreach ($something as $key => $val): ?>
                    <tr>
                        <td><?php echo htmlspecialchars("$val") ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
        <?php endforeach; ?>
    <?PHP endif; ?><br>
    
    <p>To update services at each venue, please pick <a href=".?action=showOptions">options</a></p>
    <p><a href=".?action=logout">Logout</a></p>
</main>
<?php include '../view/footer.php'; ?>
