<?php
session_start();
session_destroy();
header("Location: homepage.php"); // Redirect to homepage after logout
exit();
?>
