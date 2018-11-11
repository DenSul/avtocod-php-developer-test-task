<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 16:08
 */
?>
<form action="{{route('post.create')}}" method="post" class="form-horizontal">
    @csrf

    @if (session('status'))
        @alert(['type' => 'success'])
        {{session('status')}}
        @endalert
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @alert(['type' => 'danger'])
            {{$error}}
            @endalert
        @endforeach
    @endif
    <div class="controls">
        <div class="col-md-12">
            <div class="form-group">
                <label for="message_text">Текст сообщения:</label>
                <textarea id="message_text" name="post" class="form-control"
                          placeholder="Ваше сообщение" rows="4"
                          required="required"></textarea>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-success btn-send" value="Отправить сообщение" />
        </div>
    </div>
</form>
