<?php
include('db_conn.php');
include('helpers/extract_form_data.php');
include('helpers/product_helpers.php');

$sql1 = "SELECT * FROM encoded WHERE is_deleted = 0";
$accountResult = mysqli_query($conn, $sql1);

if (isset($_POST['editEncode'])) {
    $id = $_POST['encodeId'] ?? NULL; // Master account reference row ID
    
    // Check if this submission is authorized to modify full master data
    $isAdminEdit = isset($_POST['is_admin_edit']) && $_POST['is_admin_edit'] === 'true';

    // Catching progress log updates (required for both actions)
    $progress = extractProgressData($_POST);
    $masterUpdateSuccess = true;

    // ====================================================
    // CONDITION 1: EXECUTE FULL MASTER RECORD SQL IF ADMIN
    // ====================================================
    if ($isAdminEdit) {
        $pipeline = extractPipelineData($_POST);
        $contact = extractContactData($_POST);
        $project = extractProjectData($_POST);
        $address = extractAddressData($_POST);
        $user = getBranchAndDept($conn, $pipeline['accountExecutive']);

        $masterSql = "UPDATE encoded 
                SET
                sbu = '{$pipeline['sbu']}',
                accExec = '{$pipeline['accountExecutive']}', 
                branch = '{$user['branch']}',
                dept = '{$user['department']}',
                callDate = '{$pipeline['callDate']}',
                team = '{$pipeline['team']}',  
                customerId = '{$pipeline['customerId']}',
                accName = '{$pipeline['accountName']}',
                arsExpiryDate = '{$pipeline['arsExpiryDate']}',
                endUser = '{$pipeline['endUser']}', 
                segment = '{$pipeline['segment']}',
                industrySubcategory = '{$pipeline['industrySubcategory']}',
                accCat = '{$pipeline['accountCategory']}', 
                accSource = '{$pipeline['accountSource']}', 
                accountSourceCategory = '{$pipeline['accountSourceCategory']}',
                contactPerson = '{$contact['contactPerson']}', 
                designation = '{$contact['designation']}', 
                contactNumber = '{$contact['contactNumber']}', 
                email = '{$contact['emailAddress']}', 
                contactPerson1 = '{$contact['contactPerson1']}', 
                designation1 = '{$contact['designation1']}', 
                contactNumber1 = '{$contact['contactNumber1']}', 
                email1 = '{$contact['emailAddress1']}', 
                decisionMaker = '{$contact['decisionMaker']}',
                dmDesignation = '{$contact['dmDesignation']}',
                decisionMakerEmail = '{$contact['dmEmail']}',
                proposedPrice = '{$project['proposedPrice']}',
                paymentTerms = '{$project['paymentTerms']}',
                contactType = '{$project['contractType']}',
                callNature = '{$progress['callNature']}',
                accStatus = '{$progress['accountStatus']}',
                reason = " . ($progress['reason'] === NULL ? "NULL" : "'{$progress['reason']}'") . ",
                deliveryDate = " . ($progress['deliveryDate'] === NULL ? "NULL" : "'{$progress['deliveryDate']}'") . ",
                endOfContract = " . ($progress['contractEnd'] === NULL ? "NULL" : "'{$progress['contractEnd']}'") . ",
                remarks = '{$progress['remarks']}', 
                actionFollow = '{$progress['followUpAction']}',
                existingSystem = '{$project['existingSystem']}',
                endOfContractCompetitor = '{$project['contractEndCompetitor']}',
                region = '{$address['region']}',
                province = '{$address['province']}',
                city = '{$address['city']}',
                barangay = '{$address['barangay']}',
                region1 = '{$address['region1']}',
                branch1 = '{$address['branch1']}',
                address = '{$address['address']}',
                reasonSubcategory = '{$progress['reasonSubcategory']}',
                
                -- Synchronize new core progress properties into the master context row
                progressDate = '{$progress['progressDate']}',
                estimatedDelivery = " . ($progress['estimatedDelivery'] === NULL ? "NULL" : "'{$progress['estimatedDelivery']}'") . "
                WHERE id = '$id';";
                
        $masterUpdateSuccess = mysqli_query($conn, $masterSql);

        // Delete existing products and insert the new ones using helper
        if ($masterUpdateSuccess) {
            deleteProductDetails($conn, $id);
            insertProductDetails($conn, $id, $_POST);
        }
        
    } else {
        // If not an admin edit, sync the core progress tracks back up into the parent layout row tracker layer
        if (!empty($id)) {
            $syncSql = "UPDATE encoded 
                        SET 
                            accStatus = '{$progress['accountStatus']}',
                            reasonSubcategory = '{$progress['reasonSubcategory']}',
                            remarks = '{$progress['remarks']}',
                            progressDate = '{$progress['progressDate']}',
                            estimatedDelivery = " . ($progress['estimatedDelivery'] === NULL ? "NULL" : "'{$progress['estimatedDelivery']}'") . ",
                            deliveryDate = " . ($progress['deliveryDate'] === NULL ? "NULL" : "'{$progress['deliveryDate']}'") . ",
                            endOfContract = " . ($progress['contractEnd'] === NULL ? "NULL" : "'{$progress['contractEnd']}'") . "
                        WHERE id = '$id';";
            mysqli_query($conn, $syncSql);
        }
    }


    // ====================================================
    // CONDITION 2: WRITE NEW PROGRESS SNAPSHOT TO LOGS
    // ====================================================
    if ($masterUpdateSuccess) {
        if (!empty($id)) {
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
                    $id, 
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
        }

        // Send confirmation notice dynamically based on validation action
        $alertMessage = $isAdminEdit 
            ? "Account Master Record and Progress History Log Updated Successfully." 
            : "Progress History Activity Log Entry Added Successfully.";

        echo '<script>
                alert("' . $alertMessage . '");
                window.location.href = "' . BASE_URL . 'pages/editEncode.php?id=' . urlencode($id) . '";
              </script>';
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>