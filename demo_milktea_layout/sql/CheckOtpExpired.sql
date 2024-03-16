SELECT
    CASE
        WHEN NOT NOW() <= expired_date_time THEN 1 -- mã xác thực đã hết hạn
        ELSE 0
    END AS EXPIRED_FLG
FROM
    user_verify_email
WHERE
    verification_code=:verificationCode
    AND otp=:otp
    AND delete_flg=0
GROUP BY verify_id;