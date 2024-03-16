INSERT INTO user_info
(
     account_id
	, first_name
	, last_name
	, date_of_birth
	, phone_number
	, address
	, district
	, city
    , created_datetime
	, update_datetime
	, delete_flg
) VALUES (
    :account_id -- account_id
	, :first_name -- first_name
	, :last_name -- last_name
	, :date_of_birth -- date_of_birth
	, :phone_number -- phone_number
	, :address -- address
	, :district -- district
	, :city -- city
    , NOW() -- created_datetime
	, NOW() -- update_datetime
	, 0 -- delete_flg
);