<?php

$data = $_POST['data'];

$fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_wzlimitVal.txt";
file_put_contents($fpath, $data);


echo json_encode("1");

?>