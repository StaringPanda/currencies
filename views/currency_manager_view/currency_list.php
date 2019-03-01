<?php include '../views/partials/header.php'; ?>
<main>

    <h1>Currency List</h1>

    <aside>
        <!-- display a list of currency Offerings -->
        <h2>Currency Offerings</h2>
        <?php include '../views/partials/category_nav.php'; ?>        
    </aside>

    <section>
        <!-- display a table of currency's -->
        <h2><?php echo $currency_offering_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($currencies as $currency) : ?>
            <tr>
                <td><?php echo $currency['currencyCode']; ?></td>
                <td><?php echo $currency['currencyName']; ?></td>
                <td class="right"><?php echo $currency['listPrice']; ?></td>
                <td><form action="../controller/currency_manager_controller.php" method="post">
                    <input type="hidden" name="action"
                           value="show_edit_form">
                    <input type="hidden" name="currency_id"
                           value="<?php echo $currency['currencyID']; ?>">
                    <input type="hidden" name="currency_offering_id"
                           value="<?php echo $currency['currencyOfferingID']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
                <td><form action="../controller/currency_manager_controller.php" method="post">
                    <input type="hidden" name="action"
                           value="delete_currency">
                    <input type="hidden" name="currency_id"
                           value="<?php echo $currency['currencyID']; ?>">
                    <input type="hidden" name="currency_offering_id"
                           value="<?php echo $currency['currencyOfferingID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="../controller/currency_manager_controller.php?action=show_add_form">Add Currency</a></p>
        <p><a href="../controller/currency_manager_controller.php?action=list_currency_offerings">List Currency Offerings</a></p>
    </section>

</main>
<?php include '../views/partials/footer.php'; ?>