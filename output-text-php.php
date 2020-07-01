<?php
    /*
        echoing out text and more
    */
?>



<?php
// simple echo
echo 'Hello World';

// using a template tag to echo what's fetched 
echo get_the_title();
// functions (template tags) w/o the 'get' word doesn't need echo to display
the_title();
?>



<?php // ECHOING HTML (assuming we're in html) ?>

<?php
get_header(); 
if( have_posts() ) : while( have_posts() ) : the_post();
?>

    <article id="<?php the_ID(); ?>">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
    </article>

<?php 
endwhile; endif; 
get_sidebar();
?>



<?php // ALTERNATE USING ECHO ?>

<?php 
get_header(); 
if( have_posts() ) : while( have_posts() ) : the_post();

    echo '<article id="' . get_the_ID() . '">';
        echo '<h2>' . get_the_title() . '</h2>';
        the_content();
    echo '</article>';

endwhile; endif; 
get_sidebar();
?>



<?php
// INTERNATIONALIZATION
/* When echoing text, echo it in a way that can be translated by WordPress. To do that, use one of a range of functions; most common is _e.

_e takes 2 parameters
    1. the text
    2. text domain
    
You define the text domain when opening up your plugin or your theme in the comments at the beginning of the plugin or stylesheet files. That then references a folder and a file within your theme or plugin where translation files are stored.
*/

_e( 'Hello World', 'textDomainName' );
?>

<?php // including variables and text – not echoing html tags as within quotes; assuming you're working in HTML ?>

<?php
function meo_get_pages() {

    $args = array(
        'parent' => 0,
        'sort_order' => ASC,
        'sort_column' => 'order_menu'
    );

    $myPages = get_pages( $args );
?>
        <ul class="page-list">
            <?php foreach( $myPages as $page ) { ?>
                <li>
                    <a href="<?php get_page_link( $page->ID ); ?>">
                        <?php echo $page->post_title; ?>
                    </a>
                </li>
            <?php } ?>    
        </ul>
<?php } ?>
