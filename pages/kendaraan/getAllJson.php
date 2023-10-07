<?php
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
require_once '../../function/models/kendaraan.php';

$data_json = getAllJson();

$json =  json_encode($data_json, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;
