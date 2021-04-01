CREATE OR REPLACE FUNCTION transportation_expense_bot."SetServerToken"(_token VARCHAR, _startfrom VARCHAR, _endat VARCHAR)
 RETURNS void
 LANGUAGE plpgsql
AS $function$
DECLARE _existFlag BOOLEAN;
BEGIN			-- Exec part
	-- SERVER_TOKEN exist check
	SELECT INTO _existFlag EXISTS(SELECT * FROM transportation_expense_bot."SERVER_TOKEN_INFO");
	IF _existFlag
	THEN
		-- SERVER_TOKEN already exists.Do update.
		UPDATE transportation_expense_bot."SERVER_TOKEN_INFO"
		SET "ID" = 1	-- Fix.Because of not use.
			,"TOKEN" = _token
			,"START_FROM" = CAST(_startFrom AS TIMESTAMP WITH TIME ZONE)
			,"END_AT" = CAST(_endAt AS TIMESTAMP WITH TIME ZONE)
		WHERE "ID" = 1;
	ELSE
		-- SERVER_TOKEN not exists.Do insert.
		INSERT INTO transportation_expense_bot."SERVER_TOKEN_INFO"(
			"ID"
			,"TOKEN"
			,"START_FROM"
			,"END_AT"
		)
		SELECT
			1
			,_token
			,CAST(_startFrom AS TIMESTAMP WITH TIME ZONE)
			,CAST(_endAt AS TIMESTAMP WITH TIME ZONE
		);
	END IF;
END;
$function$