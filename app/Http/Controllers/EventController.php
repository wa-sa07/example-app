<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    // Rotas de controle

    public function index() {
        $search = request('search');
        if($search) {
            // Se houver uma pesquisa, filtra os eventos pelo título
            $events = Event::where('title', 'like', '%'.$search.'%')->get();
        } else {
            // Caso contrário, retorna todos os eventos
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    // Recebe o request pelo os parâmetros direto do formulário Laravel
    public function store(Request $request){
        // Cria um novo objeto Event
        $event = new Event;

        // Preenche as informações obrigatórias
        $event->title = $request->title;
        $event->event_date = $request->date; // Certifique-se de que o nome do campo no formulário é 'date'
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items; // Certifique-se de que o campo 'items' é um array

        // Upload da imagem
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension(); // Obtém a extensão do arquivo
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName); // Move a imagem para a pasta pública
            $event->image = $imageName; // Salva o nome da imagem no banco de dados
        }

        $user = auth()->user(); // Obtém o usuário logado
        $event->user_id = $user->id; // Associa o evento ao usuário logado

        // Salva o evento no banco de dados
        $event->save();

        // Redireciona o usuário para a página inicial com uma mensagem de sucesso
        return redirect('/')->with('msg', 'Evento criado com sucesso!!');
    }

    // Espera um id vindo do front
    public function show($id) {
        $event = Event::findOrFail($id);
        return view('events.show', ['event' => $event]);
    }
}
