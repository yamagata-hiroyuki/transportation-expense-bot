CREATE OR REPLACE FUNCTION transportation_expense_bot."GetRouteInfoByRouteNo"(_user_address VARCHAR, _route_no INT)
 RETURNS TABLE(
	"route_no"		INT,
	"route_date"	DATE,
	"destination"	VARCHAR,
	"route"			VARCHAR,
	"rounds"		BOOL,
	"price"			INT,
	"user_price"	INT,
	"remarks"		VARCHAR,
	"application"	BOOL,
	"docs_id"		INT
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
		,"docs_id"
	FROM transportation_expense_bot."ROUTE_INFO"
	WHERE "USER_ID" = _user_id AND "ROUTE_NO" = _route_no;
END;
$function$