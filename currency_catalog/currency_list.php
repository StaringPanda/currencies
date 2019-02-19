<?php include '../includes/header.php'; ?>
<main>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <?php include '../includes/category_nav.php'; ?>        
    </aside>
    <section>
        <h1><?php echo $currency_offering_name; ?></h1>
        <ul class="nav">
            <!-- display links for products in selected category -->
            <?php foreach ($currencies as $currency) : ?>
            <li>
                <a href="?action=view_currency&amp;currency_id=<?php 
                          echo $currency['currencyID']; ?>">
                    <?php echo $currency['currencyName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
<?php include '../includes/footer.php'; ?>