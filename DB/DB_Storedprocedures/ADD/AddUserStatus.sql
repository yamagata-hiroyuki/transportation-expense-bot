CREATE OR REPLACE FUNCTION transportation_expense_bot."AddUserStatus"(_user_id INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN			-- Exec part
	INSERT INTO transportation_expense_bot."USER_STATUS"(
		"USER_ID"
		,"STATUS"
	)
	SELECT (
		_user_id,
		0
	);
END;
$function$