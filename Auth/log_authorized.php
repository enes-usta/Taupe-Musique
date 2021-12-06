<?php
include_once('Database/DB.php');

if (!isLogged()) {
    include ('unauthorized.html');
    header("HTTP/1.1 401 Unauthorized");
    exit;
}