CREATE OR REPLACE FUNCTION transportation_expense_bot."GetSelectedDeleteRouteInfo"(_user_address VARCHAR)
 RETURNS TABLE("selected_delete_route_info"	INT)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local　variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- Update user STATUS
	RETURN QUERY
	SELECT "SELECTED_ROUTE_NO"
	FROM transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO"
	WHERE "USER_ID" = _user_id;
END;
$function$