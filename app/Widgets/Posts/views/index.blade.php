<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 22:45
 */
?>
<div id="container_post">
    @foreach ($posts as $post)
        @include('widget.Posts::item', ['post' => $post])
    @endforeach

    {{ $posts->links() }}
</div>
