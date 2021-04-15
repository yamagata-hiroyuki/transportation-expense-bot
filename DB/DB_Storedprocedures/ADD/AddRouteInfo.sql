CREATE OR REPLACE FUNCTION transportation_expense_bot."AddRouteInfo"(_user_address VARCHAR)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE
	_max			INT;	-- Declare local variable
	_user_id		INT;
	_route_date		DATE;
	_destination	VARCHAR;
	_route			VARCHAR;
	_rounds			BOOL;
	_price			INT;
	_user_price		BOOL;
	_remarks		VARCHAR;
	_application	BOOL;
	_docs_id		INT;
BEGIN			-- Exec part
	-- get USER_ID
	SELECT INTO _user_id transportation_expense_bot."GetUserId"(_user_address); 

	-- get max ROUTE_NO
	SELECT INTO _max
	CASE
		WHEN MAX("ROUTE_NO") IS NULL THEN 1
		ELSE MAX("ROUTE_NO") + 1
	END
	FROM transportation_expense_bot."ROUTE_INFO"
	WHERE "USER_ID" = _user_id;

	-- get other infos
	SELECT
		"route_date",
		"destination",
		"route",
		"rounds",
		"price",
		"user_price",
		"remarks"
	INTO
		_route_date,
		_destination,
		_route,
		_rounds,
		_price,
		_user_price,
		_remarks
	FROM transportation_expense_bot."GetTempRouteInfo"(_user_address);
	_application = FALSE;
	_docs_id = NULL;
	
	-- Register new ROUTE_INFO
	INSERT INTO transportation_expense_bot."ROUTE_INFO"(
		"USER_ID"
		,"ROUTE_NO"
		,"ROUTE_DATE"
		,"DESTINATION"
		,"ROUTE"
		,"ROUNDS"
		,"PRICE"
		,"USER_PRICE"
		,"REMARKS"
		,"APPLICATION"
		,"DOCS_ID"
	)
	VALUES (
	_user_id,
	_max,
	_route_date,
	_destination,
	_route,
	_rounds,
	_price,
	_user_price,
	_remarks,
	_application,
	_docs_id
	);

	-- Clear TEMP_ROUTE_INFO
	PERFORM transportation_expense_bot."SetTempRouteInfo_ClearJorudanInfo"(_user_address);
END;
$function$