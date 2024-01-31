<?php

namespace action\service;

include($_SERVER['DOCUMENT_ROOT'] . '/milktea/action/common/Query.php');

use action\common\Query;

class UserService
{
    public $query;
    public $sysParams;

    public function __construct()
    {
        $this->query =  new Query();
        $this->sysParams = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/milktea/setting/system_parameter.ini', true);
    }

    /**
     * Get account bằng user_name
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $params danh chứa tham số user_name
     * @return array danh sách thông tin account
     */
    public function getAccountByUserName(string $sqlFilePath, array $sqlParams = [])
    {
        return $this->query->doSelect($sqlFilePath, $sqlParams);
    }

    /** 
     * Đăng ký account
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $params danh chứa thông tin đăng ký account
     * @return bool TRUE đăng ký thành công hoặc FLASE đăng ký thất bại
     */
    public function registerAccount(string $sqlFilePath, array $sqlParams = [])
    {
        return $this->query->doExecute($sqlFilePath, $sqlParams);
    }

    /**
     *  Mã hóa mật khẩu
     * 
     * @param string $passowrd mật khẩu chưa mã hóa
     * @param string $salt
     * @return string mật khẩu đã được mã hóa
     */
    public function makePasswordHash(string $passowrd, string $salt)
    {
        $options = [
            'cost' => $this->sysParams['PASSWORD_HASH_COST'],
        ];

        $rawPassword = $this->sysParams['PASSWORD_PEPPER'] . $passowrd . $salt;

        return password_hash($rawPassword, PASSWORD_BCRYPT, $options);
    }
}
