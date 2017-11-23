<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_condb = "sql12.freemysqlhosting.net";
$database_condb = "sql12206600";
$username_condb = "sql12206600";
$password_condb = "C8ajL7mtp5";
$condb = mysql_pconnect($hostname_condb, $username_condb, $password_condb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>