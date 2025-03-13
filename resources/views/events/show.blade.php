@extends('layouts.main')

@section('title', $event->title)

@section('content')
<!-- Inclui a biblioteca de ícones do Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="imagem-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city"><i class="bi bi-geo-alt"></i> {{ $event->city }}</p>
            <p class="event-participants"><i class="bi bi-people"></i>  X Participantes</p>
            <p class="event-owner"><i class="bi bi-star"></i>  Dono do Evento </p> <!-- Adiciona o ícone de estrela outline -->
            <a href="#" class="btn btn-primary" id="event-submit"> Confirmar Presença</a><br></br>

            <h3>O evento conta com:</h3>
        <ul id="items-list">
            @foreach($event->items as $item)
                <li><i class="bi bi-play"></i><span>{{ $item }}</span></li>
            @endforeach
        </ul>
        </div>
        <div class="col-md12" id="description-container">
            <h3>Sobre o Evento: </h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>
@endsection
