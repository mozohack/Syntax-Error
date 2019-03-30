<?php
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect("localhost","root","")or die("Connnection Error");
mysql_select_db("mozo")or die("Database Error")
?>