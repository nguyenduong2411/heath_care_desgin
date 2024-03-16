INSERT INTO user_verify_email(verification_code, otp,expired_date_time, created_datetime, update_datetime, delete_flg)
VALUES (
    :vmid, -- verification_code
    :OTP, -- otp
    NOW() + (10 * interval '1 minute'), -- expired_date_time
    NOW(), -- created_datetime
    NOW(), -- update_datetime
    0 -- delete_flg
);