<?php

function lazy_load_images()
{
    echo '<script>
        window.addEventListener("load", function(){
            var images = document.querySelectorAll("img");
            images.forEach(function(img){
                img.setAttribute("loading", "lazy");
            });
        });
    </script>';
}
add_action('wp_footer', 'lazy_load_images');
