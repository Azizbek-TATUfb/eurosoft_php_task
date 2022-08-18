<?php
function getUserIp(){
    return ["IP" => $_SERVER['REMOTE_ADDR']];
}
function getUserOS(){
    return ['OS' => php_uname()];
}
function getUserBrowser(){
    return ['browser' => $_SERVER['HTTP_USER_AGENT']];
}

echo "<pre>";
print_r(getUserIp());
print_r(getUserOS());
print_r(getUserBrowser());
echo "</pre>";