<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 22/03/15
 * Time: 23:07
 */

namespace SysCR\Repositories;
use SysCR\Entities\Persona;



class PersonaRepo {

    public function find($id){
        return Persona::find($id);
    }


    public function getAllPersonas(){

        //aca es como si trajera a todos pero con paginacion de 3
        return Persona::paginate(3);
    }


    //esta funcion trae a la tabla por ajax
    public function getAllPersonByCriterioAndTipo($criterio,$tipo){


        if(!empty($criterio)){
            $criterio ='%'.$criterio.'%';
            $personas = Persona::whereNull('apoderado_id')->where('estado','=','1')
                ->where('tipo','like','Alumno')->where(function ($query) use ($criterio){
                $query->where('nombre', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(3);

        }
        else{
        $personas = Persona::whereNull('apoderado_id')->where('tipo','like','Alumno')
            ->where('estado','=','1')->paginate(3);}

        return $personas;
    }



    //este es el que usamos en el select full
    public function getPersonasByCriterioAndTipo($criterio,$tipo){

        if($criterio==='*'){
           $personas = Persona::where('tipo','like',$tipo)->paginate(10);

        }
        else{
            $criterio ='%'.$criterio.'%';
            $personas = Persona::where('tipo','like',$tipo)->where(function ($query) use ($criterio){
                $query->where('nombre', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(10);

        }

        return $personas;
    }
    public function regPersona($data){

        if($data['foto']!= null){
            $foto = $data['foto']->getClientOriginalName();
            $file = $data['foto'];
        }

        $rules=[

            'nombre' => 'required',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required',
            'direccion' => 'required|min:4',
            'correo' => 'required|unique:personas',
            'telefono' => 'required',
            'celular' => 'min:7',
            'nivel' => 'required',
            'grado' => 'required',
            'seccion' => 'required',
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $persona = new Persona($data);
            $persona->estado = true;


            //Persona::create($data);


            if( $persona->save()){
                if(isset($file)){
                //guardamos la imagen en public/imgs con el nombre original
                $file->move("imagenes/profiles",$persona->id.$foto);
                //redirigimos con un mensaje flash
                $persona->foto = $persona->id.$foto;
                $persona->save();
                }
            }
            return 1;
        }else
        {
            return $validation->messages();
        }


    }

    public function updatAlumno($data){

        $id = $data['id'];


        if($data['foto']!= null){
            $foto = $data['foto']->getClientOriginalName();
        }
        $file = $data['foto'];
        $rules=[
            'nombre' => 'required',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required',
            'direccion' => 'required|min:4',
            'correo' => 'required|unique:personas,correo,'.$id,
            'telefono' => 'required',
            'celular' => 'min:7',
            'foto' => '',
            'nivel' => 'required',
            'grado' => 'required',
            'seccion' => 'required',
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $persona = Persona::find($id);
            $persona->estado = true;
            $persona->nombre = $data['nombre'];
            $persona->apellidoP = $data['apellidoP'];
            $persona->apellidoM = $data['apellidoM'];
            $persona->dni = $data['dni'];
            $persona->direccion = $data['direccion'];
            $persona->correo = $data['correo'];
            $persona->telefono = $data['telefono'];
            $persona->celular = $data['celular'];
            $persona->nivel = $data['nivel'];
            $persona->grado = $data['grado'];
            $persona->seccion = $data['seccion'];
            $persona->save();



            if($file != null){
                //guardamos la imagen en public/imgs con el nombre original
                $file->move("imagenes/profiles",$persona->id.$foto);
                //redirigimos con un mensaje flash
                $persona->foto = $persona->id.$foto;
                $persona->save();
            }
            return 1;
        }else
        {
            return $validation->messages();
        }


    }

    public function regApoderado($data){

        $persona = new Persona();
        $persona->estado = true;
        $persona->nombre = $data['nombre'];
        $persona->apellidoP = $data['apellidoP'];
        $persona->apellidoM = $data['apellidoM'];
        $persona->dni = $data['dni'];
        $persona->direccion = $data['direccion'];
        $persona->correo = $data['correo'];
        $persona->telefono = $data['telefono'];
        $persona->celular = $data['celular'];
        $persona->tipo = 'Apoderado';


        if($persona->save()){
            if($data['foto']!= 'undefined'){

                $file = $data['foto'];
                $foto = $data['foto']->getClientOriginalName();

                $file->move("imagenes/profiles",$persona->id.$foto);
                //redirigimos con un mensaje flash

                $persona->foto = $persona->id.$foto;
                $persona->save();
            }
            return $persona->id;
        }else
            return 'Error: no se a podido registrar Apoderado';


    }

    public function updateApoderadoAlumno($alumnos,$apoderado){

        foreach($alumnos as $alumno){
            $alum  =  Persona::find($alumno);
            $alum->apoderado_id = $apoderado;
            $alum->save();
        }

        return 1;

    }

    public function getPersonasByApoderados($id){

        $personas = Persona::where('apoderado_id','=',$id)->get();

        return $personas;

    }


    public function updatApoderado($data){


        $id = $data['id'];

        $persona = Persona::find($id);
        $persona->estado = true;
        $persona->nombre = $data['nombre'];
        $persona->apellidoP = $data['apellidoP'];
        $persona->apellidoM = $data['apellidoM'];
        $persona->dni = $data['dni'];
        $persona->direccion = $data['direccion'];
        $persona->correo = $data['correo'];
        $persona->telefono = $data['telefono'];
        $persona->celular = $data['celular'];
        $persona->tipo = 'Apoderado';


        if($persona->save()){
            if($data['foto']!= 'undefined'){

                $file = $data['foto'];
                $foto = $data['foto']->getClientOriginalName();

                $file->move("imagenes/profiles",$persona->id.$foto);
                //redirigimos con un mensaje flash

                $persona->foto = $persona->id.$foto;
                $persona->save();
            }
            return $persona->id;
        }else
            return 'Error: no se a podido registrar Apoderado';


    }

    public function deleteApoderadoAlumno($id){

        Persona::where('apoderado_id', '=', $id)->update(array('apoderado_id' => null));

    }


} 