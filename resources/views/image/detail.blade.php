<?php

use App\Http\Controllers\HomeController;
?>
@extends('layouts.app')

@section('content')
<div class="container container-principal">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-content">{{ __('Publicación') }}</div>
                <div class="card-body">

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
                                <span class="nick">{{$image->user->nick}}</span>
                                {{ $image->description }}
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
                                
                                @if(Auth::check() &&($image->user_id == Auth::user()->id or $image->user_id == Auth::user()->id))
                                    <div class="nav-item dropdown action">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <div class="point"></div>
                                            <div class="point"></div>
                                            <div class="point"></div>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class='dropdown-item' href="{{ Route('publi.delete',['id'=>$image->id]) }}">Eliminar</a> 
                                        </div>
                                    </div>
                                    @endif

                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="card-comments">
                                @include('includes.message')
                                <h5>Comentarios</h5>
                                @foreach($image->comment as $comment)
                                <div class="comment">
                                    <span class="comment-nick">{{$comment->user->nick}}</span>
                                    <span class="comment-description">{{$comment->content}}</span>
                                    <span class="nick-date-comment">  {{FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                    
                                    @if(Auth::check() &&($comment->user_id == Auth::user()->id or $comment->image->user_id == Auth::user()->id))
                                    <div class="nav-item dropdown action">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <div class="point"></div>
                                            <div class="point"></div>
                                            <div class="point"></div>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class='dropdown-item' href="{{ Route('comment.delete',['id'=>$comment->id]) }}">Eliminar</a> 
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                @endforeach
                                <form action="{{ Route('comment.save') }}" method='post'>
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <p class="content-comment">
                                        <textarea class="form-control control-comment" name="content" placeholder='Comentar' required></textarea>
                                        <button class="button-comment" type='submit'>&ShortUpArrow;</button>
                                    </p>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
