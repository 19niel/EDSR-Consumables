<?php
include('db_conn.php');
include('helpers/extract_form_data.php');
include('helpers/product_helpers.php');

if (isset($_POST['encodeAccount'])) {

    // Extract grouped data
    $pipeline = extractPipelineData($_POST);
    $contact = extractContactData($_POST);
    $project = extractProjectData($_POST);
    $progress = extractProgressData($_POST);
    $address = extractAddressData($_POST);
    $user = getBranchAndDept($conn, $pipeline['accountExecutive']);
    // Extract discount data
    $discountEnabled = 0;
    $discountType = NULL;
    $discountValue = NULL;

    if (isset($_POST['machineDiscountEnabled']) && $_POST['machineDiscountEnabled'] == '1') {
        $discountEnabled = 1;
        $discountType = $_POST['machineDiscountType'] ?? 'percentage';
        $discountValue = isset($_POST['machineDiscountValue']) ? (float)$_POST['machineDiscountValue'] : 0;
    } elseif (isset($_POST['consumableDiscountEnabled']) && $_POST['consumableDiscountEnabled'] == '1') {
        $discountEnabled = 1;
        $discountType = $_POST['consumableDiscountType'] ?? 'percentage';
        $discountValue = isset($_POST['consumableDiscountValue']) ? (float)$_POST['consumableDiscountValue'] : 0;
    }

    // =========================
    // INSERT ENCODED
    // =========================
    $sql = "INSERT INTO encoded (
        sbu, accExec, branch, dept, callDate, team, customerId, accName, arsExpiryDate, estimatedDelivery, 
        accCat, existingSystem, endOfContractCompetitor, endUser, industry, industrySubcategory, 
        accSource, accountSourceCategory, region, province, city, barangay, branch1, region1, 
        address, contactPerson, designation, contactNumber, email, contactPerson1, designation1, contactNumber1, email1, decisionMaker, dmDesignation, 
        decisionMakerEmail, projTitle, proposedPrice, vatType, paymentTerms, contactType, projAddress, 
        callNature, accStatus, reason, deliveryDate, endOfContract, remarks, whatTranspired, 
        segment, reasonSubcategory, progressDate, discountEnabled, discountType, discountValue
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )"; 

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssssssssssssssssssssssssssssssssssssssssssssisd",
        $pipeline['sbu'],
        $pipeline['accountExecutive'],
        $user['branch'],
        $user['department'],
        $pipeline['callDate'],
        $pipeline['team'],
        $pipeline['customerId'],
        $pipeline['accountName'],
        $pipeline['arsExpiryDate'],
        $progress['estimatedDelivery'], 
        $pipeline['accountCategory'],
        $project['existingSystem'],
        $project['contractEndCompetitor'],
        $pipeline['endUser'],
        $pipeline['segment'],
        $pipeline['industrySubcategory'],
        $pipeline['accountSource'],
        $pipeline['accountSourceCategory'],
        $address['region'],
        $address['province'],
        $address['city'],
        $address['barangay'],
        $address['branch1'],
        $address['region1'],
        $address['address'],
        $contact['contactPerson'],
        $contact['designation'],
        $contact['contactNumber'],
        $contact['emailAddress'],
        $contact['contactPerson1'],
        $contact['designation1'],
        $contact['contactNumber1'],
        $contact['emailAddress1'],
        $contact['decisionMaker'],
        $contact['dmDesignation'],
        $contact['dmEmail'],
        $project['projTitle'],
        $project['proposedPrice'],
        $project['vatType'],
        $project['paymentTerms'],
        $project['contractType'],
        $project['projAddress'],
        $progress['callNature'],
        $progress['accountStatus'],
        $progress['reason'],
        $progress['deliveryDate'],
        $progress['contractEnd'],
        $progress['remarks'],
        $progress['whatTranspired'],
        $pipeline['segment'],
        $progress['reasonSubcategory'],
        $progress['progressDate'],
        $discountEnabled,
        $discountType,
        $discountValue
    );

    $execute = mysqli_stmt_execute($stmt);

    if (!$execute) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }

    $encodedID = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    // ====================================================
    // INSERT SUBMISSION INTO ENCODED_LOGS TABLE
    // ====================================================
    $logSql = "INSERT INTO encoded_logs (
        encodedID, progressDate, accountStatusID, reasonSubcategoryID, remarks, 
        estimatedDelivery, deliveryDate, contractEndDate
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $logStmt = mysqli_prepare($conn, $logSql);

    if ($logStmt) {
        $logStatusID  = (!empty($progress['accountStatus']) && $progress['accountStatus'] !== 'N/A') ? (int)$progress['accountStatus'] : NULL;
        $logSubcatID  = (!empty($progress['reasonSubcategory']) && $progress['reasonSubcategory'] !== 'N/A') ? (int)$progress['reasonSubcategory'] : NULL;
        
        mysqli_stmt_bind_param(
            $logStmt, 
            "isiissss", 
            $encodedID, 
            $progress['progressDate'], 
            $logStatusID, 
            $logSubcatID, 
            $progress['remarks'], 
            $progress['estimatedDelivery'], 
            $progress['deliveryDate'], 
            $progress['contractEnd']
        );
        mysqli_stmt_execute($logStmt);
        mysqli_stmt_close($logStmt);
    }

    // ====================================================
    // INSERT PRODUCT / TRANSACTION DETAILS
    // ====================================================
    insertProductDetails($conn, $encodedID, $_POST);

    echo '<script>
        alert("Success: Account encoded along with products and system context!");
        window.location.href = "' . BASE_URL . 'pages/encode.php";
        </script>';
    exit();
}
?>