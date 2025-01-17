<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    // Rotas de controle

    public function index() {

          $events = Event::all();  // chamando todos os eventos para mh aplicação

          return view('welcome',['events' => $events]);
          // enviando todos os itens da minha view para o banco
    }

    public function create() {
        return view('events.create');
    }

    // eu vou receber o request pelo os parametros direto do meu formulário laravel
    public function store(Request $request){
        // tenho que criar um objeto com esses dados

        $event = new Event;
        // vou espelhar o meu objeto para que preencha as informações obrigatórias
        $event -> title = $request -> title;
        $event -> city = $request -> city;
        $event -> private = $request -> private;
        $event -> description = $request -> description;
        $event -> items = $request -> items; // dizer que o dado vem em array e não em uma string



        // image upload
        // se o request tiver o arquivo hasfile se tiver o arquivo e ele for uma imagem, ele for válido podemos proseguir

        if($request->hasFile('image') && $request ->file('image')->isValid()){

            $requestImage = $request-> image;

            $extension = $requestImage ->extension(); // criar a extensão e tbm o nome dela

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // deixa o nome do arquivo único concatenando com o tempo de agr cria uma string com base no tempo que estou dando upload no md5 uma rest

            // adicionar a imagem a pasta

            $requestImage -> move(public_path('img/events'), $imageName); // local da imagem / salva com o nome

           // fazendo uma extensão para o imageName name que é o nome da imagem

           $event -> image = $imageName; //dados que seram salvos no banco

           // para essa ação será necessário criar as migrations se não apontará erro ao tenta carregar a imagem


        }

        // salvar os arquivos no banco de dados a pessistir
        $event->save(); // salvando completamente
        // eu vou redirecionar o usuário para alguma página
        // eu posso retornar uma view ou dar um redirection

       return redirect('/')->with('msg', 'Evento criado com sucesso!!');

    }
    // esperando um id vindo do front
    public function show($id) {
       $event = Event::findOrFail($id);
        #retorna uma view
       return view('events.show', ['event' => $event]);
    }

}

