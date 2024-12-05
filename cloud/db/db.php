<?php
$connectionInfo = array("UID" => "ayoub", "pwd" => "Azerty1-1azerty", "Database" => "cloud", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cloudtp1.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

session_start();