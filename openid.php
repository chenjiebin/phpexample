<?php

define('ORIGINAL_URL_SECRET_KEY', "mvkarelshop321");

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

    $length = 24;
    $rand_len = $length - strlen($id36) - strlen($uid) - 1;
    $rand_str = generateRandStr($rand_len);
    echo $id36 . $rand_str . '0' . $uid;
    echo '<br />';

    $MT_Des = new MT_Des();
    echo $MT_Des->encrypt_ungeneric(ORIGINAL_URL_SECRET_KEY, $id36 . $rand_str . '0' . $uid);
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


class MT_Des
{
    const ENCRYPT_MODE_BASE64 = 'base64';
    const ENCRYPT_MODE_HEX = 'hex';

    public function Encrypt($key, $text, $encodeMode = self::ENCRYPT_MODE_BASE64, $pcksChar = '')
    {
        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);
        $text = self::pkcs5_pad($text, $size, $pcksChar);

        $td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $text);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        switch ($encodeMode) {
            case self :: ENCRYPT_MODE_BASE64 :
                $data = base64_encode($data);
                break;
            case self:: ENCRYPT_MODE_HEX :
                $data = bin2hex($data);
                break;
        }

        return $data;
    }

    public function Decrypt($key, $encrypted, $decodeMode = self::ENCRYPT_MODE_BASE64)
    {

        switch ($decodeMode) {
            case self::ENCRYPT_MODE_BASE64 :
                $encrypted = base64_decode($encrypted);
                break;
            case self::ENCRYPT_MODE_HEX :
                $encrypted = hex2bin($encrypted);
        }

        $td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

        $ks = mcrypt_enc_get_key_size($td);
        mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $plain_text = self::pkcs5_unpad($decrypted);
        return $plain_text;
    }


    /**
     * 与客户端算法保持一致的加密方法
     *
     * @param $key
     * @param $text
     * @return string
     */
    public function EncryptForApp($key, $text)
    {
        return $this->Encrypt($key, $text, self::ENCRYPT_MODE_BASE64, 0);
    }

    /**
     * 与客户端解密算法一致的解密方法
     *
     * @param $key
     * @param $text
     * @return bool|string
     */
    public function DecryptForApp($key, $text)
    {
        return $this->Decrypt($key, $text, self::ENCRYPT_MODE_BASE64);
    }


    public function encrypt_ungeneric($key, $text)
    {
        if (PHP_VERSION_ID > 50600 && $key == ORIGINAL_URL_SECRET_KEY) {
            $key = $key . "\0\0\0\0\0\0\0\0\0\0";
        }
        $iv = mcrypt_create_iv(mcrypt_get_iv_size('tripledes', MCRYPT_MODE_ECB), MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt('tripledes', $key, $text, MCRYPT_MODE_ECB, $iv);
        $des3 = bin2hex($encrypted_string);
        #$base64=base64_encode($encrypted_string);
        return $des3;
    }

    public function decrypt_ungeneric($key, $encrypted)
    {
        if (PHP_VERSION_ID > 50600 && $key == ORIGINAL_URL_SECRET_KEY) {
            $key = $key . "\0\0\0\0\0\0\0\0\0\0";
        }
        $encrypted_string = @pack("H*", $encrypted);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size('tripledes', MCRYPT_MODE_ECB), MCRYPT_RAND);
        $plain_txt = mcrypt_decrypt('tripledes', $key, $encrypted_string, MCRYPT_MODE_ECB, $iv);

        return $plain_txt;
    }

    public static function pkcs5_pad($text, $blocksize, $char = null)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        if (is_null($char)) {
            $char = $pad;
        }
        return $text . str_repeat(chr($char), $pad);
    }

    // 为了保证与客户端的一致，这边直接从补位的字符汇总计算出个数以及补位字符对应数据
    public static function pkcs5_unpad($text)
    {
        // 获取补位的字符
        $char = ($text{strlen($text) - 1});

        // 查看补位字符个数
        $pad = substr_count($text, $char);

        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, $char, strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }
}