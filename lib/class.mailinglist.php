<?php

/**
 * Class mailinglist
 * @author Mike Lopez <e@coderscult.com>
 */

class mailinglist_structure {
	var $id;
	var $name;
	var $description;
	var $create_date;
	var $update_date;
}

class mailinglist extends crud {
	var $table = 'mailinglist';
	var $structure = 'mailinglist_structure';
}

