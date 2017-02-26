<?php

  include 'Request.php';
  include 'Config.php';

  //Deklarasi
  define('API','https://a.4cdn.org');
  define('API_IMG' , 'https://i.4cdn.org/wsg/');

  //define('BOARD' , $_POST['selection']);
  define('ACTION', $_POST['action']);
  define('BOARD' , $_POST['selection']); // BOARDS Choose your dank memes
  define('THREAD' , API.BOARD.'threads.json');
  define('THREADS' , API.BOARD.'thread/');
  $req = new request();

  if(BOARD == ''){
    echo 'Empty Board';
    exit(0);
  }

  //Variable Debugging
  $thread_jsons = [];
  $juduls = [];
  $links = [];
  $finalarr = [];

  //Ambil Json threads
  $threads = $req->req(THREAD, 'get', '');
  $threads = json_decode($threads, true);

  function getButton(){
    global $threads, $req, $juduls, $thread_jsons;
    for($i=0;$i<count($threads); $i++){
      foreach($threads[$i]["threads"] as $k){
        $tp = $req->req(THREADS.$k["no"].'.json', 'get', '');
        $tp = json_decode($tp, true);
        array_push($thread_jsons, THREADS.$k["no"].'.json');

        if(isset($tp["posts"][0]["sub"])){
          $sub = $tp["posts"][0]["sub"];
          array_push($juduls, $tp["posts"][0]["sub"]);
        }
        else{
          $sub = $tp["posts"][0]["com"];
          array_push($juduls, $tp["posts"][0]["com"]);
        }
      }
    }
    return json_encode($juduls);
  }

  function getAll(){
    //Looping buat cari Json threads
    for($i = 0; $i < count($threads); $i++){
      //Looping semua Threads dalem Json threadsnya
      foreach($threads[$i]["threads"] as $k){
        //Looping nomor threads buat ambil json-nya
        $tp = $req->req(THREADS.$k["no"].'.json', 'get', '');
        $tp = json_decode($tp, true);

        //DEBUGGER
        array_push($thread_jsons, THREADS.$k["no"].'.json');

        //Dapetin Judul
        if(isset($tp["posts"][0]["sub"])){
          $sub = $tp["posts"][0]["sub"];

          //DEBUG
          array_push($juduls, $tp["posts"][0]["sub"]);
        }
        else{
          $sub = $tp["posts"][0]["com"];

          //DEBUG
          array_push($juduls, $tp["posts"][0]["com"]);
        }

        for($j = 0; $j < count($tp["posts"]); $j++){
          if(isset($tp["posts"][$j]["ext"]) && isset($tp["posts"][$j]["tim"])){
            $EXTselector = $tp["posts"][$j]["ext"];
            $TIMselector = $tp["posts"][$j]["tim"];
            $FNselector = htmlspecialchars($tp["posts"][$j]["filename"]);
            $ALLselector = $FNselector.' - '.API_IMG.$TIMselector.$EXTselector;

            //$finalarr[$sub] = $ALLselector;
            array_push($links, $ALLselector);
          }
        }
      }
    }
  }

  switch(ACTION){
    case 'getButton': echo getButton();
    break;
  }
  //print_r($links);
  //echo var_dump($thread_jsons);
  //echo BOARD;
  //getThreadNames();
?>
