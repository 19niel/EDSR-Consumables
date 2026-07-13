import csv
import sys
import os
import re

# Files
km_color_file = r"c:\xampp\htdocs\e-dsr-cons\scratch\EDSR CONS 1(KM COLOR) (1).csv"
km_mono_file = r"c:\xampp\htdocs\e-dsr-cons\scratch\EDSR CONS 1(KM MONO) (1).csv"
riso_file = r"c:\xampp\htdocs\e-dsr-cons\scratch\EDSR CONS 1(RISO).csv"
out_file = r"c:\xampp\htdocs\e-dsr-cons\scratch\seed_consumables.sql"

# Category IDs
CAT_KM_COLOR = 393
CAT_KM_MONO = 395
CAT_RISO = 396

# Global IDs
subcategory_id = 400
consumable_id = 1
item_code_id = 1

subcategories_sql = []
consumables_sql = []
item_codes_sql = []

def parse_csv(file_path, category_id):
    global subcategory_id, consumable_id, item_code_id
    
    current_model_ids = []
    # mapping of current_model_id -> current_consumable_id
    current_consumable_ids = {} 
    
    with open(file_path, 'r', encoding='utf-8') as f:
        reader = csv.reader(f)
        header = next(reader)
        
        for row in reader:
            if not row or not any(row):
                continue
                
            model_str = row[0].strip() if len(row) > 0 else ""
            consumable_str = row[1].strip() if len(row) > 1 else ""
            item_code_str = row[2].strip() if len(row) > 2 else ""
            
            if model_str:
                # Split models by / or &
                model_parts = re.split(r'[/&]', model_str.replace("\n", ""))
                current_model_ids = []
                current_consumable_ids = {}
                
                for part in model_parts:
                    part = part.strip()
                    if part:
                        subcategories_sql.append(f"({subcategory_id}, {category_id}, '{part.replace(chr(39), chr(39)+chr(39))}', 0)")
                        current_model_ids.append(subcategory_id)
                        subcategory_id += 1
                        
            if consumable_str:
                consumable_str = consumable_str.replace("\n", "").strip()
                # Create a consumable entry for EACH of the current models
                for m_id in current_model_ids:
                    consumables_sql.append(f"({consumable_id}, {m_id}, '{consumable_str.replace(chr(39), chr(39)+chr(39))}', 0)")
                    current_consumable_ids[m_id] = consumable_id
                    consumable_id += 1
                    
            if item_code_str:
                item_code_str = item_code_str.replace("\n", "").strip()
                # Create an item code entry for EACH of the current consumables
                for m_id in current_model_ids:
                    c_id = current_consumable_ids.get(m_id)
                    if c_id is not None:
                        item_codes_sql.append(f"({item_code_id}, {c_id}, '', '{item_code_str.replace(chr(39), chr(39)+chr(39))}', 0)")
                        item_code_id += 1

parse_csv(km_color_file, CAT_KM_COLOR)
parse_csv(km_mono_file, CAT_KM_MONO)
parse_csv(riso_file, CAT_RISO)

with open(out_file, 'w', encoding='utf-8') as f:
    f.write("-- =================================================================\n")
    f.write("-- EDSR Consumables Seed Data (KM Color, KM Mono, RISO)\n")
    f.write("-- =================================================================\n\n")
    f.write("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n")
    f.write("START TRANSACTION;\n\n")
    
    # Empty existing tables for a clean slate
    f.write("DELETE FROM `item_codes`;\n")
    f.write("DELETE FROM `consumables`;\n")
    f.write("DELETE FROM `subcategories` WHERE `category_id` IN (393, 395, 396);\n\n")
    
    # Subcategories
    f.write("-- Table: subcategories\n")
    f.write("INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `is_deleted`) VALUES\n")
    f.write(",\n".join(subcategories_sql))
    f.write(";\n\n")
    
    # Consumables
    f.write("-- Table: consumables\n")
    f.write("INSERT INTO `consumables` (`id`, `model_id`, `consumable_name`, `is_deleted`) VALUES\n")
    f.write(",\n".join(consumables_sql))
    f.write(";\n\n")
    
    # Item Codes
    f.write("-- Table: item_codes\n")
    f.write("INSERT INTO `item_codes` (`id`, `consumable_id`, `item_code`, `item_name`, `is_deleted`) VALUES\n")
    f.write(",\n".join(item_codes_sql))
    f.write(";\n\n")
    
    f.write("COMMIT;\n")

print(f"Generated {out_file} successfully.")
print(f"Inserted {len(subcategories_sql)} subcategories, {len(consumables_sql)} consumables, and {len(item_codes_sql)} item codes.")
