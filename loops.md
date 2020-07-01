# The Loop
**The Loop** is PHP code usd by WordPress to display posts. Using The Loop, WP processes each post to be displayed on the current page, and formats it according to how it matches specified criteria within The Loop tags.Any HTML or PHP code in The Loop will be processed on each post.

```php
 <?php
/* 
 * The Loop  
 * Example of the standard loop. Image this to be a php file within the includes directory. Any files within the includes directory is also referred to as "includes file".
 */ 

 // if there are single/page posts or archives
 if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    // the_ID() returns post ID retrieved from the db of the particular post
    // post_class() returns all classes relating to the type of post it is
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php the_content(); ?>
    
    </article>

<?php endwhile() : endif(); ?>
```

> the_ID() and post_class() are template tags, while the others are functions. Template tags are also functions.

```php
<?php
/* 
 * The Loop
 * Example of a nonstandard loop
 */

 // function that can be added anywhre in the theme by using hooks or by typing in the function name

 // geting the top level site

 function my_prefix_get_pages() {
     $args = array(
         // it should have no parent; making it a top level page from the website
         'parent' => 0;
         'sort_order' => ASC; // ascending order
         'sort_column' => 'menu_order';
     )

     $mypages = get_pages( $args );

     echo '<ul class="pageList">';
        // looping through each instance of $mypages and calling each of them $mypage
        foreach ( $mypages as $mypage ) {
            // echoing out desired information from the retrieved pages
            echo '<li><a href="' . get_page_link( $mypage->ID ) . '">' . $mypage->post_title . '</a></li>';
        }
     echo '</ul>';
 }
```

    To call either of The Loops, you can use hooks or simply invoke it by its name.