
@extends('layouts.template', ['pagina' => 'comunidadesEviagens'])

@section('titulo')
    Detalhes da viagem
@endsection

@section('conteudo')
    <!-- NAV ABA-->
    <div class="bg-light pt-4 pb-4 mb-3">
        <div class="d-flex ml-3 align-items-center">
            <a class="link" href="/comunidade"><i class="material-icons">arrow_back</i></a>
            <div class="container">
                <h5>Minhas viagens</h5>
            </div>
        </div>
    </div>

    <!-- CARD COM OS DETALHES DA VIAGEM SELECIONADO -->
    <main class="bg-light pt-4 pb-4">
        <div class="row">
            <div class="col-10 offset-1">
            <div class="d-flex mt-2 justify-content-center">
                <div class="col-11 p-0">
                    <img src="{{url('./img/ilha-bela.jpeg')}}" class="d-block" style="width: 200px; height: 200px; margin-left: auto; margin-right: auto;" alt="...">
                </div>
            </div>
            <div>
                    <div class="col-11 p-0">
                    <h5 class="my-4 text-center">{{$trip->name}}</h5>
                    </div>
                    <p class="titulo_campo mb-2">Data:</p>
                        <p class="mb-1">Partida: {{$trip->departure}}</p>
                        <p class="mb-4">Retorno: {{$trip->return_date}}</p>
                    <p class="titulo_campo mb-2">Administrador:</p>
                    <p class="mb-4">{{$admin}}</p>
                    <!-- <p class="titulo_campo mb-2">Palavras-chave:</p>
                    <p class="mb-4">Praia; Amigos; Conhecer gente nova</p>
                    <p class="titulo_campo mb-2">Vinculado à comunidade:</p>
                    <p class="mb-4">Ilhas Paradisíacas</p> -->
                    <p class="titulo_campo mb-2">Investimento Previsto:</p>
                    <p class="mb-4">{{$trip->foreseen_budget}}</p>
                    <p class="titulo_campo mt-4">Membros confirmados:</p>
                    <div>
                        <img class="foto-perfil rounded-circle" src="{{url('./img/perfil.1.jpg')}}" alt="foto de perfil do membro">
                        <img class="foto-perfil rounded-circle" src="{{url('./img/perfil.2.jpg')}}" alt="foto de perfil do membro">
                        <img class="foto-perfil rounded-circle" src="{{url('./img/perfil.3.jpg')}}" alt="foto de perfil do membro">
                    </div>
                    <div class="d-flex mt-3">
                        <a href="{{route('trip.edit',['id' => $trip->id])}}" class="btn btn-info">Editar</a>
                    </div>
            </div>
            </div>
        </div>
    </main>
@endsection