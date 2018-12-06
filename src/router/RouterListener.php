<?php

namespace de\hannespries\router;

interface RouterListener{
	/**
	 * @return bool
	 * @param string $type
	 */
	public function checkType($type);
	
	/**
	 * @return ResolveResult
	 * @param array $data
	 * @param array $args
	 */
	public function call($data, $args = []);
}