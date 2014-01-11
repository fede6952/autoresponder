<?php

namespace mailinglist\subscription;

/**
 * @author Mike Lopez <e@coderscult.com>
 */

/**
 * data structure for person class
 */
class person_structure {
	/**
	 *
	 * @var int person id
	 */
	var $id;
	/**
	 *
	 * @var string email address
	 */
	var $email;
}

/**
 * person class
 */
class person extends crud {
	var $table = 'person';
	var $structure = 'person_structure';
}

