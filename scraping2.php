#!/usr/bin/php
<?php
    $ch = curl_init();
    //curl_setopt($ch, option:CURLOPT_URL, value:"https://www.google.com");
    //curl_setopt($ch,option:CURLOPT_FOLLOWLOCATION,value:1);
    //curl_setopt($ch,option:CURLOPT_RETURNTRANSFER,value:1);
    $response= curl_exec($ch);
    curl_close($ch);
    print("Response: ".print_r($response,true)."\n");

?>
