<?php


namespace App\Services\Auth;


/**
 * 颁发后无法禁用的token
 * 性能最好,无法提出用户登陆
 *
 * @package App\Services\Auth
 */
class JwtToken implements Token
{
    protected $key;

    public function __construct()
    {
        $this->key = env('APP_KEY', 'base64:w6sXSEUqtOddimxoVqFZH/076VgdPev6vJ25kFh9DRw=');
    }

    /**
     * @param $uid
     * @return array
     */
    public function make($uid): array
    {
        $str = (string) $uid.'.';
        $str = $str.substr(md5($str.$this->key), 0, 32 - strlen($str)).".".time();

        return [
            'str' => $str
        ];
    }

    /**
     * @param  array  $credentials
     * @return bool|int
     */
    public function validate(array $credentials = [])
    {
        $source = $credentials['str'];
        $arr    = explode('.', $source);

        if (count($arr) != 3) {
            return false;
        }

        $uid      = $arr[0];
        $md5Str   = $arr[1];
        $makeTime = $arr[2];

        // 过期检验
        if ( ($makeTime + 86400 *3) < time() ){
            return false;
        }

        $str      = (string) $uid.'.';
        $str      = substr(md5($str.$this->key), 0, 32 - strlen($str));

        if ($md5Str != $str) {
            return false;
        }

        return $uid;
    }
}