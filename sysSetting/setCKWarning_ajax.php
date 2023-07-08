<?php

$data = $_POST['data'];

$fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_cklimitVal.txt";
file_put_contents($fpath, $data);


echo json_encode("aaa");

?>