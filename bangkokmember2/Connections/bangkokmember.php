<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bangkokmember = "localhost";
$database_bangkokmember = "bangkokmember";
$username_bangkokmember = "root";
$password_bangkokmember = "9988";
$bangkokmember = mysql_pconnect($hostname_bangkokmember, $username_bangkokmember, $password_bangkokmember) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES utf8");
?>