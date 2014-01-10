<?php

/**
 * Class campaign
 * @author Mike Lopez <e@coderscult.com>
 */

class campaign_structure {
	var $id;
	var $mailinglist_id;
	var $name = '';
	var $type = 'broadcast'; // broadcast or series
	var $create_date;
	var $update_date;
}

class campaign extends crud {
	var $table = 'campaign';
	var $structure = 'campaign_structure';
}

