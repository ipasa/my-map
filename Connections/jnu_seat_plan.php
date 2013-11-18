<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_jnu_seat_plan = "localhost";
#$database_jnu_seat_plan = "seat_plan";
$database_jnu_seat_plan = "jnu_seat_a";
$username_jnu_seat_plan = "root";
$password_jnu_seat_plan = "123";
$jnu_seat_plan = mysql_pconnect($hostname_jnu_seat_plan, $username_jnu_seat_plan, $password_jnu_seat_plan) or trigger_error(mysql_error(),E_USER_ERROR); 
?>