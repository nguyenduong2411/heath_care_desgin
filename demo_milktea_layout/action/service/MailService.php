<?php

namespace action\service;

class MailService
{
    public function __construct()
    {
    }

    /**
     * Gửi mail với định dạng html
     * 
     * @param string $fromMail địa chỉ mail gửi
     * @param array|string $toMail danh sach địa chỉ email nhận
     * @param string $subject tiêu đề mail
     * @param string $message nội dung mail
     * @return bool TRUE gửi mail thành công
     */
    public function sendHtmlMail(
        string $fromMail = "",
        array|string $toMail = [],
        string $subject = "",
        string $message = ""
    ): bool {
        header("Content-Type: text/html; charset=UTF-8");
        // convert string to base64
        $subjectEncodeBase64 = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $messageEncodeBase64 = base64_encode($message);
        $fromEncodeBase64 = "=?UTF-8?B?" . base64_encode("Bubble Tea House") . "?= <$fromMail>";

        $to = implode(",", $toMail);
        $headers = array(
            "Content-type: text/html; charset=UTF-8",
            "Content-Transfer-Encoding: base64",
            "From: $fromEncodeBase64",
            "To: $to",
            "Date: " . date("r (T)")
        );
        
        $result = mail($to, $subjectEncodeBase64, $messageEncodeBase64, implode("\r\n", $headers));
        
        if (!$result) {
            throw new \Exception("Đã có lỗi phát sinh trong quá trình gửi mail");
        }

        return $result;
    }
}
