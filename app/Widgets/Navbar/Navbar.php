<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 16:21
 */

namespace App\Widgets\Navbar;

use App\Request\Navbar\NavbarMenu,
    App\Request\Navbar\NavbarMenuItem,
    Auth;

class Navbar
{
    public static function show(): \Illuminate\View\View
    {
        $navbarMenu = new NavbarMenu();
        $navbarMenu->add(new NavbarMenuItem('Главная', 'posts', NavbarMenu::MASK_ALL))
                   ->add(new NavbarMenuItem('Авторизация', 'login', NavbarMenu::MASK_QUEST))
                   ->add(new NavbarMenuItem('Регистрация', 'register', NavbarMenu::MASK_QUEST));

        if ( Auth::check() ) {
            $navbarMenu->add(new NavbarMenuItem(optional(Auth::check()->name)), '', NavbarMenu::MASK_USER, 'glyphicon glyphicon-user')
                       ->add(new NavbarMenuItem('Выход', 'logout', NavbarMenu::MASK_USER, 'glyphicon glyphicon-log-out'));
        }

        return view('widget.Navbar::index', compact('navbarMenu'));
    }
}