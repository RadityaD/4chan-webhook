<?php
    //phpinfo();
    define('DBHOST', "192.168.99.100");
    define('DBUSER', "root");
    define('DBPASS', "root");
    define('DBNAME', "ralobh");

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME, "3306");

    if($conn->connect_errno){
        echo "connection error : ".$conn->connect_error . "\n";
        echo "error number : " . $conn->connect_errno;
        echo "\n MEEK";
        exit;        
    }

    echo "connection successful";
?>