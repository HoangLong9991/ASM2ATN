<?php
$host_name = "ec2-52-45-211-119.compute-1.amazonaws.com";
$db_name = "d7qfa25rtu9tok";
$db_user = "fmysbabmvcpiwy";
$db_passwd = "f76c3f618ddae754907ed6e0ee171503e32599544dd8d3dd5cb2da062e959e72";
$db_conn_string = "host=$host_name dbname=$db_name user=$db_user password=$db_passwd";
$dbconn = pg_connect($db_conn_string);

?>