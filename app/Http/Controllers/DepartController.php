<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isEmpty;

class DepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Select
    public function index()
    {
        $depart = DB::table('depart')->get();
        /* dd($departamentos); */
        return view('depart', [
            'departamentos' => $depart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /*  ddd(request()->input()); */
       //Cogemos los datos de la request de los input por sus name
       $denominacion = request()->input('denominacion');
       $localidad = request()->input('localidad');
       //Devuelve una colección y comprobamos con el first para obtener el primer elemento si no existe  devuelve null
       $departExistente = DB::table('depart')->where('localidad', $localidad)->where('denominacion', $denominacion)->get()->first();

        if ($departExistente != null) {
            return Redirect('/')->with('fault','Departamento no creado');
        } else {
            $validados = $this->validar();
            DB::table('depart')->insert([
             'denominacion' => $validados['denominacion'],
             'localidad' => $validados['localidad'],
             ]);
             return Redirect('/')->with('Success','Departamento creado');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /*  dd($id); */
       $depart = $this-> compruebaExistencia($id);
        return view('departedit',[
            'departamento' => $depart,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validados = $this -> validar();
        DB::table('depart') -> where('id', $id) ->update(["denominacion" => $validados['denominacion'], 'localidad' => $validados['localidad']]);
        return redirect("/") -> with("success", "Departamento actualizado con exito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depart = $this->compruebaExistencia($id);
        DB::table('depart')->where('id', $depart->id)->delete();
        return redirect("/")->with('success','Departamento borrado');
    }

    private function compruebaExistencia($id){
        $depart = DB::table('depart')
        ->where('id', $id) ->get();
        //Si no existe lanza un error
        abort_if($depart->isEmpty(), 404);
        //Si existe dame la primera fila
        return $depart->first();
    }
    //Request recoge los datos de la request y validamos esos datos
    private function validar()
    {
        $validados = request()->validate([
            'denominacion' => 'required|max:255',
            'localidad' => 'required|max:255',
        ]);

        return $validados;
    }
}
