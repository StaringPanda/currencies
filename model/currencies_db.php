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

function add_currency($currency_offering_id, $code, $name, $price) {
    global $db;
    $query = 'INSERT INTO currencies
                 (currencyOfferingID, currencyCode, currencyName, listPrice)
              VALUES
                 (:currency_offering_id, :code, :name, :price)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_offering_id', $currency_offering_id);
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

function upload_currency_image($imgFile, $tmp_dir, $imgSize, $code){
        $upload_dir = '../images/';
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extensions = array('png');
        $currencyPic = $code.".".$imgExt;
            if (in_array($imgExt, $valid_extensions)){
                if ($imgSize < 5000000){
                    move_uploaded_file($tmp_dir, $upload_dir.$currencyPic);
                }else{
                    $error = "File is too large, max file size is 5MB.";
                    include('../errors/error.php');
                }
            }else{
                $error = "Not a valid file extension, must be png";
                include('../errors/error.php');
            }
}

function delete_currency_image($currency_id) {
    global $db;
    $query = 'SELECT * FROM currencies
              WHERE currencyID = :currency_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':currency_id', $currency_id);
    $stmt->execute();
    $row = $stmt->fetch();
    $stmt->closeCursor();
    unlink("../images/".$row['currencyCode'].".png");
}
?>