<?php
/**
 *  Maybe one day you well want to switch to 'local' database
 *  If you dont need this delete this file/directory and classmap from composer.json
 *  Eloquent is default Laravel ORM
 */

namespace Entities;

class InpostApiEntity extends \Eloquent {

	public function print_hello() {
		return function() {
			echo 'this is extended feature! its pretty awesome :)';
		};
	}

}