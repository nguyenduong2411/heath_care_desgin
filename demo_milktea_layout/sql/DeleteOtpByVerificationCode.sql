UPDATE
    user_verify_email
SET
    delete_flg = 1,
    update_datetime = NOW()
WHERE
    verification_code=:verificationCode
    AND otp=:otp
    AND delete_flg=0;