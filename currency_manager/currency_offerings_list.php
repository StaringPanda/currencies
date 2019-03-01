<?php include '../includes/header.php'; ?>
<main>

    <h1>Currency Offerings List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($currency_offerings as $currency_offering) : ?>
        <tr>
            <td><?php echo $currency_offering['currencyOfferingTitle']; ?></td>
            <td>
                <form id="delete_currency_form"
                      action="index.php" method="post">
                    <input type="hidden" name="action" value="delete_currency_offering">
                    <input type="hidden" name="currency_offering_id"
                           value="<?php echo $currency_offering['currencyOfferingID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br />

    <h2>Add Currency Offering</h2>
    <form id="add_currency_form"
          action="index.php" method="post">
        <input type="hidden" name="action" value="add_currency_offering">

        <label>Name:</label>
        <input type="input" name="name">
        <input type="submit" value="Add">
    </form>
    <br>
    
    <p><a href="index.php?action=list_currencies">List Currency Offerings</a></p>

</main>
<?php include '../includes/footer.php'; ?>