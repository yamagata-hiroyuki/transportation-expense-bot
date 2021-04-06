CREATE OR REPLACE FUNCTION transportation_expense_bot."GetTempRouteInfo"(_user_address VARCHAR)
 RETURNS TABLE(
	route_date	DATE,
	destination	VARCHAR,
	route		VARCHAR,
	rounds		INT,
	price		INT,
	user_price	INT,
	remarks		VARCHAR
)
 LANGUAGE plpgsql
AS $function$
DECLARE
	_route_date		DATE;		-- Declare localÅ@variable
	_destination	VARCHAR;
	_route			VARCHAR;
	_rounds			INT;
	_price			INT;
	_user_price		INT;
	_remarks		VARCHAR;
BEGIN					-- Exec part
	-- create tmp table
	CREATE TEMP TABLE _tmpTable(
		_dummyPKey		INT DEFAULT 1 NOT NULL ,
		_route_date		DATE,
		_destination	VARCHAR,
		_route			VARCHAR,
		_rounds			INT,
		_price			INT,
		_user_price		INT,
		_remarks		VARCHAR,
		PRIMARY KEY ("_dummyPKey")
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
	SELECT "_route_date","_destination","_route","_rounds","_price","_user_price","_remarks"
	FROM _tmpTable
	WHERE "_dummyPKey" = 1;
END;
$function$