<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

function getCustomer($id)
{
    global $conn;
    $query = $conn->prepare("SELECT customer_name, lastname, email, phone FROM 002customers WHERE customer_id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $customer = $query->get_result()->fetch_assoc();
    $query->close();
    return $customer;
}

function updateCustomer($id, $name, $lastname, $email, $phone)
{
    global $conn;
    $query = $conn->prepare("UPDATE 002customers SET customer_name=?, lastname=?, email=?, phone=? WHERE customer_id=?");
    $query->bind_param("ssssi", $name, $lastname, $email, $phone, $id);
    $ok = $query->execute();
    $query->close();
    return $ok;
}
?>