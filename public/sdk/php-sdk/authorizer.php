<?php
    require 'ip-detector.php';
    $appId = "your-appId";
    $appKey = "your-appKey";
    $ip = null;
    $server_ip = 'http://192.168.2.62:8080';

    if (isset($_GET['call']))
    {
        $ip = get_ip_address();
        $data = json_encode(["username"=>$appId, "password"=>$appKey, "ip"=>$ip]);
        global $data;
        $ch = curl_init($server_ip.'/auth');
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

