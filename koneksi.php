<?php
$koneksi_mysql = mysqli_connect("localhost", "root", "", "minimarket");
$koneksi_sqlite = new PDO("sqlite:market.db");
$koneksi_access = mysqli_connect("localhost", "root", "", "db_access");
