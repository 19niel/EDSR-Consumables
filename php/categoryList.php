<?php
include ('db_conn.php');
include ('autoRedirect.php');

$sql = "SELECT * FROM categories WHERE is_deleted = 0";
$categoryResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Account Category' AND is_deleted = 0";
$accountCategoryResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'SBU' AND is_deleted = 0";
$sbuResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Product Type' AND is_deleted = 0";
$productTypeResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Product Type' AND is_deleted = 0 AND category_name IN ('KM Machine', 'RISO Machine')";
$machineProductTypeResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Product Type' AND is_deleted = 0 AND category_name IN ('KM Color', 'KM Mono', 'RISO')";
$consumablesProductTypeResult = mysqli_query($conn, $sql);
$sql = "SELECT * FROM categories WHERE field = 'Type of End-User' AND is_deleted = 0";
$endUserTypeResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Segment' AND is_deleted = 0";
$segmentResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Industry' AND is_deleted = 0";
$industryResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Source of Account' AND is_deleted = 0";
$accountSourceResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Existing System' AND is_deleted = 0";
$existingSystemResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Device Condition' AND is_deleted = 0";
$deviceConditionResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Contract Type' AND is_deleted = 0";
$contractTypeResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Terms of Payment' AND is_deleted = 0";
$paymentTermsResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Nature of Call' AND is_deleted = 0";
$callNatureResult = mysqli_query($conn, $sql);

$sql = "SELECT * FROM categories WHERE field = 'Account Status' AND is_deleted = 0";
$accountstatusResult = mysqli_query($conn, $sql);
