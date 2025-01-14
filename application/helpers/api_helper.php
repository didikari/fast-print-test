<?php

function get_api_data($url, $username, $password) {
    $password = md5($password); 
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
    
    curl_setopt($ch, CURLOPT_POST, true);
    
    $postData = [
        'username' => $username,
        'password' => $password
    ];
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt'); 

    curl_setopt($ch, CURLOPT_HEADER, true); 

    $response = curl_exec($ch);
    
    $header = curl_getinfo($ch);
    
    if (curl_errno($ch)) {
        log_message('error', 'Curl error: ' . curl_error($ch));
        curl_close($ch);
        return false;
    }

    if (empty($response)) {
        log_message('error', 'API response is empty');
        curl_close($ch);
        return false;
    }

    $header_size = $header['header_size'];
    $body = substr($response, $header_size); 
    $response_header = substr($response, 0, $header_size); 
    
    // echo '<pre>';
    // print_r($response_header); 
    // print_r($body); 
    // echo '</pre>';

    $data = json_decode($body, true);

    curl_close($ch);

    if ($data === null) {
        log_message('error', 'Failed to decode JSON response');
        return false;
    }

    return $data;
}
