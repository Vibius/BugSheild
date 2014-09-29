<?php

namespace Vibius\BugShield;

class Shield{

	private $message;
	private $line;
	private $file;

	private $exceptionPool;

	public function deffend($message, $line, $file, $exceptionCode, $exception, $trace){
			ob_clean();

			$this->getView($message, $line, $file, $exceptionCode, $exception, $trace);
	}

	public function getView($message, $line, $file, $exceptionCode, $exception, $trace){
		require 'Views/header.php';
	}

}