<?php
$uid = $_GET['uid'] ?: 1;
// openid生成规则
calcOpenid($uid);

/**
 * 不同uid唯一
 * @param $uid
 */
function calcOpenid($uid)
{
    $id = generateBusinessID(1);
    $id36 = base_convert($id, 10, 36);
echo $id36;
    exit();
    $length = 32;
    $rand_len = $length - strlen($id36) - strlen($uid) - 1;
    $rand_str = generateRandStr($rand_len);
    echo $id36 . $rand_str . '0' . $uid;
    echo '<br />';
    echo base64_encode($id36 . $rand_str . '0' . $uid);
}

function generateBusinessID($business_id = 1, $created_at = false)
{
    if ($created_at) {
        $time = $created_at * 1000 + rand(0, 999);
    } else {
        $time = round(microtime(true) * 1000); //使用当前时间戳
    }

    if ($business_id > pow(2, 6)) {
        return false;
    }

    $increment = rand(0, pow(2, 9));
    $id = $time << (64 - 42);
    $id |= 0 << 16; // 写入IDC
    $id |= $business_id << 10; // 写入业务类型
    $id |= $increment;
    return $id;
}

function generateRandStr($length = 8)
{
//    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $str;
}