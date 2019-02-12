<?php include '../includes/header.php'; ?>
<main>
    <h1>Edit Currency</h1>
    <form action="index.php" method="post" id="add_currency_form">

        <input type="hidden" name="action" value="update_currency">

        <input type="hidden" name="currency_id"
               value="<?php echo $currency['currencyID']; ?>">

        <label>Category ID:</label>
        <input type="currency_offering_id" name="currency_offering_id"
               value="<?php echo $currency['currencyOfferingID']; ?>">
        <br>

        <label>Code:</label>
        <input type="input" name="code"
               value="<?php echo $currency['currencyCode']; ?>">
        <br>

        <label>Name:</label>
        <input type="input" name="name"
               value="<?php echo $currency['currencyName']; ?>">
        <br>

        <label>List Price:</label>
        <input type="input" name="price"
               value="<?php echo $currency['listPrice']; ?>">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Save Changes">
        <br>
    </form>
    <p><a href="index.php?action=list_currencies">View Currency List</a></p>

</main>
<?php include '../includes/footer.php'; ?>