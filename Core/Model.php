<?php

namespace Loki\Core;
use Buki;


/**
* add a simple activerecord handler
*/
class Model
{
	
	protected $app;
	protected $db;

	protected $hard_delete = false;

	public $table;
	public $id;
	public $attributes;
	public $exists;

	function __construct($model = null)
	{
		global $app;
		$this->app = $app;

		$db_config = $this->app->loader->config('db')['mysql'];

		$config = [
			'host'		=> $db_config['host'],
			'driver'	=> 'mysql',
			'database'	=> $db_config['dbname'],
			'username'	=> $db_config['user'],
			'password'	=> $db_config['pass'],
			'charset'	=> 'utf8',
			'collation'	=> 'utf8_general_ci',
			'prefix'	 => ''
		];

		$this->db = new Buki\Pdox($config);

		if ($this->table) {

			//set attributes
			$this->attributes = new \stdClass();
			$q = $this->db->pdo->prepare("DESCRIBE " . $this->table);
			$q->execute();
			foreach ($q->fetchAll(\PDO::FETCH_COLUMN) as $field) {
				$this->attributes->{$field} = null;
			}


			if ($model !== null) {
				if ($model instanceof Model) {
					$this->id 			= $model->id;
					$this->attributes 	= $model->attributes;
					$this->exists 		= true;
				} else {
					$response = $this->db->table($this->table)->where('id', $model)->get();
					if (count($response)) {
						$this->attributes = $response;
						$this->id = $response->id;
						$this->exists = true;
					}
				}
			}

			$this->setAttributes();

		}

	}

	private function setAttributes()
	{
		if ($this->attributes) {
			foreach ((array)$this->attributes as $k => $v) {
				$this->{$k} = $v;
			}
		}
	}

	public function save()
	{

		// update record
		if ($this->id !== null) {
			return $this->db->table($this->table)->where('id', $this->id)->update((array)$this->attributes);
		} 
		// new record
		else {
			return $this->db->table($this->table)->insert((array)$this->attributes);
		}
	}

	public function delete()
	{
		if ($this->id !== null) {

			if ($this->hard_delete) {
				return $this->db->table($this->table)->where('id', $this->id)->delete();
			} else {
				return $this->db->table($this->table)->where('id', $this->id)->update(array(
						'date_deleted' => date('Y-m-d H:i:s')
					));
			}
		}

		return false;
	}

	public function assign($data)
	{
		foreach ($this->attributes as $k => $v) {
			if (isset($data[$k])) {
				$this->attributes->{$k} = $data[$k];
			}
		}
	}

	public function reset()
	{
		$this->exists = null;
		$this->id = null;

		foreach ((array)$this->attributes as $k => $v) {
			$this->{$k} = null;
		}

		$this->attributes = new \stdClass;
	}

}