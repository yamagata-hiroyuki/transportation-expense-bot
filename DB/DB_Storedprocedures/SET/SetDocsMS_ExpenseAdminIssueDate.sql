CREATE OR REPLACE FUNCTION transportation_expense_bot."SetDocsMS_ExpenseAdminIssueDate"(_user_address VARCHAR, _docs_id INT, _expense_admin_issue_date DATE)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id INT;		-- Declare localÅ@variable 
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 
	
	UPDATE transportation_expense_bot."DOCS_MS"
	SET "EXPENSE_ADMIN_ISSUE_DATE" = _expense_admin_issue_date
	WHERE "USER_ID" = _user_id AND "DOCS_ID" = _docs_id;
END;
$function$