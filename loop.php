<?php
/**
 * The loop that displays posts (Extremely cut-down).
 *
 */
?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav>
        <?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
        <?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
    </nav>
<?php endif; ?>
 
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
        <h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'starkers' ); ?></p>
            <?php get_search_form(); ?>
<?php endif; ?>
 
<?php while ( have_posts() ) : the_post(); ?>
 
    <article>
             <h1><?php the_title();?></h1>
             <div>
                 <?php the_content();?>
             </div>
    </article>
   
<?php endwhile; // End the loop. Whew. ?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <nav>
        <?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
        <?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
    </nav>
<?php endif; ?>