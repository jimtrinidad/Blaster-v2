<?php

namespace Loki\Model;
use Loki\Core\Model;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

class User extends Model
{
	public $table = 'users';
	public $verify_pw;
	private $protected = array(
			'password'
		);

	function __construct($user = null)
	{
		parent::__construct($user);
	}

	public function validate()
	{	

		$userValidator = v::attribute('firstname', v::alpha()->length(1,100))
                  ->attribute('lastname', v::alpha()->length(1,100))
				  // ->attribute('lastname', v::optional(v::alpha()->length(1,100)))
                  ->attribute('email', v::email()->callback(array($this, 'uniqueEmail')))
                  ->attribute('username', v::alnum()->noWhitespace()->length(3,20)->callback(array($this, 'uniqueUsername')));

		if ($this->id === null) {
			$userValidator->attribute('password', v::stringType()->length(6,20)->equals($this->verify_pw));
		}

		try {
			$userValidator->assert($this->attributes);
			return true;
		} catch(ValidationException $e) {
			$e->findMessages(array(
						'email.callback' => '{{name}} already exists.',
						'username.callback' => '{{name}} already exists.',
						'equals' => '{{name}} does not match.'
					));
			return $e->getMyMessages();
		}
	}

	public function uniqueUsername()
	{	
		$this->db->table($this->table);
		if($this->attributes->id) {
			$res = $this->db->where('id','!=', $this->attributes->id);
		}
		$res = $this->db->where('username', $this->attributes->username)->getAll();

		if (count($res)) {
			return false;
		}
		return true;
	}

	public function uniqueEmail()
	{
		$this->db->table($this->table);
		if($this->attributes->id) {
			$res = $this->db->where('id','!=', $this->attributes->id);
		}
		$res = $this->db->where('email', $this->attributes->email)->getAll();

		if (count($res)) {
			return false;
		}
		return true;
	}

	public function getData($params = array())
	{
		$this->db->table($this->table);
		$users = $this->db->getAll();

		if (count($users)) {
			return $users;
		}

		return false;
	}

}
