CREATE OR REPLACE FUNCTION transportation_expense_bot."GetServerToken"()
 RETURNS TABLE("token" VARCHAR, "startFrom" TIMESTAMP WITH TIME ZONE, "endAt" TIMESTAMP WITH TIME ZONE)
 LANGUAGE plpgsql
AS $function$
BEGIN			--実行部
	RETURN QUERY
	SELECT "TOKEN","START_FROM","END_AT"
	FROM transportation_expense_bot."SERVER_TOKEN_INFO"
	WHERE "ID"=1;
END;
$function$