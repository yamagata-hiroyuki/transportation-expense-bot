CREATE OR REPLACE FUNCTION transportation_expense_bot."SetTempRouteInfo_JorudanInfo"(_user_address VARCHAR, _route VARCHAR, _route_date DATE, _price INT)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN			-- Exec part
	-- Update
	PERFORM transportation_expense_bot."SetTempRouteInfo_Route"(_user_address,_route);
	PERFORM transportation_expense_bot."SetTempRouteInfo_RouteDate"(_user_address,_route_date);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Price"(_user_address,_price);

END;
$function$