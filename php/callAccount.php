<?php
include('db_conn.php');

if (isset($_POST['submitCall'])) {

    // Helper function to safely extract POST data
    function getPostData($key) {
        return isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    // Extract Activity Information
    $sbu = getPostData('sbu');
    $natureOfCall = getPostData('natureOfCall');
    $accountExecutive = getPostData('accountExecutive');
    $dateOfActivity = getPostData('dateOfActivity');
    $activityBranch = getPostData('activityBranch');

    // Extract Client Information
    $customerId = getPostData('customerId');
    $accountName = getPostData('accountName');
    $clientBranch = getPostData('clientBranch');
    $region = getPostData('region');
    $address = getPostData('address');
    $contactPerson = getPostData('contactPerson');
    $designation = getPostData('designation');
    $contactDetails = getPostData('contactDetails');
    $emailAddress = getPostData('emailAddress');

    // Extract Progress Updates
    $dateOfProgress = getPostData('dateOfProgress');
    $accountsStatus = getPostData('accountsStatus');
    $remarks = getPostData('remarks');

    // Start Transaction
    mysqli_begin_transaction($conn);

    try {
        // =========================
        // INSERT INTO calls TABLE
        // =========================
        $sqlCall = "INSERT INTO calls (
            sbu, natureOfCall, accountExecutive, dateOfActivity, activityBranch,
            customerId, accountName, clientBranch, region, address,
            contactPerson, designation, contactDetails, emailAddress,
            dateOfProgress, accountsStatus, remarks
        ) VALUES (
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?,
            ?, ?, ?
        )";

        $stmtCall = mysqli_prepare($conn, $sqlCall);
        if (!$stmtCall) {
            throw new Exception("Prepare failed for calls: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmtCall,
            "sssssssssssssssss",
            $sbu, $natureOfCall, $accountExecutive, $dateOfActivity, $activityBranch,
            $customerId, $accountName, $clientBranch, $region, $address,
            $contactPerson, $designation, $contactDetails, $emailAddress,
            $dateOfProgress, $accountsStatus, $remarks
        );

        if (!mysqli_stmt_execute($stmtCall)) {
            throw new Exception("Execute failed for calls: " . mysqli_stmt_error($stmtCall));
        }

        $callID = mysqli_insert_id($conn);
        mysqli_stmt_close($stmtCall);

        // =========================
        // INSERT INTO call_logs TABLE
        // =========================
        $sqlLog = "INSERT INTO call_logs (
            callID, dateOfProgress, accountsStatus, remarks
        ) VALUES (
            ?, ?, ?, ?
        )";

        $stmtLog = mysqli_prepare($conn, $sqlLog);
        if (!$stmtLog) {
            throw new Exception("Prepare failed for call_logs: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmtLog,
            "isss",
            $callID, $dateOfProgress, $accountsStatus, $remarks
        );

        if (!mysqli_stmt_execute($stmtLog)) {
            throw new Exception("Execute failed for call_logs: " . mysqli_stmt_error($stmtLog));
        }

        mysqli_stmt_close($stmtLog);

        // Commit transaction
        mysqli_commit($conn);

        echo '<script>
            alert("Success: Call activity encoded successfully!");
            window.location.href = "../pages/call.php";
            </script>';
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die("Transaction failed: " . $e->getMessage());
    }
} else {
    // Redirect back if accessed directly without POST
    header("Location: ../pages/call.php");
    exit();
}
?>
