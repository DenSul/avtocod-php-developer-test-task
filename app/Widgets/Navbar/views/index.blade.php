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
            @foreach ($navbarMenu->getAllMasked([\App\Domain\Navbar\NavbarMenu::MASK_ALL,
                            \App\Domain\Navbar\NavbarMenu::MASK_QUEST]) as $item)
                <li @if ($item->isActive()) class="active" @endif> <a href="{{$item->getRoute()}}">{{$item->getTitle()}}</a></li>
            @endforeach
        </ul>
        @if ($navbarMenuUser->count() > 0)
            <ul class="nav navbar-nav navbar-right">
                @foreach ($navbarMenuUser->getAllMasked([\App\Domain\Navbar\NavbarMenu::MASK_USER]) as $item)
                    <li class="@if ($item->getSpanClass()) {{$item->getSpanClass()}} @endif @if ($item->isActive()) active @endif">
                        @if ($item->getIcon())
                            <span class="{{$item->getIcon()}}"></span>
                        @endif
                        <a href="{{$item->getRoute()}}">{{$item->getTitle()}}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</nav>
