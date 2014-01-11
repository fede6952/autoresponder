<?php

namespace mailinglist\campaign;

/**
 * @author Mike Lopez <e@coderscult.com>
 */

/**
 * data structure for campaign class
 */
class campaign_structure {
	/**
	 *
	 * @var int campaign id
	 */
	var $id;
	/**
	 *
	 * @var int mailinglist id
	 */
	var $mailinglist_id;
	/**
	 *
	 * @var string campaign name
	 */
	var $name = '';
	/**
	 *
	 * @var string campaign type - broadcast|series
	 */
	var $type = 'broadcast';
	var $create_date;
	var $update_date;
}

/**
 * campaign class
 */
class campaign extends crud {
	var $table = 'campaign';
	var $structure = 'campaign_structure';
}

