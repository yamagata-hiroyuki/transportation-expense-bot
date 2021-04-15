CREATE OR REPLACE FUNCTION transportation_expense_bot."AddDocsMS"(_user_address VARCHAR,_docs_id INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id		INT;	-- Declare local variable
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- Register new ROUTE_INFO
	INSERT INTO transportation_expense_bot."DOCS_MS"(
		"USER_ID"
		,"DOCS_ID"
	)
	VALUES (
	_user_id,
	_docs_id
	);
END;
$function$