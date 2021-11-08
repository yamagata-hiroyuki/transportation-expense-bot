CREATE OR REPLACE FUNCTION transportation_expense_bot."SetRouteInfo_DocsId"(_user_address VARCHAR, _route_no INT, _docs_id INT, _application_date DATE)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare local　variable 
	_is_exist BOOL;
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	-- check _docs_id is exist
	_is_exist = FALSE;
	SELECT INTO _is_exist EXISTS(SELECT * FROM transportation_expense_bot."DOCS_MS" WHERE "DOCS_ID" = _docs_id AND "USER_ID" = _user_id);
	
	IF _is_exist = FALSE
	THEN
		-- Insert
		PERFORM transportation_expense_bot."AddDocsMS"(_user_address,_docs_id);
		PERFORM transportation_expense_bot."SetDocsMS_ApplicationDate"(_user_address,_docs_id,_application_date);
	END IF;
	-- Update
	UPDATE transportation_expense_bot."ROUTE_INFO"
	SET "DOCS_ID" = _docs_id,
		"APPLICATION" = TRUE
	WHERE "USER_ID" = _user_id AND "ROUTE_NO" = _route_no;
END;
$function$