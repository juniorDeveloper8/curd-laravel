<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //constar los datos

        $datos['empleado']=Empleado::paginate(5); //creamos una variable para almacenar los datos y luego listarlos
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosEmpleado = request() -> all();// esto camptura todos los datos 
        $datosEmpleado = request() -> except('_token'); //quita la llave

        //vamos a pasar la foto temporal a algo normal en la base
        if ($request -> hasFile('Foto')) {
            $datosEmpleado ['Foto']=$request->file('Foto')->store('uploads', 'public');//alteramos elcampo de la foto para inserlo
        }

        Empleado::insert($datosEmpleado);//esto inserta ya los datosen las tablas creadas 

        return redirect('empleado')->with('Enviar', 'Usuario creado exitosamente');


        //return response() -> json($datosEmpleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosEmpleado = request() -> except(['_token', '_method']);
        //vamos a pasar la foto temporal a algo normal en la base
        if ($request -> hasFile('Foto')) {
            $datosEmpleado ['Foto']=$request->file('Foto')->store('uploads', 'public');//alteramos elcampo de la foto para inserlo
        }
        
        Empleado::where('id', '=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);

       // return view('empleado.edit', compact('empleado'))->;
       return redirect('empleado')->with('Enviar', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Empleado::destroy($id);
        return redirect('empleado');
    }
}
