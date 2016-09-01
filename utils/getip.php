<?php

/**
 * 获取客户端请求IP地址
 */
function getIP()
{
    $headerRealIp = array("X_Real_IP", "X_Forwarded_For", "Proxy_Client_IP",
        "WL_Proxy_Client_IP", "HTTP_CLIENT_IP", "HTTP_X_FORWARDED_FOR");
    $remoteIp = $_SERVER["REMOTE_ADDR"];
    foreach ($headerRealIp as $k) {
        $realIp = isset($_SERVER[$k]) ? $_SERVER[$k] : '';
        $realIp = trim($realIp);
        if (strlen($realIp) > 0 && strcasecmp("unknown", $realIp)) {
            $remoteIp = $realIp;
            break;
        }
    }
    return $remoteIp;
}

echo getIP();
