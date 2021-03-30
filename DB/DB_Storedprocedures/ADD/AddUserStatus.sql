CREATE OR REPLACE FUNCTION transportation_expense_bot."AddUserStatus"(_user_id integer)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN           --実行部
    INSERT INTO transportation_expense_bot."USER_STATUS"(
    "USER_ID"
    ,"STATUS"
    )
    SELECT
    _user_id,
    0;
END;
$function$