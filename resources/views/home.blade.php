<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
?>
@extends('layouts.app')

@section('content')
<div class="container container-principal">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-content">{{ __('Inicio') }}</div>
                <div class="card-body">
                    @foreach($images as $image)
                    <div class="card pug_image">
                        <div class='card-body publi-header'>
                            <div class="nav-item avatar-perfil avatar-content">
                                @if($image->user->image)
                                <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
                                @endif
                            </div>
                            <div class="data_user">
                                <a href='{{route('user.profile',['id'=>$image->user->id])}}'>{{$image->user->nick}}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="image-content">
                                <img src="{{ Route('publi.image',['filename'=>$image->image_path])}}" />
                            </div>
                            <div class="description">
                                <span class="nick">{{$image->user->nick}}</span>{{ $image->description }}
                                <span class="nick-date">  {{FormatTime::LongTimeFilter($image->created_at)}}</span>
                            </div>

                            <div class="likes">
                                <?php $user_like = false; ?>
                                @foreach($image->like as $like)
                                @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                                @endif
                                @endforeach

                                @if($user_like)
                                <img src='{{asset('images/heartred.png')}}' data-id='{{$image->id}}' class="btn-dislike">
                                @else
                                <img src='{{asset('images/heartblack.png')}}' data-id='{{$image->id}}' class="btn-like">
                                @endif

                                <span  class='number-likes'>{{count($image->like)}}</span>

                            </div>
                            <div class="comments">
                                <a href='{{ Route('publi.detail',['id'=>$image->id]) }}'>Comentarios({{count($image->comment)}})</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
