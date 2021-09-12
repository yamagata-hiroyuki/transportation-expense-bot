CREATE OR REPLACE FUNCTION transportation_expense_bot."AddRegisteredUser"(_user_address VARCHAR, _user_name VARCHAR,_group_name VARCHAR)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_max INT;   -- Declare local variable
BEGIN			-- Exec part
	-- get max USER_ID
	SELECT INTO _max
	CASE
		WHEN MAX("USER_ID") IS NULL THEN 1
		ELSE MAX("USER_ID") + 1
	END
	FROM transportation_expense_bot."REGISTERED_USERS";

	-- Register new user into REGISTERED_USERS
	INSERT INTO transportation_expense_bot."REGISTERED_USERS"(
		"USER_ADDRESS"
		,"USER_NAME"
		,"USER_ID"
		,"GROUP_NAME"
	)
	VALUES (
		_user_address,
		_user_name,
		_max,
		_group_name
	);

	-- Add new user into USER_STATUS,TEMP_ROUTE_INFO
	PERFORM transportation_expense_bot."AddUserStatus"(_max);
	PERFORM transportation_expense_bot."AddTempRouteInfo"(_max);
	PERFORM transportation_expense_bot."AddSelectedDeleteRouteInfo"(_max);
END;
$function$