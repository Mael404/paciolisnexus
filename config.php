<?php

$conn = mysqli_connect("localhost", "root", "", "pnexus");

if (!$conn) {
    echo "Connection Failed";
}