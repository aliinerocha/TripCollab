@extends('layouts.template', ['pagina' => 'perfil'])
@section('titulo')

@endsection

@section('conteudo')
    <div class="container-fluid p-0">
        <!-- Foto da Capa -->
        <main class="col-xs-12 capa p-0">
            <img src="@if($user->photo == 'nophoto') {{asset('./img/default_cover.jpg')}}  @else {{asset("storage/usersBackgroundPhotos/$user->background_photo")}} @endif" alt="imagem de fundo escolhida pelo usuário">
        </main>
        <!-- Foto da Capa -->

        <section class="usuario bg-light mb-2 px-3 pb-4">
            <!-- Foto do Usuário -->
            <div class="col-xs-12 usuario-foto p-0">
                <img src="@if($user->photo == 'nophoto') {{asset('./img/icone_user.svg')}}  @else {{asset("storage/userPhotos/$user->photo")}} @endif" class="rounded-circle" style="width:100px; height: 100px">
            </div>
            <!-- Foto do Usuário -->

            <!-- Botões -->
            <div class="col-xs-12 usuario-botoes text-right pull-right py-3">
                {{-- <a href="notificacoes"><i class="far fa-bell fa-lg"></i></a> --}}
            <a href="{{route('user.edit', ['id' => $user->id])}}"><i class="far fa-edit fa-lg"></i></a>
            </div>
            <!-- Botões -->

            <!-- Descrição do Usuário -->
            <h5 class="nome ml-3 py-1 ">{{$user->name}}</h5>

            <div class="col-xs-12">
                <div class="row usuario-local ml-3 pt-3">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                    <h6 class="localizacao ml-2">{{$user->city}}, {{$user->state}}, {{$user->country}}</h6>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row usuario-descricao text-justify mx-3 pt-4 pb-2">
                    {{$user->description}}
                </div>
            </div>
            <!-- Descrição do Usuário -->

            <!-- Interesses -->
            <h5 class="nome mx-3 pt-4">Meus interesses</h5>
            <div class="col-xs-12">
                <div class="row interesses text-justify mx-3 py-2">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, ducimus. Quibusdam dignissimos reprehenderit placeat quas modi, ipsa temporibus omnis labore aspernatur, fugit officia delectus iure. Eveniet deleniti odio explicabo ipsum!
                </div>
            </div>
            <!-- Interesses -->
        </section>

        <!-- Amigos -->
        <section class="amigos bg-light px-3 py-4">
            <h5 class="nome pt-1 pb-1 ml-3">Meus amigos</h5>
            <!-- Busca -->
            <div class=" input-group mb-3 py-3 col-10">
                <input type="text" class="form-control border-0" placeholder='Pesquisar "Amigos"'>
                <div class="input-group-append">
                    <span class="input-group-text border-0"> <i class="material-icons">search</i></span>
                </div>
            </div>

            <!-- Lista de Amigos -->
            <h6 class="amigo ml-3">123 amigos</h6>
                <div class="col-xs-12 amigo-foto ml-3 py-4">
                    <img src="" class="rounded-circle" style="width:90px; height: 90px"><h6 class="amigo ml-4">Amigo Amigo 1</h6>
                </div>
                <div class="col-xs-12 amigos-foto ml-3 py-4">
                    <img src="" class="rounded-circle" style="width:90px; height: 90px"><h6 class="amigo ml-4">Amigo Amigo 2</h6>
                </div>
                <div class="col-xs-12 amigos-foto ml-3 py-4">
                    <img src="" class="rounded-circle" style="width:90px; height: 90px"><h6 class="amigo ml-4">Amigo Amigo 3</h6>
                </div>
        </section>
        <!-- Amigos -->
    </div>
@endsection