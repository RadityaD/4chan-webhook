<?php
require 'Includes.php';

$juduls = [];
$tp = $_POST['threads'];
$tp = $req->req($tp, 'get', '');
$tp = json_decode($tp, true);

$postno = $tp["posts"][0]["no"];
array_push($juduls, $postno);
if(isset($tp["posts"][0]["sub"])){
  $sub = $tp["posts"][0]["sub"];
  //$juduls[$postno] = $tp["posts"][0]["sub"];
  array_push($juduls, $tp["posts"][0]["sub"]);
}
else{
  $sub = $tp["posts"][0]["com"];
  //$juduls[$postno] = $tp["posts"][0]["com"];
  array_push($juduls, $tp["posts"][0]["com"]);
}

echo json_encode($juduls);
?>
