<?php
include('Database/DB.php');

if (!isAdmin()) {
    include ('Auth/unauthorized.html');
    header("HTTP/1.1 403 Forbidden");
    exit;
}
