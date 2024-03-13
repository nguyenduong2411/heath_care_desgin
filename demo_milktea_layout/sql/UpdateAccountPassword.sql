UPDATE
    accounts
SET
    password=:password,
    salt=:salt,
    last_update_datetime=NOW()
WHERE
    email=:email
    AND delete_flg=0;
