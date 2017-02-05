<?php

function get_by_curl($url, $post = false)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    //下面7个curl_setopt由wishinlife添加
    if (strtolower(substr($url, 0, 5)) == 'https') {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);// 从证书中检查SSL加密算法是否存在
    }
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}