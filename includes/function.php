<?php
function convertToBTCFromSatoshi($value){
	return (float)bcdiv( ($value), 100000000, 8 );
}

function currency($currency){
	switch ($currency){
		case 1: return 'Satoshi (Bitcoin)'; break;
		case 4: return 'Dogecoin'; break;
		case 5: return 'Satoshi (Litecoin)'; break;
		case 7: return 'Satoshi (Dashcoin)'; break;	
		case 9: return 'Satoshi (Peercoin)'; break;	
		case 10: return 'Satoshi (Primecoin)'; break;	
	}								
}
?>