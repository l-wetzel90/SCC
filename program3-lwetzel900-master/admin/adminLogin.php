<?php include '../view/header.php'; ?>
<main>

    <p><?php echo htmlspecialchars($errorMessage); ?></p>

    <form action="" method="post" id="aligned">
        <!--for the control-->
        <input type="hidden" name="action" value="admin">

        <label>Password:</label>
        <input type="password" name="password"> <br>

        <label>&nbsp;</label>
        <input type="submit" value="Login"><br>

    </form>
    <p>password is Password123</p>
    <br><br>
</main>

<?php include '../view/footer.php'; ?>


