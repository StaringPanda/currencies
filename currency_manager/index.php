<?php
require('../model/database.php');
require('../model/currencies_db.php');
require('../model/currency_offerings_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_currencies';
    }
}

if ($action == 'list_currencies') {
    // Get the current currency offering ID
    $currency_offering_id = filter_input(INPUT_GET, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE) {
        $currency_offering_id = 1;
    }
    
    // Get currency and currency offering data
    $currency_offering_name = get_currency_offerings_name($currency_offering_id);
    $currency_offerings = get_currency_offerings();
    $currencies = get_currencies_by_currency_offering($currency_offering_id);

    // Display the currency list
    include('currency_list.php');
} else if ($action == 'show_edit_form') {
    $currency_id = filter_input(INPUT_POST, 'currency_id', 
            FILTER_VALIDATE_INT);
    if ($currency_id == NULL || $currency_id == FALSE) {
        $error = "Missing or incorrect currency id.";
        include('../errors/error.php');
    } else { 
        $currency = get_currency($currency_id);
        include('currency_edit.php');
    }
} else if ($action == 'update_currency') {
    $currency_id = filter_input(INPUT_POST, 'currency_id', 
            FILTER_VALIDATE_INT);
    $currency_offering_id = filter_input(INPUT_POST, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate the inputs
    if ($currency_id == NULL || $currency_id == FALSE || $currency_offering_id == NULL || 
            $currency_offering_id == FALSE || $code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE) {
        $error = "Invalid currency data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_currency($currency_id, $currency_offering_id, $code, $name, $price);

        // Display the currency List page for the current currency offering
        header("Location: .?currency_offering_id=$currency_offering_id");
    }
} else if ($action == 'delete_currency') {
    $currency_id = filter_input(INPUT_POST, 'currency_id', 
            FILTER_VALIDATE_INT);
    $currency_offering_id = filter_input(INPUT_POST, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE ||
            $currency_id == NULL || $currency_id == FALSE) {
        $error = "Missing or incorrect currency id or currency offering id.";
        include('../errors/error.php');
    } else { 
        delete_currency($currency_id);
        header("Location: .?currency_offering_id=$currency_offering_id");
    }
} else if ($action == 'show_add_form') {
    $currencies = get_currency_offerings();
    include('currency_add.php');
} else if ($action == 'add_currency') {
    $currency_offering_id = filter_input(INPUT_POST, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE || $code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid currency data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_currency($currency_offering_id, $code, $name, $price);
        header("Location: .?currency_offering_id=$currency_offering_id");
    }
} else if ($action == 'list_currency_offerings') {
    $currency_offerings = get_currency_offerings();
    include('currency_offerings_list.php');
} else if ($action == 'add_currency_offering') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid currency offering name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_currency_offering($name);
        header('Location: .?action=list_currency_offering');  // display the Currency Offerings List page
    }
} else if ($action == 'delete_currency_offering') {
    $currency_offering_id = filter_input(INPUT_POST, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    delete_currency_offering($currency_offering_id);
    header('Location: .?action=list_currency_offerings');      // display the Currency Offerings List page
}
?>