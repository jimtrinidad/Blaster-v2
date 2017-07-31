<?php

namespace Loki\Module\Users;
use Loki\Core\Controller;
use Loki\Model\User as MUser;

class User extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function getIndex($id = null)
	{

		if ($id === null) {
			$model = new MUser();
			$users = $model->getData();	
			if ($users) {
				return array(
							'status'	=> true,
							'data'		=> $users
						);
			} else {
				return array(
							'status'	=> false,
							'message'	=> 'No record found.'
						);
			}
		} else {
			$user = new MUser($id);
			if ($user->exists) {
				return array(
						'status'	=> true,
						'data'		=> $user->attributes
					);
			} else {
				return array(
						'status'	=> false,
						'message'	=> 'User not found.'
					);
			}
		}
		

	}

	//new record
	public function putIndex()
	{
		$user = new MUser();

		$user->assign($this->app->request->params);
		$user->verify_pw = $this->app->request->param('password2');
		$validation = $user->validate();

		if ($validation === true) {
			if ($user->save()) {
				return array(
					'status'	=> true,
					'message'	=> 'New record has been added'
				);
			} else {
				return array(
					'status'	=> false,
					'message'	=> 'Saving record failed.'
				);
			}
		} else {
			return array(
					'status'	=> false,
					'message'	=> 'Validation error found.',
					'data'		=> $validation
				);
		}
	}

	//update record
	public function postIndex($id = null)
	{
		if ($id) {
			$user = new MUser($id);
			if ($user->exists) {
				$user->assign($this->app->request->params);
				$validation = $user->validate();

				if ($validation === true) {
					if ($user->save()) {
						return array(
							'status'	=> true,
							'message'	=> $user->firstname . ' ' . $user->lastname . ' record has been updated'
						);
					} else {
						return array(
							'status'	=> false,
							'message'	=> 'No changes made.'
						);
					}
				} else {
					return array(
							'status'	=> false,
							'message'	=> 'Validation error found.',
							'data'		=> $validation
						);
				}
			} else {
				return array(
						'status'	=> false,
						'message'	=> 'User not found.'
					);
			}
		} else {
			return array(
					'status'	=> false,
					'message'	=> 'User id required.'
				);
		}
	}

	//delete record
	public function deleteIndex($id = null)
	{
		if ($id) {
			$user = new MUser($id);
			if ($user->exists) {
				if ($user->delete()) {
					$return = array(
							'status'	=> true,
							'message'	=> 'User ' . $user->firstname . ' ' . $user->lastname . ' has been deleted.'
						);
					$user->reset();
				}
			} else {
				return array(
						'status'	=> false,
						'message'	=> 'User not found.'
					);
			}
		} else {
			return array(
					'status'	=> false,
					'message'	=> 'User id required.'
				);
		}
	}
}