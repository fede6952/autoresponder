<?php

namespace mailinglist\campaign;

/**
 * @author Mike Lopez <e@coderscult.com>
 */

/**
 * data structure for message class
 */
class message_structure {
	/**
	 *
	 * @var int message id
	 */
	var $id;
	/**
	 *
	 * @var int campaign id
	 */
	var $campaign_id;
	/**
	 *
	 * @var string email subject
	 */
	var $subject;
	/**
	 *
	 * @var string email body
	 */
	var $body;
	/**
	 *
	 * @var string message type - confirmation|broadcast|series
	 */
	var $message_type;
	/**
	 *
	 * @var int schedule specified either as days after previous message or unix timestamp
	 */
	var $schedule;
	var $create_date;
	var $update_date;
}

/**
 * message class
 */
class message extends crud {
	var $table = 'message';
	var $structure = 'message_structure';
}

