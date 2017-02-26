<?php
  include 'Includes.php';
  set_time_limit(0);
  $data = $_POST['links'];
  //$data = json_decode($data, true);
  foreach($data as $v){
    echo json_encode(array('text' => $v));
    $req->req(WEBHOOK_URL, 'post', json_encode(array('text' => $v)));
  }
?>
