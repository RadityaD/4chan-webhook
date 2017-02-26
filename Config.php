<?php
  //EDIT $WEBHOOK_URL with your Webhook URL from Discord
	//https://hooks.slack.com/services/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
//https://discordapp.com/api/webhooks/259413299672776704/PDmF4lQ7lH_J8q6ty2sB3tjowGtj0igUXacQ1gGzeO4vlhtanZr9YHsFa2UOLmL3sZa7
  define('WEBHOOK_URL', 'https://hooks.slack.com/services/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');
  define('API','https://a.4cdn.org');
  define('API_IMG' , 'https://i.4cdn.org');
  //define('ACTION', $_POST['action']);
  define('BOARD' , $_COOKIE['selection']);
  define('THREAD' , API.BOARD.'threads.json');
  define('THREADS' , API.BOARD.'thread/');
  define('MEDIA', API_IMG.BOARD);
?>
