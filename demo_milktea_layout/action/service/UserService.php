<?php

namespace action\service;

include($_SERVER['DOCUMENT_ROOT'] . '/milktea/setting/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/milktea/action/common/Query.php');

use action\common\Query;
use action\service\FileService;
use action\service\MailService;

class UserService
{
    public $query;
    public $config;
    public $fileService;
    public $mailService;

    public function __construct()
    {
        $this->query =  new Query();
        $this->fileService = new FileService();
        $this->mailService = new MailService();
        $this->config = $this->fileService->parseFilelIni(CONFIG_FILE);
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
            'cost' => $this->config['password']['password_hash_code'],
        ];

        $rawPassword = $this->config['password']['pepper'] . $passowrd . $salt;

        return password_hash($rawPassword, PASSWORD_BCRYPT, $options);
    }

    /** 
     * Gửi mail xác minh 
     * @param array|string $to danh sách chỉ mail nhận
     * @param int $verificationCode mã xác thực
     * @return bool TRUE gửi mail thành công
     */
    public function sendVerifyMail(array|string $to, int $verificationCode): bool
    {
        $rawMessage = file_get_contents(ROOT . "/verify-mail-template.html");
        $message = str_replace('{{ verificationCode }}', $verificationCode, $rawMessage);

        return $this->mailService->sendHtmlMail(
            $this->config["mail"]["sender"],
            $to,
            VERIFY_MAIL_SUBJECT,
            $message
        );
    }
}
