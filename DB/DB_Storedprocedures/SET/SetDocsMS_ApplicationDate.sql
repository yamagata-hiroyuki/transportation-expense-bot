CREATE OR REPLACE FUNCTION transportation_expense_bot."SetDocsMS_ApplicationDate"(_user_address VARCHAR, _docs_id INT, _application_date DATE)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare localÅ@variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	UPDATE transportation_expense_bot."DOCS_MS"
	SET "APPLICATION_DATE" = _application_date
	WHERE "USER_ID" = _user_id AND "DOCS_ID" = _docs_id;
END;
$function$