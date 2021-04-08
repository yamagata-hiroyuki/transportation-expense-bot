CREATE OR REPLACE FUNCTION transportation_expense_bot."GetTempRouteInfo_UserPrice"(_user_address VARCHAR)
 RETURNS TABLE("user_price" BOOL)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local�@variable 
BEGIN					-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	RETURN QUERY
	SELECT "USER_PRICE"
	FROM transportation_expense_bot."TEMP_ROUTE_INFO"
	WHERE "USER_ID" = _user_id;
END;
$function$