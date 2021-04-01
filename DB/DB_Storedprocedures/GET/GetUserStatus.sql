CREATE OR REPLACE FUNCTION transportation_expense_bot."GetUserStatus"(_user_address VARCHAR)
 RETURNS TABLE(user_status CHAR)
 LANGUAGE plpgsql
AS $function$
DECLARE _userId INT;
BEGIN
	-- get USER ID
	SELECT "USER_ID" INTO _userId FROM transportation_expense_bot."REGISTERED_USERS" WHERE "USER_ADDRESS" = _user_address;

	-- get STATUS and return
	RETURN QUERY
	SELECT "STATUS"
	FROM transportation_expense_bot."USER_STATUS"
	WHERE "USER_ID" = _userId;
END;
$function$