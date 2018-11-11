@extends('layouts.app', ['page_title' => 'Стена сообщений!'])

@section('html_header')
<!-- Additional header tags -->
@endsection

@section('main_content')
    <div class="container">
        <div class="page-header">
            <h1>Сообщения от всех пользователей</h1>
        </div>

        @Auth
            @formPost()
            @endformPost
        @endAuth

        <?= \App\Widgets\Posts\Posts::show() ?>
    </div>
@endsection
