<?php

namespace mailinglist;

/**
 * @author Mike Lopez <e@coderscult.com>
 */

/**
 * data structure for mailing list class
 */
class mailinglist_structure {
	/**
	 * 
	 * @var int mailinglist id
	 */
	var $id;
	/**
	 *
	 * @var string mailing list name
	 */
	var $name;
	/**
	 *
	 * @var string mailing list description
	 */
	var $description;
	var $create_date;
	var $update_date;
}

/**
 * mailinglist class
 */
class mailinglist extends crud {
	var $table = 'mailinglist';
	var $structure = 'mailinglist_structure';
}

