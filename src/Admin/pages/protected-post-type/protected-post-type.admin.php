<?php
$args = array(
   'public'   => true,
   //'_builtin' => false
);


$post_types = get_post_types( $args );

echo '<ul>';

foreach ( $post_types as $post_type ) {

   echo '<li>' . $post_type . '</li>';
}

echo '</ul>';
?>
