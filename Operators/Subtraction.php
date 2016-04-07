<?php

namespace Calculator\Operator;

use AbstractOperator;

class Subtraction extends AbstractOperator {
	
	protected $token = '-';

	/**
	 * {@inheritdoc }
	 */
	public function process($base, $subject) {
		return $base - $subject;
	}

}
