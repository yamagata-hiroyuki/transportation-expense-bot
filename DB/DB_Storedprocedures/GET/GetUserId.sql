CREATE OR REPLACE FUNCTION transportation_expense_bot."GetUserId"(_user_address character varying)
 RETURNS TABLE(user_id integer)
 LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    SELECT "USER_ID"
    FROM transportation_expense_bot."REGISTERED_USERS"
    WHERE "USER_ADDRESS" = _user_address;
END;
$function$