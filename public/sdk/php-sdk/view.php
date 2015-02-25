<?php
    require 'ip-detector.php';
    $server_ip = 'http://192.168.2.62:8080';

    if (isset($_GET['id']) && ($_GET['token']))
    {
        $ip = get_ip_address();
        $id =  $_GET['id'];
        $token =  $_GET['token'];
        $data = json_encode(['id'=>$id,'token'=>$token,'ip'=>$ip]);
        $ch = curl_init($server_ip.'/views');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            )
        );
        $response = curl_exec($ch);
        echo $response;
}