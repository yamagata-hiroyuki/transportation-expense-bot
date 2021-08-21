CREATE OR REPLACE FUNCTION transportation_expense_bot."SetTempRouteInfo_ClearJorudanInfo"(_user_address VARCHAR)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN			-- Exec part
	-- Update
	PERFORM transportation_expense_bot."SetTempRouteInfo_RouteDate"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Destination"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Route"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Rounds"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Price"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_UserPrice"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_TransExp"(_user_address,NULL);
	PERFORM transportation_expense_bot."SetTempRouteInfo_Remarks"(_user_address,NULL);
END;
$function$