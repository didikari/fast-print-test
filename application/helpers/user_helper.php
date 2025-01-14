<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('extract_user_api')) {
    function extract_user_api($api_url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $api_url);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
            return null;
        }

        curl_close($ch);

        $dom = new DOMDocument;

        libxml_use_internal_errors(true); 
        $dom->loadHTML($response);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $span = $xpath->query("//span[@style='color:red']")->item(0);

        if ($span) {
            $text = trim($span->nextSibling->nodeValue);
            $username = strtok($text, ' ');
            return rtrim($username, '%');
        }

        return null;
    }
}
