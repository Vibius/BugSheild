<?php

namespace Vibius\BugShield;

class Shield{

	private $message;
	private $line;
	private $file;

	private $exceptionPool;

	public function deffend($message, $line, $file, $exceptionCode, $exception){
			ob_clean();

			$this->getView($message, $line, $file, $exceptionCode, $exception);
	}

	public function getView($message, $line, $file, $exceptionCode, $exception){
		require 'Views/header.php';
	}

}