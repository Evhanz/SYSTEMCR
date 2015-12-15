<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('hello');
});
*/

Route::get('/',['as' => 'home','uses'=>'HomeController@index']);

//para el modulo de personas


Route::group(['before'=>'auth'],function(){


    Route::group(['before'=>'is_admin'],function(){
        //para el view select
        Route::get('personas/{id}',['as' => 'persona','uses'=>'PersonasController@viewPersona']);
        Route::get('personas',['as' => 'personas']);
        Route::post('person',['as' => 'person','uses' => 'PersonasController@selectPersona']);
        Route::get('person/{var}',['as'=>'personGet','uses'=>'PersonasController@getAllPersonByCriterioAndTipo']);
        //para el new persona
        Route::get('new-persona/{tipo}',['as' => 'frmNewPersona','uses' => 'PersonasController@frmNewPersona']);
        Route::post('new-persona',['as' => 'regPersona','uses' => 'PersonasController@regPersona']);
        Route::post('new-apoderado',['as' => 'regApoderado','uses' => 'PersonasController@regApoderado']);

        //para seleccionar persona y tipo
        Route::get('personas/{tipo}/{criterio}',['as'=>'getAllPersonasByTipoAndCriterio',
            'uses'=>'PersonasController@getPersonasByCriterioAndTipo']);

        //para editar a una persona
        Route::get('edit/{tipo}/{id}',['as'=> 'editAlumno','uses' => 'PersonasController@editAlumno']);
        Route::put('edit-alumno',['as'=> 'update_alumno','uses' => 'PersonasController@updatAlumno']);
        Route::post('edit-apoderado',['as'=> 'update_apoderado','uses' => 'PersonasController@updatApoderado']);
        Route::post('delet-alumno',['as'=> 'delete_alumno','uses' => 'PersonasController@deletAlumno']);



        //================= Aca inicia admin reuniones
        Route::get('reuniones/new-reunion',['as' => 'new-reunion','uses' => 'ReunionesController@frmNewReunion']);
        Route::post('reuniones/new-reunion',['as' => 'regReunion','uses' => 'ReunionesController@regReunion']);

        Route::get('reuniones/edit-reunion/{id}',['as' => 'edit-reunion','uses' => 'ReunionesController@frmEditReunion']);
        Route::put('reuniones/edit-reunion',['as' => 'editReunion','uses' => 'ReunionesController@editReunion']);

        Route::post('reuniones/del-reunion',['as' => 'delReunion','uses' => 'ReunionesController@delReunion']);

        //============= Aca se adminsitra usuario - Admin
        //para la edicion de usuario
        Route::get('account',['as'=> 'account','uses' => 'UsersController@account']);
        Route::put('account',['as'=> 'update_account','uses' => 'UsersController@updateAccount']);
        //para el registro de usuario
        Route::get('sign-up',['as' => 'sign_up','uses' => 'UsersController@signUp']);
        Route::post('sign-up',['as' => 'register','uses' => 'UsersController@register']);
        //para el index
        Route::get('viewUsuario',['as'=>'frmUsuarios','uses'=> 'UsersController@index']);
        Route::post('viewUsuario',['as'=>'getUsuarios','uses' => 'UsersController@getUsuarios']);

        //actualizar user for admin
        Route::get('editUsuario/{id}',['as'=> 'editUsuario','uses' => 'UsersController@editUsuario']);


        Route::post('deleteUser',['as'=> 'deleteUsuario','uses' => 'UsersController@deleteUsuario']);

    });


//=========== Aca empieza la ruta para las reuniones
    Route::get('reuniones',['as' => 'reuniones']);
    Route::get('reuniones/{criterio}/{fechaI}<>{fechaF}',['as'=> 'getReuniones','uses' => 'ReunionesController@getReunionesByCriterioAndFecha']);


//====================

//========= aca empieza las rutas para las asistencias
    Route::get('reuniones/reg-asistencia/{id}',['as' => 'regAsistencia','uses' => 'ReunionesController@frmRegAsistencia']);
    Route::post('reuniones/getApaoderado',['as'=>'getApoderado','uses'=>'ReunionesController@getApoderado']);
    Route::post('reuniones/new-asistencia',['as'=>'newAsistencia','uses'=>'ReunionesController@newAsistencia']);
    Route::get('reuniones/{id}/get-Asistentes',['as' => 'selectAsistencia','uses' => 'ReunionesController@selectAsistencia']);
    Route::post('reuniones/cierreReunion',['as' => 'cierreReunion','uses' => 'ReunionesController@cierreReunion']);


//==================================================


//=======aca empiza para ver deudas y multas

    Route::get('reuniones/verDeudas/{criterio}',['as'=>'viewPersonasByDeudas','uses'=>'MultasController@getPersonasbyMultas']);
    Route::get('reuniones/verDeudas/Apoerado/{id}',['as'=>'viewDeudasByPersonas','uses'=>'MultasController@viewDeudasByPersonas']);
    Route::post('reuniones/Deudas/pagar',['as'=>'payDeuda','uses'=>'MultasController@payDeuda']);



//=================================================


//====== estas son las rutas pra los helpers

    Route::post('helper/getDNI',['as'=>'getDniPersona','uses'=>'HelperController@getDniPersona']);
    Route::post('helper/ChangeEstado',['as'=>'changeEstado','uses'=>'HelperController@changeEstado']);


//==========================================







//=============== Para los reportes

    Route::get('reportes/pruebas',function(){


        $persona = \SysCR\Entities\Persona::find(3);
        $parameter = array();
        $parameter['persona'] = $persona;
        $pdf = PDF::loadView('reportes/reportes', $parameter);
        return $pdf->stream();
    });


    Route::get('reportes/pruebas/{id}',['as'=> 'pruebaReporte','uses' => 'ReportesController@index']);
    Route::get('reportes',['as'=>'frmReporte','uses' => 'ReportesController@frmReportes']);
    Route::post('reportes/deudas',['as'=>'getDeudasByGradoAndSeccion','uses' => 'ReportesController@getDeudasByGradoAndSeccion']);
    Route::get('reportes/{nivel}-{grado}-{seccion}',['as'=>'pdfReporte','uses' => 'ReportesController@pdfReporte']);

//========================================

});







//para hacer el login
Route::post('login',['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('logout',['as' => 'logout', 'uses' => 'AuthController@logout']);











//====================================para probar - pruebas unitarias


Route::get('prueba',['as'=>'routePrueba']);
Route::get('pruebaSelectAll/{var}',['as'=>'pruebaSelect','uses'=>'PersonasController@selectPersona']);


//Route::get('prueba/{id}',['as'=>'pruebaAsistencia','uses'=>'ReunionesController@pruebaselect']);



Route::get('prueba/verDeudas/{criterio}',['as'=>'pruebaverdeudas','uses'=>'MultasController@getPersonasbyMultas']);
//Route::get('prueba/verDeudas/{id}',['as'=>'pruebaDeudas','uses'=>'MultasController@index']);


//para probar excel
Route::get('prueba/excel',function(){




    Excel::create('Laravel Excel', function($excel) {

        $data = \SysCR\Entities\Persona::all();

        $excel->sheet('Excel sheet', function($sheet) use($data) {
            $sheet->fromArray($data);
            $sheet->setOrientation('landscape');
            $sheet->freezeFirstRow();

        });

    })->export('xls');
});