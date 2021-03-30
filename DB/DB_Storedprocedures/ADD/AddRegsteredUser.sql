CREATE OR REPLACE FUNCTION transportation_expense_bot."AddRegisteredUser"(_user_address character varying)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
    _max INT;   --内部変数宣言
BEGIN           --実行部
    SELECT INTO _max CASE
                        WHEN MAX("USER_ID") IS NULL THEN 1
                        ELSE MAX("USER_ID") + 1
                    END
            FROM transportation_expense_bot."REGISTERED_USERS";
            
    INSERT INTO transportation_expense_bot."REGISTERED_USERS"(
    "USER_ADDRESS"
    ,"USER_ID"
    )
    SELECT
    _user_address,
    _max;
    
    PERFORM transportation_expense_bot."AddUserStatus"(_max);
END;
$function$