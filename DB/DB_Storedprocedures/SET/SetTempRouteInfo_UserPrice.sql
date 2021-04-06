CREATE OR REPLACE FUNCTION transportation_expense_bot."SetTempRouteInfo_UserPrice"(_user_address VARCHAR, _user_price INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare localÅ@variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	UPDATE transportation_expense_bot."TEMP_ROUTE_INFO"
	SET "USER_PRICE" = _user_price
	WHERE "USER_ID" = _user_id;
END;
$function$