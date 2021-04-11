CREATE OR REPLACE FUNCTION transportation_expense_bot."GetRouteInfo"(_user_address VARCHAR)
 RETURNS TABLE(
	"route_no"		INT,
	"route_date"	DATE,
	"destination"	VARCHAR,
	"route"			VARCHAR,
	"rounds"		BOOL,
	"price"			INT,
	"user_price"	BOOL,
	"remarks"		VARCHAR,
	"application"	BOOL
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
		"ROUTE_NO"
		,"ROUTE_DATE"
		,"DESTINATION"
		,"ROUTE"
		,"ROUNDS"
		,"PRICE"
		,"USER_PRICE"
		,"REMARKS"
		,"APPLICATION"
	FROM transportation_expense_bot."ROUTE_INFO"
	WHERE "USER_ID" = _user_id;
END;
$function$