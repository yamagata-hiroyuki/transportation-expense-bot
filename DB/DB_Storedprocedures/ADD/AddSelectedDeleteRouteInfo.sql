CREATE OR REPLACE FUNCTION transportation_expense_bot."AddSelectedDeleteRouteInfo"(_user_id INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN			-- Exec part
	INSERT INTO transportation_expense_bot."SELECTED_DELETE_ROUTE_INFO"(
		"USER_ID"
		,"SELECTED_ROUTE_NO"
	)
	VALUES (
		_user_id,
		NULL
	);
END;
$function$