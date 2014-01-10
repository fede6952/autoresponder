<?php

class message_structure {
	var $id;
	var $campaign_id;
	var $subject;
	var $body;
	var $schedule;
	var $create_date;
	var $update_date;
}

class message extends crud {
	var $table = 'message';
	var $structure = 'message_structure';
}

