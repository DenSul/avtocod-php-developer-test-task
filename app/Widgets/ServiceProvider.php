<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 08/11/2018
 * Time: 15:44
 */

namespace App\Widgets;


final class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /** @var string  */
    const VIEW_PATH = 'views';

    /**
     * @return  void
     */

    public function boot(): void
    {
        $widgets = config('widgets');

        foreach ($widgets as $widget) {
            if(is_dir($this->getViewPath($widget))) {
                $this->loadViewsFrom($this->getViewPath($widget), 'widget.' . $widget);
            }
        }
    }

    /**
     * @param $widget
     * @return string
     */

    private function getViewPath($widget): string
    {
        return sprintf("%s/%s/%s",__DIR__, ucfirst($widget),  static::VIEW_PATH);
    }

    /**
     * @void
     */

    public function register(): void
    {

    }
}