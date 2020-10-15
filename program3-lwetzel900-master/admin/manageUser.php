<?php include '../view/header.php'; ?>
<?php if(!isset($_SESSION)){
    header("Location: .");
}?>
<main>
    <br>
    <table>
        <tr>
            <!--<th>ID</th>-->
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>&nbsp;</th>
        </tr>

        <?php foreach ($allUsers as $user) : ?>
            <tr>
                <!--<td><?php echo htmlspecialchars($user['userID']) ?></td>-->
                <td><?php echo htmlspecialchars($user['fName'] . ' ' . $user['lName']) ?></td>
                <td><?php echo htmlspecialchars($user['email']) ?></td>
                <td><?php echo htmlspecialchars($user['phone']) ?></td>

                <td><form action="." method="post">
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="hidden" name="userID" value="<?php echo htmlspecialchars($user['userID']); ?>">
                        <input type="submit" value="Delete">
                    </form></td>
            </tr>
        <?php endforeach; ?>
    </table><br>

    <p><a href=".?action=adminWork">Admin Home</a></p>
    <p><a href=".?action=logout">Logout</a></p>
</main>

<?php include '../view/footer.php'; ?>

