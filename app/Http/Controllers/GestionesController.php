<?php

namespace App\Http\Controllers;

use App\Models\gestiones;
use App\Models\Visita;
use App\Models\Edificio;
use App\Mail\NuevaGestionMail;
use App\Mail\PagoGestionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class GestionesController extends Controller
{
    public function index()
    {
        $gestiones = Gestiones::orderBy('created_at', 'desc')->get();
        return view('gestiones.index', compact('gestiones'));
    }

    public function pendientes()
    {
        $gestiones = Gestiones::where('estado','en_proceso')
            ->orderBy('created_at', 'desc')->get();
            //dd($gestiones);
        return view('gestiones.pendientes', compact('gestiones'));
    }

    public function resueltas()
    {
        $gestiones = Gestiones::where('estado','finalizada')
            ->orderBy('created_at', 'desc')->get();
            //dd($gestiones);
        return view('gestiones.resueltas', compact('gestiones'));
    }

    public function create()
    {
        $edificios = Edificio::orderBy('nombre')->get();
        return view('gestiones.create', compact('edificios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'edificio_id'        => 'required|exists:edificios,id',
            'departamento'      => 'required',
            'titulo'            => 'required',
            'descripcion'       => 'required',
            'nombre_contacto'   => 'required',
            'telefono_contacto' => 'required',
            'email_contacto'    => 'required|email'
        ]);

        $gestion = new gestiones();
        $gestion->edificio_id       = $request->edificio_id;
        $gestion->departamento = $request->departamento;
        $gestion->titulo = $request->titulo;
        $gestion->descripcion = $request->descripcion;
        $gestion->nombre_contacto = $request->nombre_contacto;
        $gestion->telefono_contacto = $request->telefono_contacto;
        $gestion->email_contacto = $request->email_contacto;
        $gestion->estado = 'pendiente'; // opcional si tienes este campo
        $gestion->save();

        //enviar correo
        //Mail::to('gestionedificios@serviciosglobalesrv.cl')->send(new NuevaGestionMail($gestion));
        Mail::send('emails.nueva_gestion', ['gestion' => $gestion], function($message){
            $message->to('gestionedificios@serviciosglobalesrv.cl')->subject('Nueva Solicitud');
        });


        return redirect()->route('gestiones.index')
            ->with('success', 'Solicitud registrada correctamente.');
    }

    public function nueva($edificio)
    {
        $edificio = Edificio::findOrFail($edificio);
        //dd($edificio);
        return view('gestiones.nueva', compact('edificio'));
    }




    public function nuevastore(Request $request)
    {
        $request->validate([
            'edificio_id'           => 'required|exists:edificios,id',
            'departamento'          => 'required|string|max:100',
            'titulo'                => 'required|string',
            'nombre_contacto'       => 'required|string|max:100',
            'telefono_contacto'     => 'required|string|max:15',
            'email_contacto'        => 'required|email',
            'descripcion'           => 'required|string',
            'fecha_visita_estimada' => 'required|date|after:today',
            'hora_visita_estimada'  => 'required'
        ]);

        $gestion = new gestiones();

        $gestion->edificio_id = $request->edificio_id;
        $gestion->departamento = $request->departamento;
        $gestion->titulo = $request->titulo;
        $gestion->nombre_contacto = $request->nombre_contacto;
        $gestion->telefono_contacto = $request->telefono_contacto;
        $gestion->email_contacto = $request->email_contacto;
        $gestion->descripcion = $request->descripcion;
        $gestion->fecha_visita_estimada = $request->fecha_visita_estimada;
        $gestion->hora_visita_estimada = $request->hora_visita_estimada;
        $gestion->estado = 'pendiente';

        $gestion->save();

        // Enviar correo
        Mail::send(
            'emails.nueva_gestion',
            ['gestion' => $gestion],
            function ($message) {
                $message->to('gestionedificios@serviciosglobalesrv.cl')
                        ->subject('Nueva Solicitud de Mantención');
            }
        );

        /* 💳 2. Correo de pago al inquilino */
        Mail::to($gestion->email_contacto)->send(new PagoGestionMail($gestion));

        return redirect()
            ->route('gestiones.nueva', $request->edificio_id)
            ->with('success', 'Solicitud registrada correctamente. Revise su correo.');
    }


    public function agendarvisita($id)
    {
        $gestion = Gestion::findOrFail($id);
        return view('gestiones.agendarvisita', compact('gestion'));
    }

    public function storevisita(Request $request, $id)
    {
        $gestion = Gestion::findOrFail($id);
        $gestion->fecha_visita = $request->fecha_visita;
        $gestion->hora_visita = $request->hora_visita;
        $gestion->save();

        return redirect()->route('gestiones.index')
            ->with('success','Visita agendada correctamente.');
    }

    public function show(gestiones $gestiones)
    {
        //
    }

    public function edit(gestiones $gestione)
    {
        //$servicio=gestiones::findOrFail($gestione);
        //return view('servicios.edit',['servicio'=>$servicio]);
        //dd($gestione);
        return view('gestiones.edit', compact('gestione'));
    }

    public function update(Request $request, Gestiones $gestione)
    {
        $gestione->update($request->only('estado'));

        return redirect()->route('gestiones.index')
            ->with('success','Actualizado.');
    }

    public function destroy(gestiones $gestiones)
    {
        //
    }

    public function finalizar(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|min:5'
        ]);

        // 1️⃣ Buscar gestión
        $gestion = Gestiones::findOrFail($id);

        // 2️⃣ Registrar cierre en historial (visitas)
        Visita::create([
            'gestion_id'   => $gestion->id,
            'fecha_visita' => now()->toDateString(),
            'hora_visita'  => now()->toTimeString(),
            'comentario'   => $request->comentario,
            'estado'       => 'finalizada'
        ]);

        // 3️⃣ Cambiar estado de la gestión
        $gestion->update([
            'estado' => 'finalizada'
        ]);

        return redirect()
            ->route('visitas.historial', $gestion->id)
            ->with('success', 'Servicio finalizado correctamente');
    }
}
