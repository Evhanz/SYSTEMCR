<?php namespace SysCR\Managers;

class RegisterManager extends BaseManager{

	public function getRules()
	{
		$rules= [
            'usuario' => 'required|unique:user,usuario',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'user_type' => 'required'
        ];

        return $rules;
	}



}