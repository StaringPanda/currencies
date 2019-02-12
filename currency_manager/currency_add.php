<?php include '../includes/header.php'; ?>
<main>
    <h1>Add Currency</h1>
    <form action="index.php" method="post" id="add_currency_form">
        <input type="hidden" name="action" value="add_currency">

        <label>Category:</label>
        <select name="currency_id">
        <?php foreach ( $currencies as $currency ) : ?>
            <option value="<?php echo $currency['currencyOfferingID']; ?>">
                <?php echo $currency['currencyName']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        <label>Code:</label>
        <input type="input" name="code">
        <br>

        <label>Name:</label>
        <input type="input" name="name">
        <br>

        <label>List Price:</label>
        <input type="input" name="price">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Currency">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_currencies">View Currency List</a>
    </p>

</main>
<?php include '../includes/footer.php'; ?>