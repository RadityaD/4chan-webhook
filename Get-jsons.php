<?php
  require 'Includes.php';

  $tj = [];
  if(BOARD == ''){
    echo 'Empty Board';
    exit(0);
  }
  //Ambil Json threads
  $threads = $req->req(THREAD, 'get', '');
  $threads = json_decode($threads, true);

  for($i=0;$i<count($threads); $i++){
    foreach($threads[$i]["threads"] as $k){
      array_push($tj, THREADS.$k["no"].'.json');
    }
  }
  echo json_encode($tj);
?>
