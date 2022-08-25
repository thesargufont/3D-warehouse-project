<?php
$raw_existing_pallet_find = $_POST['existing_pallet_find'];
$datas = $_POST['datas'];

$data_input = explode(' ', $raw_existing_pallet_find);
$existing_pallet_find =  $data_input[2];

$find = [];
foreach($datas as $data){
    if($data['LOCATION'] == $existing_pallet_find){
        $find = $data;
    }
}

// CREATE CSV FILE 
$list = [];
$header = [
    'LOCATION'            ,
    'ITEM_NO'             ,
    'ITEM_DESCRIPTION'    ,
    'SIZE'                ,
    'ITEM_WGT'            ,
    'WEEKLY_MVMT'         ,
    'QTY_PER_PALLET'      ,
    'DAMAGED_PROBABILITY' 
];
$list[] = $header;

$field = [
    $find['LOCATION'],
    $find['ITEM_NO'],
    $find['ITEM_DESCRIPTION'],
    $find['SIZE'],
    $find['ITEM_WGT'],
    $find['WEEKLY_MVMT'],
    $find['QTY_PER_PALLET'],
    $find['DAMAGED_PROBABILITY']
];

// print_r($field);
        
$list[] = $field;

$fp = fopen('files\INVENTORY_FIND.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
echo json_encode('success');