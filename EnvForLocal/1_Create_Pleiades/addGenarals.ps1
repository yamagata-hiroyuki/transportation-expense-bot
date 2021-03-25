Param(
	$Arg1,
	$Arg2,
	$Arg3
)
$Name = $Arg1
$srcValue = $Arg2
$addValue = $Arg3
echo "Name=$Name"
echo "srcValue=$srcValue"
echo "addValue=$addValue"

if ( [string]::IsNullOrEmpty($srcValue) ) {
	echo "srcValue is empty"
	$newValue = "$addValue"
} else {
	echo "srcValue is not empty"
	$newValue = "$srcValue" + ";" + "$addValue"
}
echo "newValue=$newValue"
[Environment]::SetEnvironmentVariable("$Name", "$newValue", "User")