<?php
include('Database/DB.php');

if (!isAdmin()) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
