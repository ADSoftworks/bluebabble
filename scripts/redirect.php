<?php
if(isset($_SESSION['username'])) {
    header("Location: app");
    exit();
}
?>