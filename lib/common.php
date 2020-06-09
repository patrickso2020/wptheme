<?php
function _send_mail($mailto, $from, $subject, $mailcontent, $headers = '') {
	if (!$headers) {
		$headers = "From: $from \nReply-To: $from \nReturn-Path: $from \nX-Mailer: PHP\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
	}
	
	if (!is_array($mailto)) {
		$mailto = array($mailto);
	}
	foreach ($mailto as $m) {
		@mail($m, $subject, $mailcontent, $headers);
	}
}

function gpc($field) {
	return get_magic_quotes_gpc($field) ? $field : addslashes($field);
}
function reverse_gpc($field) {
	return get_magic_quotes_gpc($field) ? stripslashes($field) : $field;
}

?>