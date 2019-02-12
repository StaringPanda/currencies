<?php include '../includes/header.php'; ?>
<main>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <?php include '../view/category_nav.php'; ?>        
    </aside>
    <section>
        <h1><?php echo $category_name; ?></h1>
        <ul class="nav">
            <!-- display links for products in selected category -->
            <?php foreach ($products as $currency) : ?>
            <li>
                <a href="?action=view_product&amp;product_id=<?php 
                          echo $currency['productID']; ?>">
                    <?php echo $currency['productName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
<?php include '../includes/footer.php'; ?>