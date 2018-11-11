<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 16:21
 */

namespace App\Widgets\Navbar;

use App\Domain\Navbar\NavbarMenu,
    App\Domain\Navbar\NavbarMenuItem,
    Auth;

class Navbar
{
    public static function show(): \Illuminate\View\View
    {
        $navbarMenu = new NavbarMenu();
        $navbarMenu->add(new NavbarMenuItem('Главная', 'posts', NavbarMenu::MASK_ALL));

        if ( !Auth::check() ) {
            $navbarMenu->add(new NavbarMenuItem('Авторизация', 'login', NavbarMenu::MASK_QUEST))
                       ->add(new NavbarMenuItem('Регистрация', 'register', NavbarMenu::MASK_QUEST));
        }

        $navbarMenuUser = new NavbarMenu();

        if ( Auth::check() ) {
            $navbarMenuUser->add(new NavbarMenuItem('Привет ' . Auth::user()->login, '', NavbarMenu::MASK_USER, 'glyphicon glyphicon-user', 'navbar-text'))
                           ->add(new NavbarMenuItem('Выход', 'logout', NavbarMenu::MASK_USER, 'glyphicon glyphicon-log-out', 'navbar-text'));
        }

        return view('widget.Navbar::index', compact('navbarMenu', 'navbarMenuUser'));
    }
}