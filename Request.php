<?php
  class request {
    //Http request biar gampang
    public function req($url, $method, $content){
      $curl = curl_init();
      if($method == 'post'){
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_HTTPHEADER => array("Content-type: application/json"),
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $content
        ));
      }
      else {
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false
        ));
      }

      $res = curl_exec($curl);
      curl_close($curl);
      return $res;
    }
  }
?>
