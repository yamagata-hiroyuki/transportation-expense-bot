CREATE OR REPLACE FUNCTION transportation_expense_bot."GetDocsMS_DocsIDs"(_user_address VARCHAR)
 RETURNS TABLE(
	"docs_id"		INT
)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id	INT;		-- Declare localÅ@variable
BEGIN						-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	RETURN QUERY
	SELECT 
		"DOCS_ID"
	FROM transportation_expense_bot."DOCS_MS"
	WHERE "USER_ID" = _user_id;
END;
$function$