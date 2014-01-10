<?php

/**
 * Class subscriber
 * @author Mike Lopez <e@coderscult.com>
 */

class susbcriber_structure {
	var $id;
	var $mailinglist_id;
	var $person_id;
	var $status = 'pending'; // pending, susbcribed, unsubscribed
	var $create_date;
	var $update_date;
}

class susbcriber extends crud {
	var $table = 'susbcriber';
	var $structure = 'susbcriber_structure';
}

