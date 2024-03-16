SELECT
    COUNT(1) AS CNT
FROM
    user_verify_email
WHERE
    verification_code=:verificationCode
    AND otp=:otp
    AND verify_flg=0
    AND delete_flg=0;