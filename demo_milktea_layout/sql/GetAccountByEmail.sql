SELECT
    COUNT(1) AS CNT
FROM
    accounts
WHERE
    email=:userEmail
    AND delete_flg=0;