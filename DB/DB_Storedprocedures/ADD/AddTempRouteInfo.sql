CREATE OR REPLACE FUNCTION transportation_expense_bot."AddTempRouteInfo"(_user_id INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN			-- Exec part
	INSERT INTO transportation_expense_bot."TEMP_ROUTE_INFO"(
		"USER_ID"
	)
	VALUES (
		_user_id
	);
END;
$function$