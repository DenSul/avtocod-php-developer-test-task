<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 16:52
 */

namespace App\Request\Navbar;


use Request, Illuminate\Support\Facades\URL;

class NavbarMenuItem
{
    /** @var string  */
    private $title = '';
    /** @var string  */
    private $route = '';
    /** @var string|guest|user|all  */
    private $visibleLevel = 'user';
    /** @var string  */
    private $icon = '';
    /** @var string  */
    private $spanClass = '';

    /**
     * NavbarMenu constructor.
     * @param string $title
     * @param string $route
     * @param string $visibleLevel
     * @param string $icon
     * @param string $spanClass
     */
    public function __construct(string $title, string $route = '',
                                string $visibleLevel = 'all', string $icon = '',
                                string $spanClass = '')
    {
        if ( $route ) {
            $route = route($route);
        }

        $this->title         = $title;
        $this->route         = $route;
        $this->visibleLevel  = $visibleLevel;
        $this->icon          = $icon;
        $this->spanClass     = $spanClass;
    }

    /**
     * @return string
     */
    public function getSpanClass(): string
    {
        return $this->spanClass;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return int
     */
    public function getVisibleLevel(): string
    {
        return $this->visibleLevel;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return bool
     */

    public function isActive(): bool
    {
        if ( URL::current() == $this->getRoute() ) {
            return true;
        }

        return false;
    }
}