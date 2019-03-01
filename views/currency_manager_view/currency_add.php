<?php include '../views/partials/header.php'; ?>
<main>
    <h1>Add Currency</h1>
    <form action="../controller/currency_manager_controller.php" method="post" id="add_currency_form" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_currency">

        
        <label>Currency Offerings:</label>
        <select name="currency_offering_id">
        <?php foreach ($currency_offerings as $currency_offering) : ?>
            <option value="<?php echo $currency_offering['currencyOfferingID']; ?>">
                <?php echo $currency_offering['currencyOfferingTitle']; ?>
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
        
        <label>Image:</label>
        <input type="file" name="image" accept="image/*">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Currency">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="../controller/currency_manager_controller.php?action=list_currencies">View Currency List</a>
    </p>

</main>
<?php include '../views/partials/footer.php'; ?>