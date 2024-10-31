@extends('layouts.app')

@section('content')
<div class="container container-principal">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-content">{{ __('Inicio') }}</div>
                <div class="card-body">
                    <div class="card pug_image">
                        <div class='card-body publi-header'>
                            <div class="nav-item  avatar-perfil profile-image">
                                @if($user->image)
                                <img src="{{ route('user.avatar',['filename'=>$user->image])}}" class="avatar">
                                @endif
                            </div>
                            <div class="data_user_profile">
                                <p class="nick-profile">{{$user->nick}}</p>
                                <p class="name-profile">{{$user->name}} {{$user->surname}}</p>
                                <p class="create-profile">Se unio {{FormatTime::LongTimeFilter($user->created_at)}}</p>
                                @if($user->id == Auth::user()->id)
                                <a href="{{ Route('user.config') }}" class="btn btn-primary editar">Editar</a>
                                @endif
                            </div>
                        </div>
                        <h5 id="title-publi">Publicaciones ({{count($user->Image)}})</h5>
                        <div class="card-body">
                            
                            <div class="images-content-profile">
                                @foreach($user->Image->sortByDesc('created_at')  as $image)
                                <a href='{{Route('publi.detail',['id'=>$image->id])}}'>
                                    <div class="nav-item  image-content-profile">
                                        @if($image->image_path)
                                        <img src="{{ route('publi.image',['filename'=>$image->image_path])}}" class="image-layout">
                                        @endif
                                    </div>
                                </a>
                                @endforeach
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

