SELECT
    account_id,
    password,
    salt,
    email
FROM
    accounts
WHERE
    username=:userName;