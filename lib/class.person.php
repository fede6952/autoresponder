<?php

/**
 * Class person
 * @author Mike Lopez <e@coderscult.com>
 */

class person_structure {
	var $id;
	var $firstname;
	var $lastname;
	var $email;
}

class person extends crud {
	var $table = 'person';
	var $structure = 'person_structure';
}

