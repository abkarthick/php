<?php
// Function to check url availability
function ping($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpcode >= 200 && $httpcode < 400) {
        return true;
    } else {
        return false;
    }
}

// Example usage
$url = "https://www.google.com";
if (ping($url)) {
    echo "Website is up!";
} else {
    echo "Website is down!";
}
