<?php
/**
 * Helper functions to extract form data consistently across encode and edit pages.
 * These functions reduce code duplication and keep the main handler files clean.
 */

function extractPipelineData($post) {
    return [
        'sbu'                   => $post['sbu'] ?? NULL,
        'accountExecutive'      => $post['accountExecutive'] ?? NULL,
        'callDate'              => $post['callDate'] ?? NULL,
        'team'                  => $post['team'] ?? NULL,
        'accountName'           => $post['accountName'] ?? NULL,
        'arsExpiryDate'         => $post['arsExpiryDate'] ?? NULL,
        'endUser'               => $post['endUserType'] ?? NULL,
        'segment'               => $post['segment'] ?? NULL,
        'industrySubcategory'   => $post['industrySubcategory'] ?? NULL,
        'accountCategory'       => $post['accountCategory'] ?? NULL,
        'accountSource'         => $post['accountSource'] ?? NULL,
        'accountSourceCategory' => $post['accountSourceCategory'] ?? NULL,
    ];
}

function extractContactData($post) {
    return [
        // Using index [0] for arrays, or falling back to single value
        'contactPerson' => isset($post['contactPerson'][0]) ? $post['contactPerson'][0] : ($post['contactPerson'] ?? NULL),
        'designation'   => isset($post['designation'][0]) ? $post['designation'][0] : ($post['designation'] ?? NULL),
        'contactNumber' => isset($post['contactNumber'][0]) ? $post['contactNumber'][0] : ($post['contactNumber'] ?? NULL),
        'emailAddress'  => isset($post['emailAddress'][0]) ? $post['emailAddress'][0] : ($post['emailAddress'] ?? NULL),
        
        // Decision Maker
        'decisionMaker' => $post['decisionMaker'] ?? NULL,
        'dmDesignation' => $post['dmDesignation'] ?? NULL,
        'dmEmail'       => $post['dmEmail'] ?? NULL,
    ];
}

function extractProjectData($post) {
    return [
        'projTitle'             => $post['projTitle'] ?? NULL,
        'proposedPrice'         => $post['proposedPrice'] ?? NULL,
        'paymentTerms'          => $post['paymentTerms'] ?? NULL,
        'contractType'          => $post['contractType'] ?? NULL,
        'projAddress'           => $post['projectAddress'] ?? NULL,
        'existingSystem'        => $post['existingSystem'] ?? NULL,
        'contractEndCompetitor' => $post['contractEndCompetitor'] ?? NULL,
    ];
}

function extractProgressData($post) {
    return [
        'callNature'        => $post['callNature'] ?? 'N/A',
        'accountStatus'     => $post['accountStatus'] ?? NULL,
        'reason'            => !empty($post['reason']) ? $post['reason'] : NULL,
        'followUpAction'    => $post['followUpAction'] ?? NULL,
        'deliveryDate'      => !empty($post['deliveryDate']) ? $post['deliveryDate'] : NULL,
        'contractEnd'       => !empty($post['contractEnd']) ? $post['contractEnd'] : NULL,
        'remarks'           => $post['remarks'] ?? NULL,
        'whatTranspired'    => $post['whatTranspired'] ?? NULL,
        'reasonSubcategory' => $post['reasonSubcategory'] ?? NULL,
        'progressDate'      => !empty($post['progressDate']) ? $post['progressDate'] : date('Y-m-d'),
        'estimatedDelivery' => !empty($post['estimatedDelivery']) ? $post['estimatedDelivery'] : NULL,
    ];
}

function extractAddressData($post) {
    return [
        'region'    => $post['region'] ?? NULL,
        'province'  => $post['province'] ?? NULL,
        'city'      => $post['city'] ?? NULL,
        'barangay'  => $post['barangay'] ?? NULL,
        'region1'   => $post['region1'] ?? NULL,
        'branch1'   => $post['branch1'] ?? NULL,
        'address'   => $post['address'] ?? NULL,
    ];
}

function getBranchAndDept($conn, $accountExecutive) {
    $branch = NULL;
    $department = NULL;
    
    if ($accountExecutive) {
        $userQuery = "SELECT branch, dept FROM users WHERE name = ? AND is_deleted = 0 LIMIT 1";
        $userStmt = mysqli_prepare($conn, $userQuery);
        if ($userStmt) {
            mysqli_stmt_bind_param($userStmt, "s", $accountExecutive);
            mysqli_stmt_execute($userStmt);
            $userResult = mysqli_stmt_get_result($userStmt);
            if ($userRow = mysqli_fetch_assoc($userResult)) {
                $branch = $userRow['branch'];
                $department = $userRow['dept'];
            }
            mysqli_stmt_close($userStmt);
        }
    }
    
    return ['branch' => $branch, 'department' => $department];
}
?>
