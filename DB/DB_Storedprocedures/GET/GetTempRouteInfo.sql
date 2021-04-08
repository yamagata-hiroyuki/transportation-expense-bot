CREATE OR REPLACE FUNCTION transportation_expense_bot."GetTempRouteInfo"(_user_address VARCHAR)
 RETURNS TABLE(
	"route_date"	DATE,
	"destination"	VARCHAR,
	"route"		VARCHAR,
	"rounds"		BOOL,
	"price"		INT,
	"user_price"	BOOL,
	"remarks"		VARCHAR
)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_route_date		DATE;		-- Declare localÅ@variable
	_destination	VARCHAR;
	_route			VARCHAR;
	_rounds			BOOL;
	_price			INT;
	_user_price		BOOL;
	_remarks		VARCHAR;
BEGIN					-- Exec part
	-- create tmp table
	CREATE TEMP TABLE _tmpTable(
		"_tmpTable_dummyPKey"		INT DEFAULT 1 NOT NULL,
		"_tmpTable_route_date"		DATE,
		"_tmpTable_destination"		VARCHAR,
		"_tmpTable_route"			VARCHAR,
		"_tmpTable_rounds"			BOOL,
		"_tmpTable_price"			INT,
		"_tmpTable_user_price"		BOOL,
		"_tmpTable_remarks"			VARCHAR,
		PRIMARY KEY ("_tmpTable_dummyPKey")
	);

	-- get Infos
	SELECT INTO _route_date		transportation_expense_bot."GetTempRouteInfo_RouteDate"(_user_address);
	SELECT INTO _destination	transportation_expense_bot."GetTempRouteInfo_Destination"(_user_address);
	SELECT INTO _route			transportation_expense_bot."GetTempRouteInfo_Route"(_user_address);
	SELECT INTO _rounds			transportation_expense_bot."GetTempRouteInfo_Rounds"(_user_address);
	SELECT INTO _price			transportation_expense_bot."GetTempRouteInfo_Price"(_user_address);
	SELECT INTO _user_price		transportation_expense_bot."GetTempRouteInfo_UserPrice"(_user_address);
	SELECT INTO _remarks		transportation_expense_bot."GetTempRouteInfo_Remarks"(_user_address);

	-- Insert Infos into table
	INSERT INTO _tmpTable
	VALUES(
		1,
		_route_date,
		_destination,
		_route,
		_rounds,
		_price,
		_user_price,
		_remarks
	);

	RETURN QUERY
	SELECT
		"_tmpTable_route_date",
		"_tmpTable_destination",
		"_tmpTable_route",
		"_tmpTable_rounds",
		"_tmpTable_price",
		"_tmpTable_user_price",
		"_tmpTable_remarks"
	FROM _tmpTable
	WHERE "_tmpTable_dummyPKey" = 1;
END;
$function$