CREATE OR REPLACE FUNCTION transportation_expense_bot."SetUserStatus"(_user_address VARCHAR, _status INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local　variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- Update user STATUS
	UPDATE transportation_expense_bot."USER_STATUS"
	SET "STATUS" = _status
	WHERE "USER_ID" = _user_id;
END;
$function$