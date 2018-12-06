<?php 

namespace de\hannespries\router\listeners;

use de\hannespries\router\ResolveResult;
use de\hannespries\router\RouterListener;

class GenericFunctionListener implements RouterListener {

	public function checkType($type) {
		return strtolower($type) == 'function';
	}

	public function call($data, $args = array()) {
		$result = new ResolveResult();
		try{
			$func = $data['function'];			
			
			$content = call_user_func_array($func, $args);
			
			$result->setContent($content);
			$result->setType(get_class($content));
		}
		catch(\Exception $e){
			$result->setException($e);
		}
		return $result;
	}

}