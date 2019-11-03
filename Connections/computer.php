<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_computer = "localhost";
$database_computer = "loginadminuser";
$username_computer = "root";
$password_computer = "12345678";
$computer = mysql_pconnect($hostname_computer, $username_computer, $password_computer) or trigger_error(mysql_error(),E_USER_ERROR); 
?>