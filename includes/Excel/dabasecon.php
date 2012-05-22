<?php
/*PHP Document

Page	: make connection with mysql and select database
 */

$conn=mysql_connect('localhost','root','')or die('Sorry Could not make connection');
mysql_select_db('exceltest');
?>
