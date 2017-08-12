<?php 


interface Subject {
	public function attach($obserable);
	public function detach($index);
	public function notify();
}

interface Observer{
	public function handle();
}

class Login implements Subject {
	
	protected $observers = [];

	public function attach($obserable) {
		if(is_array($obserable)) {
			foreach ($obserable as $observer) {
				if(!$observer instanceof Observer)
					throw new Exception;

				$this->attach($observer);
			}
			return;
		}

		$this->observers[] = $obserable;
		return $this;
	}	

	public function detach($index) {
		unset($this->observers[$index]);
	}

	public function notify() {
		foreach ($this->observers as $observer) {
			$observer->handle();
		}
	}

	public function fire() {
		$this->notify();
	}
}

class LogHandler implements Observer {
	public function handle() {
		var_dump('Log someting important.');
	}
}

class EmailNotifier implements Observer {
	public function handle() {
		var_dump('Email to the admin.');
	}
}

class LoginReporter implements Observer {
	public function handle() {
		var_dump('do some form  of reporting.');
	}
}

$login = new Login;

$login->attach([
	new LogHandler,
	new EmailNotifier,
	new LoginReporter
]);

$login->fire();