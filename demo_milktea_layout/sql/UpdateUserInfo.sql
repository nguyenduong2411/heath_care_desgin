UPDATE user_info
SET
	first_name = :first_name
	, last_name = :last_name
	, date_of_birth = :date_of_birth
	, phone_number = :phone_number
	, address = :address
	, district = :district
	, city = :city
	, update_datetime = NOW()
WHERE
    account_id = :account_id -- account_id
	AND delete_flg = 0;