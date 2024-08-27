<?php

session_start();

if (isset($_SESSION['rgeno'])) {
    unset($_SESSION['regno']);
}

header("Location: login.php");
die;
