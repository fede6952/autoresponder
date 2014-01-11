<?php

namespace mailinglist\subscription;

/**
 * subscription management
 * @author Mike Lopez <e@coderscult.com>
 */

/**
 * data structure for subscription class
 */
class subscription_structure {
	/**
	 *
	 * @var int subscription id
	 */
	var $id;
	/**
	 *
	 * @var int mailinglist id
	 */
	var $mailinglist_id;
	/**
	 *
	 * @var int person id
	 */
	var $person_id;
	/**
	 * @var string subscription status - pending|susbcribed|unsubscribed
	 */
	var $status = 'pending';
	/**
	 * @var string optin type - double|single
	 */
	var $optin = 'double';
	var $create_date;
	var $update_date;
}

/**
 * subscription class
 */
class subscription extends crud {
	var $table = 'subscription';
	var $structure = 'subscription_structure';
}

