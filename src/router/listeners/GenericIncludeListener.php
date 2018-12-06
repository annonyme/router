<?php
namespace de\hannespries\router\listeners;

use de\hannespries\router\ResolveResult;
use de\hannespries\router\RouterListener;

class GenericIncludeListener implements RouterListener {

	public function checkType($type) {
		return strtolower($type) == 'include';
	}

	public function call($data, $args = array()) {
		$result = new ResolveResult();
		try{
			$path = isset($data['path']) ? $data['path'] : '';
			if(!preg_match('/\/$/', $path) && strlen($path) > 0){
				$path .= '/';
			}
			$filename = array_shift($args);
			
			$ext = '';
			if(isset($data['extension'])){
				$ext = $data['extension'];
				if(strlen($ext) > 1 && substr($ext, 0, 1) != '.'){
					$ext = '.'.$ext;
				}
			}
			
			include_once $path.$filename.$ext;
			
			$result->setContent(['success' => true]);
		}
		catch(\Exception $e){
			$result->setContent(['success' => false]);
		}
		return $result;
	}
}