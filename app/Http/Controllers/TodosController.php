<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    //index para mostar todos los elementos todos
    /* store para guarda un todo
    update para actualizar un todo
    destroy para eliminar un todo
    edit para mostrar el formulario de edición
     */

    /* Request: solicitud de metodo http */
    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();
        /* Para guardar un element en la base de datos */
        return redirect()->route('todos')->with('success','Tarea creada correctamente');
        /* with para mandar un mensaje */
    }

    public function index(){
        $todos = Todo::all();
        /* All es un metodo estatico, en e cual se vahcaer un consulta */
        return view('todos.index', ['todos'=>$todos]);
    }

    public function show($id){
        $todo = Todo::find($id);
        /* All es un metodo estatico, en e cual se vahcaer un consulta */
        return view('todos.show', ['todo'=>$todo]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title; 
        $todo->save();
        /* dd($todo); */
        /* dd($request); */
        // dd es como un console log
        /* All es un metodo estatico, en e cual se vahcaer un consulta */
        /* return view('todos.index', ['success'=>"Tarea actualizada!"]); */
        return redirect()->route('todos')->with('success','Tarea actualizada');
    }
    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success','Tarea ha sido eliminada');
    }
}
