CREATE OR REPLACE FUNCTION transportation_expense_bot."SetSelectedDeleteRouteInfo"(_user_address VARCHAR, _route_no INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local　variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- Update user STATUS
	UPDATE transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO"
	SET "SELECTED_ROUTE_NO" = _route_no
	WHERE "USER_ID" = _user_id;
END;
$function$