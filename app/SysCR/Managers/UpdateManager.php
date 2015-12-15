<?php namespace SysCR\Managers;

class UpdateManager extends BaseManager{

	public function getRules()
	{
		$rules= [
            'usuario' => 'required|unique:user,usuario,'.$this->entity->id,
            'email' => 'required|email|unique:user,email,'.$this->entity->id,
            'password' => 'confirmed',
            'password_confirmation' => '',
            'user_type' => 'required'
        ];

        return $rules;
	}



}