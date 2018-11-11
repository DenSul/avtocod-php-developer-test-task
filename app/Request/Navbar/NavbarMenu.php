<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 17:12
 */

namespace App\Request\Navbar;


class NavbarMenu
{
    /** @var string  */
    const MASK_QUEST = 'quest';
    /** @var string  */
    const MASK_USER = 'user';
    /** @var string  */
    const MASK_ALL = 'all';

    /** @var array */
    private $items = [];

    /**
     * @param NavbarMenuItem $item
     * @return $this
     */

    public function add(NavbarMenuItem $item): NavbarMenu
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param array $masks
     * @return array
     */

    public function getAllMasked(array $masks): array
    {
        if ( $this->items ) {
           $filtered = collect($this->items)->map(function(NavbarMenuItem $item) use ($masks) {
               if ( in_array($item->getVisibleLevel(), $masks) ) {
                   return $item;
               }
           });

           return $filtered->toArray();
        }

        return [];
    }

    /**
     * @return array
     */

    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */

    public function count(): int
    {
        return count($this->items);
    }
}