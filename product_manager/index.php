<?php
require('../model/database.php');
require('../model/currencies_db.php');
require('../model/currency_offerings_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    // Get the current category ID
    $currency_offering_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE) {
        $currency_offering_id = 1;
    }
    
    // Get product and category data
    $category_name = get_category_name($currency_offering_id);
    $currencies = get_categories();
    $products = get_products_by_category($currency_offering_id);

    // Display the product list
    include('product_list.php');
} else if ($action == 'show_edit_form') {
    $currency_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
    if ($currency_id == NULL || $currency_id == FALSE) {
        $error = "Missing or incorrect product id.";
        include('../errors/error.php');
    } else { 
        $currency = get_product($currency_id);
        include('product_edit.php');
    }
} else if ($action == 'update_product') {
    $currency_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
    $currency_offering_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate the inputs
    if ($currency_id == NULL || $currency_id == FALSE || $currency_offering_id == NULL || 
            $currency_offering_id == FALSE || $code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_product($currency_id, $currency_offering_id, $code, $name, $price);

        // Display the Product List page for the current category
        header("Location: .?category_id=$currency_offering_id");
    }
} else if ($action == 'delete_product') {
    $currency_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
    $currency_offering_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE ||
            $currency_id == NULL || $currency_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else { 
        delete_product($currency_id);
        header("Location: .?category_id=$currency_offering_id");
    }
} else if ($action == 'show_add_form') {
    $currencies = get_categories();
    include('product_add.php');
} else if ($action == 'add_product') {
    $currency_offering_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE || $code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_product($currency_offering_id, $code, $name, $price);
        header("Location: .?category_id=$currency_offering_id");
    }
} else if ($action == 'list_categories') {
    $currencies = get_categories();
    include('category_list.php');
} else if ($action == 'add_category') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid category name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_category($name);
        header('Location: .?action=list_categories');  // display the Category List page
    }
} else if ($action == 'delete_category') {
    $currency_offering_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    delete_category($currency_offering_id);
    header('Location: .?action=list_categories');      // display the Category List page
}
?>