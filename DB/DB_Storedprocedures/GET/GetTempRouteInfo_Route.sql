CREATE OR REPLACE FUNCTION transportation_expense_bot."GetTempRouteInfo_Route"(_user_address VARCHAR)
 RETURNS TABLE("route" VARCHAR)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local?@variable 
BEGIN					-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	RETURN QUERY
	SELECT "ROUTE"
	FROM transportation_expense_bot."TEMP_ROUTE_INFO"
	WHERE "USER_ID" = _user_id;
END;
$function$