CREATE OR REPLACE FUNCTION transportation_expense_bot."SetTempRouteInfo_UserPrice"(_user_address VARCHAR, _price INT, _user_price INT,_trans_exp INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare localÅ@variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	UPDATE transportation_expense_bot."TEMP_ROUTE_INFO"
	SET "PRICE" = _price,
		"USER_PRICE" = _user_price,
		"TRANS_EXP" = _trans_exp
	WHERE "USER_ID" = _user_id;
END;
$function$