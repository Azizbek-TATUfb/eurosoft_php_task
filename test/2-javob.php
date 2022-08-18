<?php
$fileName = dirname(__DIR__).'/github.json';
$gitHubFile  = json_decode(file_get_contents($fileName));
echo "<pre>";
print_r($gitHubFile);
echo "</pre>";



function call()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERAGENT, "php/curl");
    curl_setopt($ch, CURLOPT_CAINFO, "/path/to/curl/cacert.pem");
    $output = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    var_dump($err);
    var_dump($errmsg);
    echo "<hr>";
    var_dump($info);
    echo "<hr>";
    var_dump($output);
    if($err == 0)
    {
        echo "ajoyib - sizda api.github.com saytiga kirishingiz mumkin";
    }
}
call();
