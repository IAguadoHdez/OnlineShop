<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user = ($_POST['user']);
  $lastname = ($_POST['lastname']);
  $password = ($_POST['password']);
  $email = ($_POST['email']);

  // Preparar insert a customers del nuevo customer
  $query = $conn-> prepare(("INSERT customer_name, lastname, email, password TO `002customers` 
                              WHERE customer_name = ?, lastname = ?, password = ?, email = ?" ));
  $query-> bind_param("ssss", $user,$lastname,$password,$email);
  $query -> execute();
  $result = $query-> get_result();
  $new_user = $result->fetch_assoc();
}