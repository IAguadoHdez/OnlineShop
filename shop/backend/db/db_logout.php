<?php 
session_start();
session_destroy();
header("Location: /student002/shop/backend/public/index.php");
?>