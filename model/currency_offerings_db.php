<?php
function get_currency_offerings() {
    global $db;
    $query = 'SELECT * FROM currency_offerings
              ORDER BY currencyOfferingID';
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}

function get_currency_offerings_name($currency_offering_id) {
    global $db;
    $query = 'SELECT * FROM currency_offerings
              WHERE currencyOfferingID = :currency_offering_id';    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_offering_id', $currency_offering_id);
    $stmt->execute();    
    $currency_offering = $stmt->fetch();
    $stmt->closeCursor();    
    $currency_offering_name = $currency_offering['currencyOfferingTitle'];
    return $currency_offering_name;
}

function add_currency_offering($name) {
    global $db;
    $query = 'INSERT INTO currency_offerings (currencyOfferingTitle)
              VALUES (:name)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    $stmt->closeCursor();    
}

function delete_currency_offering($currency_offering_id) {
    global $db;
    $query = 'DELETE FROM currency_offerings
              WHERE currencyOfferingID = :currency_offering_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_offering_id', $currency_offering_id);
    $stmt->execute();
    $stmt->closeCursor();
}
?>