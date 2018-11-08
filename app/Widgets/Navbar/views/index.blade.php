<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 16:25
 */
?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Avtocod | Стена сообщений</a>
        </div>
        <ul class="nav navbar-nav">
            @foreach ($navbarMenu->getAllMasked([\App\Request\Navbar\NavbarMenu::MASK_ALL,
                            \App\Request\Navbar\NavbarMenu::MASK_QUEST]) as $item)
                <li @if ($item->isActive()) class="active" @endif> <a href="{{$item->getRoute()}}">{{$item->getTitle()}}</a></li>
            @endforeach
        </ul>
        @auth
            <ul class="nav navbar-nav navbar-right">
                @auth
                    <li class="navbar-text"><span class="glyphicon glyphicon-user"></span> %username%</li>
                @endauth
                @foreach ($navbarMenu->getAllMasked([\App\Request\Navbar\NavbarMenu::MASK_USER]) as $item)
                    <li @if ($item->isActive()) class="active" @endif> <a href="{{$item->getRoute()}}">{{$item->getTitle()}}</a></li>
                @endforeach
            </ul>
        @endauth
    </div>
</nav>
