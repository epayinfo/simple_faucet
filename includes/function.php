<?php
function convertToBTCFromSatoshi($value){
	return (float)bcdiv( ($value), 100000000, 8 );
}

$currencies = array(1=>'Satoshi (Bitcoin)',4=>'Dogecoin',5=>'Satoshi (Litecoin)',7=>'Satoshi (Dashcoin)',9=>'Satoshi (Peercoin)',10=>'Satoshi (Primecoin)');