CREATE OR REPLACE FUNCTION transportation_expense_bot."GetGroupName"(_user_address VARCHAR)
 RETURNS TABLE("group_name" VARCHAR)
 LANGUAGE plpgsql
AS $function$
BEGIN
	RETURN QUERY
	SELECT "GROUP_NAME"
	FROM transportation_expense_bot."REGISTERED_USERS"
	WHERE "USER_ADDRESS" = _user_address;
END;
$function$