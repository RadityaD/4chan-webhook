<html>
  <head>
    <meta charset="utf-8">
    <title>4Chan Webhook for Discord Dashboard</title>
    <!-- style -->
    <style>
      @import url('https://fonts.googleapis.com/css?family=Space+Mono:400,700');
      body {
        background-color: Cornsilk;
      }

      .wrapper {
        margin: 60px 100px 60px 100px;
        font-family: "Space Mono";
        display: box;
      }

      .container {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        justify-content: center;
        margin-top: 5px;
        max-height: 600px;
        overflow: auto;
        background-color: GreenYellow;
      }

      h1 {
        font-weight: 700;
      }

      p {
        max-width: 600px;
      }

      select {
        font-family: "Space Mono";
        font-weight: 700;
        font-size: 2rem;
        padding: 10px;
        width: 100%;
      }

      ol > li {
        padding: 2px;
      }

      .btn {
        width: 100%;
        margin: 5px 2rem 5px 2rem;
        padding: 5px;
        background-color: DarkOrange;
        color: #ffffff;
        font-family: "Space Mono";
        font-size: 2rem;
        border: 1px solid #ffffff;
      }

      .btn:nth-child(1){
        margin-top: 20px;
      }

      .btn:last-child{
        margin-bottom: 20px;
      }

      .btn:hover{
        border-color: CornflowerBlue;
      }

      #header {
        background-color: CornflowerBlue;
        padding: 10px;
      }

      #boards-selector {
        padding: 10px;
      }

      #boards-selector > div {
        margin: 2px;
        padding: 2px;
      }

      #boards-selector > div:nth-child(1) {
        width: 100%;
      }

      #thread-btn {
        background-color: Orange;
      }

      #links {
        background-color: HotPink;
        width: 100%;
      }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

  </head>
  <body>
    <div class="wrapper">
      <!-- HEADER -->
      <div id="header" class="">
        <h1>/4chan/ Webhook for Discord</h1>
        <p>This "app" will get all the links of files from any 4chan's boards, and post the data to Discord Webhook.</p>
      </div>
      <!-- BOARDS SELECTOR -->
      <div id="boards-selector" class="container">
        <div>
          <select id="selector" onchange="getData();">
            <option value="">SELECT BOARD</option>
            <?php
              require 'Request.php';
              $req = new request();

              $boards = $req->req('https://a.4cdn.org/boards.json', 'get', '');
              $boards = json_decode($boards, true);
              $len = count($boards["boards"]);

              for($i=0;$i<$len;$i++){
                $brd = '/'.$boards["boards"][$i]["board"].'/';
                $title = $boards["boards"][$i]["title"];
                $txt = $brd.' - '.$title;
                echo '<option value="'.$brd.'">'.$txt.'</option>';
              }
            ?>
          </select>
        </div>
      </div>
      <!-- BUTTONS -->
      <div id="thread-btn" class="container"></div>
      <!-- LINKS -->
      <div id="links">
        <ol id="theOL">
        </ol>
      </div>
      <button onclick="webhookPost();">ANU</button>
    </div>
    <script type="text/javascript">

      function getData(){
        var $boards = $('#selector option:selected').val();
        var $tb = $('#thread-btn');

        $.cookie('selection', $boards);

        $.ajax({
          method: 'GET',
          url: 'Get-jsons.php',
          beforeSend: function(){
            $tb.html('Loading... might take a while');
          },
          success: function(data){
            data = JSON.parse(data);
            $tb.html('');
            for(var i = 0; i<data.length; i++){
              $.ajax({
                method: 'POST',
                url: 'Get-threads.php',
                data: {threads: data[i]},
                success: function(td){
                  td = JSON.parse(td);
                  var btn = '<button id="'
                  +td[0]+'" class="btn">'
                  +td[1]+'</button>';

                  $tb.append(btn);
                }
              });
            }
          },
          error: function(){
            $tb.html('An error(s) has occured, please try again.');
          }
        });
      }

      function scrollTo(id){
        $('html, body').animate({
          scrollTop: $('#'+id).offset().top},
          'slow');
      }

      function webhookPost(){
        var arr = [];
        $('li').each(function(){
          //console.log($(this).text());
          arr.push($(this).text());
        });
        $.ajax({
          method: 'POST',
          url: 'Webhook-post.php',
          data: {links: arr},
          success: function(data){
            console.log(data);
          }
        });
      }

      $('#thread-btn').on('click', '.btn', function(){
        var td = $(this).attr('id');
        var dt = {threads: td};
        var $links = $('ol');

        scrollTo('links');
        $.ajax({
          method: 'POST',
          url: 'Get-links.php',
          data: dt,
          beforeSend: function(){
            $('#theOL').html('Loading... might take a while');
          },
          success: function(data){
            $('#theOL').html('');
            data = JSON.parse(data);
            for(var i = 0; i < data.length; i++){
              $("#theOL").append('<li>'+data[i]+'</li>');
            }
          },
          error: function() {
            //KSNG
          }
        });
      });
    </script>
  </body>
</html>
