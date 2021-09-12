CREATE OR REPLACE FUNCTION transportation_expense_bot."SetGroupName"(_user_address VARCHAR, _group_name VARCHAR)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local　variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- Update user STATUS
	UPDATE transportation_expense_bot."REGISTERED_USERS"
	SET "GROUP_NAME" = _group_name
	WHERE "USER_ID" = _user_id;
END;
$function$