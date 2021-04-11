CREATE OR REPLACE FUNCTION transportation_expense_bot."GetIsRouteInfoExist"(_user_address VARCHAR)
 RETURNS BOOL
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id	INT;		-- Declare localÅ@variable
BEGIN                        -- Exec part
    -- get USER_ID
    SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
    
    RETURN EXISTS(
    SELECT 1
    FROM transportation_expense_bot."ROUTE_INFO"
    WHERE "USER_ID" = _user_id
    );
END;
$function$