<?php

namespace App\Http\Controllers\TestsApi;

use App\Http\Controllers\Controller;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskManager_1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response(TaskModel::all());
    }

    /**
     * 
     */
    public function indexFilter($id)
    {
      return response(TaskModel::whereId($id)->first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $add = TaskModel::create($request->all());

      if($add)
        return $this->index();

      return response()->json(['error' => 'erro ao inserir nova tarefa']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $iten = TaskModel::whereId($id)->first();

      if (!$iten) 
        return response()->json(['error' => 'nenhum registro encontrado']);
      
      $request->title != '' || $request->title != null 
        ? DB::table('tasks')->whereId($id)->update(['title' => $request->title]) : '';

      $request->description != '' || $request->description != null 
        ? DB::table('tasks')->whereId($id)->update(['description' => $request->description]) : '';

      if($request->filled('status'))
        DB::table('tasks')->whereId($id)->update(['status' => $request->status]);
      
      return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $delete = DB::table('tasks')->whereId($id)->delete();

      if (!$delete) 
        return response()->json(['error' => "erro ao excluir iten $id"]);
      
      return $this->index();
    }
}
