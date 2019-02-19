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
    $currency_offering_id = filter_input(INPUT_GET, 'currency_offering_id', 
            FILTER_VALIDATE_INT);
    if ($currency_offering_id == NULL || $currency_offering_id == FALSE) {
        $currency_offering_id = 1;
    }
    $currency_offerings = get_currency_offerings();
    $currency_offering_name = get_currency_offerings_name($currency_offering_id);
    $currencies = get_currencies_by_currency_offering($currency_offering_id);

    include('currency_list.php');
} else if ($action == 'view_currency') {
    $currency_id = filter_input(INPUT_GET, 'currency_id', 
            FILTER_VALIDATE_INT);   
    if ($currency_id == NULL || $currency_id == FALSE) {
        $error = 'Missing or incorrect currency id.';
        include('../errors/error.php');
    } else {
        $currency_offerings = get_currency_offerings();
        $currency = get_currency($currency_id);

        // Get currency data
        $code = $currency['currencyCode'];
        $name = $currency['currencyName'];
        $list_price = $currency['listPrice'];

        // Calculate discounts
        $discount_percent = 30;  // 30% off for all web orders
        $discount_amount = round($list_price * ($discount_percent/100.0), 2);
        $unit_price = $list_price - $discount_amount;

        // Format the calculations
        $discount_amount_f = number_format($discount_amount, 2);
        $unit_price_f = number_format($unit_price, 2);

        // Get image URL and alternate text
        $image_filename = '../images/' . $code . '.png';
        $image_alt = 'Image: ' . $code . '.png';

        include('currency_view.php');
    }
}
?>