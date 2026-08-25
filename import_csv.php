<?php
require 'php/db_conn.php';

echo "<h3>CSV Import Script for Machines, Consumables, and Item Codes</h3>";
echo "<p>This script reads the CSV files and safely imports them without duplicating existing entries.</p><hr>";

// Define the files and their respective Category Names
$filesToProcess = [
    [
        'file' => 'EDSR CONS 1(RISO) (2).csv',
        'category' => 'RISO Machine'
    ],
    [
        'file' => 'EDSR CONS 1(KM COLOR).csv',
        'category' => 'KM Machine'
    ]
];

foreach ($filesToProcess as $process) {
    $csvFile = $process['file'];
    $categoryName = $process['category'];
    
    echo "<h4>Processing: <code>$csvFile</code> (Target Category: $categoryName)</h4>";
    
    if (!file_exists($csvFile)) {
        echo "<p style='color:red;'>❌ CSV file '$csvFile' not found in the directory. Skipping.</p>";
        continue;
    }

    // Find the Category ID in the database
    $stmt_cat = $conn->prepare("SELECT id FROM categories WHERE category_name = ? AND is_deleted = 0 LIMIT 1");
    $stmt_cat->bind_param("s", $categoryName);
    $stmt_cat->execute();
    $res_cat = $stmt_cat->get_result();

    if ($res_cat->num_rows == 0) {
        echo "<p style='color:red;'>❌ Category '$categoryName' not found in the database. Please ensure it exists. Skipping.</p>";
        continue;
    }

    $category_id = $res_cat->fetch_assoc()['id'];

    $handle = fopen($csvFile, "r");
    if ($handle !== FALSE) {
        // Skip the header row
        fgetcsv($handle, 1000, ",");
        
        $currentMachines = [];
        $currentConsumable = "";
        $countItems = 0;

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $machineCol = trim($row[0] ?? '');
            $consumableCol = trim($row[1] ?? '');
            $itemCodeCol = trim($row[2] ?? '');
            
            if (empty($machineCol) && empty($consumableCol) && empty($itemCodeCol)) {
                continue;
            }

            // If machine column is provided, parse it and update current machines
            if (!empty($machineCol)) {
                $machineCol = str_replace(["\r", "\n", '"'], "", $machineCol);
                
                // Split multiple machines by '/' or '&' (e.g., KS500 / KS600 / KS800)
                $rawMachines = preg_split('/\s*(?:\/|&)\s*/', $machineCol);
                $currentMachines = [];
                foreach ($rawMachines as $m) {
                    $m = trim($m);
                    if (!empty($m)) {
                        $currentMachines[] = $m;
                    }
                }
            }

            // If consumable column is provided, update current consumable
            if (!empty($consumableCol)) {
                $currentConsumable = str_replace(["\r", "\n", '"'], "", $consumableCol);
            }

            // If we don't have an item code, or haven't parsed a machine/consumable yet, skip insertion
            if (empty($itemCodeCol) || empty($currentMachines) || empty($currentConsumable)) {
                continue;
            }

            $itemCodeName = str_replace(["\r", "\n", '"'], "", $itemCodeCol);

            // Process and insert for each parsed machine
            foreach ($currentMachines as $machineName) {
                // 1. Machine (subcategory table)
                $stmt = $conn->prepare("SELECT id FROM subcategories WHERE subcategory_name = ? AND category_id = ? AND is_deleted = 0 LIMIT 1");
                $stmt->bind_param("si", $machineName, $category_id);
                $stmt->execute();
                $res = $stmt->get_result();
                
                if ($res->num_rows == 0) {
                    $stmt_insert = $conn->prepare("INSERT INTO subcategories (subcategory_name, category_id, is_deleted) VALUES (?, ?, 0)");
                    $stmt_insert->bind_param("si", $machineName, $category_id);
                    $stmt_insert->execute();
                    $model_id = $stmt_insert->insert_id;
                    echo "<p style='color:green; margin:2px 0;'>✅ Inserted New Machine: <b>$machineName</b></p>";
                } else {
                    $model_id = $res->fetch_assoc()['id'];
                }
                $stmt->close();
                
                // 2. Consumable (consumables table)
                $stmt_cons = $conn->prepare("SELECT id FROM consumables WHERE consumable_name = ? AND model_id = ? AND is_deleted = 0 LIMIT 1");
                $stmt_cons->bind_param("si", $currentConsumable, $model_id);
                $stmt_cons->execute();
                $res_cons = $stmt_cons->get_result();
                
                if ($res_cons->num_rows == 0) {
                    $stmt_insert_cons = $conn->prepare("INSERT INTO consumables (consumable_name, model_id, is_deleted) VALUES (?, ?, 0)");
                    $stmt_insert_cons->bind_param("si", $currentConsumable, $model_id);
                    $stmt_insert_cons->execute();
                    $cons_id = $stmt_insert_cons->insert_id;
                } else {
                    $cons_id = $res_cons->fetch_assoc()['id'];
                }
                $stmt_cons->close();
                
                // 3. Item Code (item_codes table)
                $stmt_item = $conn->prepare("SELECT id FROM item_codes WHERE item_name = ? AND consumable_id = ? AND is_deleted = 0 LIMIT 1");
                $stmt_item->bind_param("si", $itemCodeName, $cons_id);
                $stmt_item->execute();
                $res_item = $stmt_item->get_result();
                
                if ($res_item->num_rows == 0) {
                    $stmt_insert_item = $conn->prepare("INSERT INTO item_codes (item_name, consumable_id, is_deleted) VALUES (?, ?, 0)");
                    $stmt_insert_item->bind_param("si", $itemCodeName, $cons_id);
                    $stmt_insert_item->execute();
                    echo "<span style='color:blue; margin-left: 20px;'>➕ Added Item Code: <i>$itemCodeName</i> under $currentConsumable ($machineName)</span><br>";
                    $countItems++;
                }
                $stmt_item->close();
            }
        }
        
        fclose($handle);
        echo "<p><strong>Finished processing $csvFile. Added $countItems new item codes.</strong></p><hr>";
    } else {
        echo "<p style='color:red;'>❌ Failed to open CSV file '$csvFile'.</p>";
    }
}

echo "<h4>🎉 Update Complete! You can now safely delete this file from the server.</h4>";
?>
