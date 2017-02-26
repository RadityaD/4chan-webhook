<?php

  define('WEBHOOK_URL', 'https://hooks.slack.com/services/T038RGMSP/B3N6XJG2E/***');
  define('API','https://a.4cdn.org');
  define('API_IMG' , 'https://i.4cdn.org');
  //define('ACTION', $_POST['action']);
  define('BOARD' , $_COOKIE['selection']);
  define('THREAD' , API.BOARD.'threads.json');
  define('THREADS' , API.BOARD.'thread/');
  define('MEDIA', API_IMG.BOARD);
?>
