<?PHP
include_once('ExportToExcel.class.php');
include_once('databasecon.php');//to make database connecti
$exp=new ExportToExcel();

$exp->exportWithPage("export_file.php","personalinfo.xls");


/*-------------un comment it to test with html page---------------
$exp->exportWithPage("export_html_file.html","personalinfo.xls");
*/

/*-------------un comment it to test with query------------
$qry="select * from personalinfo";
$exp->exportWithQuery($qry,"personalinfo.xls",$conn);
*/

/*
-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 03, 2008 at 06:42 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.1
-- 
-- Database: `exceltest`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `personalinfo`
-- 

CREATE TABLE `personalinfo` (
  `vName` varchar(50) NOT NULL,
  `vEmail` varchar(50) NOT NULL,
  `vCity` varchar(50) NOT NULL,
  `ID` bigint(20) NOT NULL auto_increment,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `personalinfo`
-- 

INSERT INTO `personalinfo` (`vName`, `vEmail`, `vCity`, `ID`) VALUES 
('raju mazumder', 'rajuniit@gmail.com', 'Chittagong', 1),
('Anis Uddin Ahmed', 'anisniit@gmail.com', 'Chittagong', 2),
('Emran Hasan', 'ehasan@yahoo.com', 'Dhaka', 3);

*/

?>

