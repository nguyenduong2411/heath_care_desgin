SELECT
    first_name AS firstName
    , last_name AS lastName
    , date_of_birth AS dataOfBirth
    , phone_number AS phone
    , address
    , district
    , city
FROM
    user_info
WHERE
    account_id = :account_id
    And delete_flg = 0;