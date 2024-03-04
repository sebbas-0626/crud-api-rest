<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tareas = Tarea::with([
        //     'users' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        // ])->paginate(10);

        $tareas = Tarea::with('users')->paginate(10);
        return $tareas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tarea = Tarea::create($request->all());
            return response()->json([
                'status' => 'OK',
                'message' => 'tarea creada',
                'data' => $tarea
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'error',
                'data' => null,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Tarea $tarea)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        try {
            $tarea = Tarea::find($id);
            $tarea->update($request->all());

            return response()->json([
                'status' => 'OK',
                'message' => 'Tarea actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Error al actualizar la tarea',
                'error' => $e->getMessage()
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Tarea $tarea)
    // {
    //     //
    // }
    public function destroy($id)
    {
        try {
            $tarea = Tarea::find($id);

            $tarea->delete();

            return response()->json([
                'status' => 'OK',
                'message' => 'Tarea eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Error al eliminar la tarea',
                'error' => $e->getMessage()
            ]);
        }
    }
}
