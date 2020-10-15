<?php include '../view/header.php'; ?>
<?php
if (!isset($_SESSION)) {
    header("Location: .");
}
?>
<main>
    <br>

    <form id="aligned" action="" method="post">
        <input type="hidden" name="action" value="selectServices">
        <h2>Select a service</h2>
        <table>
            <tr>
                <th>Service Type</th>
                <th>Description</th>
                <th>Picture</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($venueServices as $service) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['serviceType']) ?></td>
                    <td><?php echo htmlspecialchars($service['serviceDescription']) ?></td>
                    <td><image src="<?php echo htmlspecialchars('/' . $basedir . '/' . $service['servicePic']); ?>" 
                               height="40" width="80"></td>
                    <td><input type="checkbox" name="services[]" 
                               value="<?php echo htmlspecialchars($service['serviceID']); ?>"></td>
                </tr>
            <?php endforeach; ?>
        </table><br>

        <label>&nbsp;</label>
        <input type="submit" value="Select">
    </form><br>

    <form id="aligned" class="cancel" action="." method="post">
        <input type="hidden" name="action" value="showOptions">
        <input type="submit" value="Cancel">
    </form><br>

    <p><a href=".?action=logout">Logout</a></p>
</main>
<?php include '../view/footer.php'; ?>