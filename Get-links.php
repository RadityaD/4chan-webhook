<?php
  include 'Includes.php';

  $links = [];
  $wb = [];
  $tp = $_POST['threads'];
  $tp = json_decode($req->req(THREADS.$tp.'.json', 'get', ''), true);

  for($j = 0; $j < count($tp["posts"]); $j++){
    if(isset($tp["posts"][$j]["ext"]) && isset($tp["posts"][$j]["tim"])){
      $EXTselector = $tp["posts"][$j]["ext"];
      $TIMselector = $tp["posts"][$j]["tim"];
      $FNselector = htmlspecialchars($tp["posts"][$j]["filename"]);
      $ALLselector = $FNselector.' - '.MEDIA.$TIMselector.$EXTselector;
      $ALLLinks = $FNselector.' - <a href="'.MEDIA.$TIMselector.$EXTselector.'" target="_blank">'.MEDIA.$TIMselector.$EXTselector.'</a>';

      //$finalarr[$sub] = $ALLselector;
      array_push($links, $ALLLinks);
      array_push($wb, $ALLselector);
    }
  }
  echo json_encode($links);
?>
