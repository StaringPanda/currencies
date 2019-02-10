<?php
function get_currencies() {
    global $db;
    $query = 'SELECT * FROM currencies
              ORDER BY currencyID';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $currencies = $stmt->fetchAll();
    $stmt->closeCursor();
    return $currencies;
}

function get_currencies_by_currency_offering($currency_offering_id) {
    global $db;
    $query = 'SELECT * FROM currencies
              WHERE currencies.currencyOfferingID = :currency_offering_id
              ORDER BY currencyID';
    $stmt = $db->prepare($query);
    $stmt->bindValue(":currency_offering_id", $currency_offering_id);
    $stmt->execute();
    $currencies = $stmt->fetchAll();
    $stmt->closeCursor();
    return $currencies;
}

function get_currency($currency_id) {
    global $db;
    $query = 'SELECT * FROM currencies
              WHERE currencyID = :currency_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(":currency_id", $currency_id);
    $stmt->execute();
    $currency = $stmt->fetch();
    $stmt->closeCursor();
    return $currency;
}

function delete_currency($currency_id) {
    global $db;
    $query = 'DELETE FROM currencies
              WHERE currencyID = :currency_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_id', $currency_id);
    $stmt->execute();
    $stmt->closeCursor();
}

function add_currency($currency_id, $code, $name, $price) {
    global $db;
    $query = 'INSERT INTO currencies
                 (currencyID, currencyCode, currencyName, listPrice)
              VALUES
                 (:currency_id, :code, :name, :price)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_id', $currency_id);
    $stmt->bindValue(':code', $code);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':price', $price);
    $stmt->execute();
    $stmt->closeCursor();
}

function update_currency($currency_id, $currency_offering_id, $code, $name, $price) {
    global $db;
    $query = 'UPDATE currencies
              SET currencyOfferingID = :currency_offering_id,
                  currencyCode = :code,
                  currencyName = :name,
                  listPrice = :price
               WHERE currencyID = :currency_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_offering_id', $currency_offering_id);
    $stmt->bindValue(':code', $code);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':currency_id', $currency_id);
    $stmt->execute();
    $stmt->closeCursor();
}
?>