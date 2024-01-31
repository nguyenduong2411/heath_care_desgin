INSERT INTO accounts (role_id, username, email, password, salt, created_on, login_status, last_update_datetime, delete_flg)
VALUES (
    0, -- user role
    :userName, -- username
    :email, -- email
    :password, -- password
    :salt, -- salt
    NOW(), -- created_on
    0, -- login_status
    NOW(), -- last_update_datetime
    0 -- delete_flg
);