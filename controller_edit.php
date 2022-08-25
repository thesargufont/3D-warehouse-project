<?php
$raw_selected_pallet = $_POST['selected_pallet'];
$location_destination = $_POST['location_destination'];
$datas = $_POST['datas'];

$data_input = explode(' ', $raw_selected_pallet);
$selected_pallet =  $data_input[2];

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

foreach($datas as $item){
    if($item['LOCATION'] == $selected_pallet){
        $field = [
            $location_destination,
            $item['ITEM_NO'],
            $item['ITEM_DESCRIPTION'],
            $item['SIZE'],
            $item['ITEM_WGT'],
            $item['WEEKLY_MVMT'],
            $item['QTY_PER_PALLET'],
            $item['DAMAGED_PROBABILITY']
        ];
        $list[] = $field;
    } else {
        $field = [
            $item['LOCATION'],
            $item['ITEM_NO'],
            $item['ITEM_DESCRIPTION'],
            $item['SIZE'],
            $item['ITEM_WGT'],
            $item['WEEKLY_MVMT'],
            $item['QTY_PER_PALLET'],
            $item['DAMAGED_PROBABILITY']
        ];
        $list[] = $field;
    }
}

print_r($list);
$fp = fopen('files\INVENTORY.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
echo json_encode('success');