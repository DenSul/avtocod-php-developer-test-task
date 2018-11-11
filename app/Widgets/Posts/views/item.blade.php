<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 22:45
 */
?>
<div class="row wall-message">
    <div class="col-md-1 col-xs-2">
        <img src="http://lorempixel.com/200/200/people/" alt="" class="img-circle user-avatar" />
    </div>
    <div class="col-md-11 col-xs-10">
        <p>
            <strong>{{$post->user->name}} ({{$post->created_at}}):</strong>
        </p>
        <blockquote>
            {{$post->text}}
        </blockquote>
        @auth
            @if (\Auth::user()->id == $post->user_id || \Auth::user()->is_admin)
                <a href="{{route('post.delete', $post->id)}}">Удалить сообщение</a>
            @endif
        @endauth
    </div>
</div>
