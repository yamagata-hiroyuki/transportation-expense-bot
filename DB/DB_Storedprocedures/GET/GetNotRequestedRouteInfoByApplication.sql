CREATE OR REPLACE FUNCTION transportation_expense_bot."GetNotRequestedRouteInfoByApplication"(_user_address VARCHAR)
 RETURNS TABLE(
	"route_no"		INT,
	"route_date"	DATE,
	"destination"	VARCHAR,
	"route"			VARCHAR,
	"rounds"		BOOL,
	"price"			INT,
	"user_price"	INT,
	"trans_exp"		INT,
	"remarks"		VARCHAR,
	"application"	BOOL,
	"docs_id"		INT
)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_user_id	INT;		-- Declare local?@variable
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
		,"TRANS_EXP"
		,"REMARKS"
		,"APPLICATION"
		,"DOCS_ID"
	FROM transportation_expense_bot."ROUTE_INFO"
	WHERE "USER_ID" = _user_id AND "APPLICATION" = FALSE;
END;
$function$