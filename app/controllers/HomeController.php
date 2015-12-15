<?php

use SysCR\Entities\Reunione;

class HomeController extends BaseController {

	public function index()
	{

        $reuniones = Reunione::where('estado','like','habil')->get();

		return View::make('home',compact('reuniones'));
	}

}
