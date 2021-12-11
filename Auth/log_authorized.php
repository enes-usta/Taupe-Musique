<?php
include_once('Database/DB.php');

if (!isLogged()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}