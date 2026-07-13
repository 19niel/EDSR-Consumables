<?php
/**
 * Helper functions to handle product insertion, deletion, and name lookups.
 * Consolidates duplicate logic from encodeAccount.php and editEncodeAccount.php.
 */

function insertProductDetails($conn, $encodedID, $post) {
    // Both Machines and Consumables use the same product_details schema.
    // They are submitted as parallel arrays.
    
    // Machine inputs
    $productTypes = $post['productType'] ?? [];
    $subcategories = $post['productTypeSubcategory'] ?? [];
    $deviceConditions = $post['deviceCondition'] ?? [];
    $quantities = $post['quantity'] ?? [];
    $productAmounts = $post['productAmount'] ?? [];
    $itemCodes = $post['itemCode'] ?? [];
    
    // Consumable inputs 
    $consumableTypes = $post['consumableType'] ?? []; // Stores "Consumable" product type ID
    $consumableModels = $post['consumableModel'] ?? []; // Stores subcategory ID
    $consumables = $post['consumable'] ?? []; // Actually saved into deviceConditionID
    $consItemCodes = $post['consumableItemCode'] ?? [];
    $consQuantities = $post['consumableQuantity'] ?? [];
    $consAmounts = $post['consumableAmount'] ?? [];

    $productSql = "INSERT INTO product_details (
        encodedID, 
        productTypeID, 
        productSubcategoryID, 
        itemCode, 
        quantity, 
        productAmount, 
        deviceConditionID
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $productStmt = mysqli_prepare($conn, $productSql);
    
    if (!$productStmt) {
        return false;
    }

    // Insert Machine Products
    if (!empty($productTypes)) {
        foreach ($productTypes as $index => $productTypeID) {
            $subcategoryID = (!empty($subcategories[$index]) && $subcategories[$index] !== 'N/A') ? (int)$subcategories[$index] : NULL;
            $itemCode = !empty($itemCodes[$index]) ? $itemCodes[$index] : NULL;
            $quantity = isset($quantities[$index]) ? (int)$quantities[$index] : 0;
            $amount = isset($productAmounts[$index]) ? (float)$productAmounts[$index] : 0.00;
            $conditionID = (!empty($deviceConditions[$index]) && $deviceConditions[$index] !== 'N/A') ? (int)$deviceConditions[$index] : NULL;

            mysqli_stmt_bind_param(
                $productStmt, 
                "iiiisdd", 
                $encodedID, 
                $productTypeID, 
                $subcategoryID, 
                $itemCode, 
                $quantity, 
                $amount, 
                $conditionID
            );
            mysqli_stmt_execute($productStmt);
        }
    }
    
    // Insert Consumables
    if (!empty($consumables)) {
        foreach ($consumables as $index => $consumableID) {
            // Consumables reuse the same columns but different semantic meaning
            $productTypeID = (!empty($consumableTypes[$index]) && $consumableTypes[$index] !== 'N/A') ? (int)$consumableTypes[$index] : NULL;
            $subcategoryID = (!empty($consumableModels[$index]) && $consumableModels[$index] !== 'N/A') ? (int)$consumableModels[$index] : NULL;
            $itemCode = !empty($consItemCodes[$index]) ? $consItemCodes[$index] : NULL;
            $quantity = isset($consQuantities[$index]) ? (int)$consQuantities[$index] : 0;
            $amount = isset($consAmounts[$index]) ? (float)$consAmounts[$index] : 0.00;
            $conditionID = (!empty($consumableID) && $consumableID !== 'N/A') ? (int)$consumableID : NULL;

            mysqli_stmt_bind_param(
                $productStmt, 
                "iiiisdd", 
                $encodedID, 
                $productTypeID, 
                $subcategoryID, 
                $itemCode, 
                $quantity, 
                $amount, 
                $conditionID
            );
            mysqli_stmt_execute($productStmt);
        }
    }

    mysqli_stmt_close($productStmt);
    return true;
}

function deleteProductDetails($conn, $encodedID) {
    $deleteSql = "DELETE FROM product_details WHERE encodedID = ?";
    $stmt = mysqli_prepare($conn, $deleteSql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $encodedID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    return false;
}

function getConsumableName($conn, $id) {
    if (!$id) return 'N/A';
    $sql = "SELECT consumable_name FROM consumables WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['consumable_name'];
        }
    }
    return 'N/A';
}

function getItemCodeName($conn, $id) {
    if (!$id) return 'N/A';
    $sql = "SELECT item_name FROM item_codes WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['item_name'];
        }
    }
    return 'N/A';
}
?>
