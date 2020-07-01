# Conditional Statements In WordPress
Example usage – you can check if the user is on a static page or a single post. 

    Why it's powerful:

    1. Without conditional statements, you cannot run any sort of loops.
    2. They allow you to specify when content or code is output and when it isn't

Sometimes you might just want to hook something to an action hook in your theme on a single page or on a post archive. So the other thing you need to know about is conditional tags.

## Conditional Tags
Conditional Tags can be used in your Template files to change what content is displayed and how that content is displayed on a particular page depending on what *conditions* that page matches. For example, you might want to display a snippet of text above the series of posts, but only on the main page of your blog. With the `is_home()` Conditional Tag, that task is made easy.

WP has a whole load of conditional tags, such as checking if we're on the main page, or the front page, or the blog page. Other things like admin, single post page, etc., there are probably hundreds of them.

```php
 <?php
 if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        // checks if the current post has a thumbnail
        <?php if( has_post_thumbnail() ) { ?>

            <h2 class="entry-title"><?php the_title(); ?></h2>
            // alignright/left would be your own custom CSS style
            <section class="thumbnail alignright">
                // returns the post thumbnail and outputs the featured image in its medium size
                <?php the_post_thumbnail('medium'); ?>
            </section>

            <section class="entry-content alignleft">
                <?php the_content(); ?>
            </section>
            
        <?php } 
        
        else { ?>

            <h2 class="entry-title"><?php the_title(); ?></h2>

            <section class="entry-content">
               <?php the_content(); ?>
            </section>
            
        <?php } ?>
    
    </article>

<?php endwhile() : endif(); ?>
```

```php
<?php
 function my_prefix_get_pages() {
     // checks if you're on a static page; if not, nothing will happen
     if( is_page() ) {

        $args = array(
            'parent' => 0;
            'sort_order' => ASC; 
            'sort_column' => 'menu_order';
        );

        $mypages = get_pages( $args );
       // checks that there are pages because there may not be a top level page
       // maybe you haven't created one yet and if there isn't one, there will be an error if the conditional statement wasn't there when the code runs
       if( $mypages ) {

           echo '<ul class="pageList">';

              foreach ( $mypages as $mypage ) {

                  echo '<li><a href="' . get_page_link( $mypage->ID ) . '">' . $mypage->post_title . '</a></li>';

              }

           echo '</ul>';

        }
     }
 }

 add_action( 'compass_after_content', 'my_prefix_get_pages' );
```

    It's important that you use conditional statements inside your functions, NOT around your action calls. It won't work. If the conditional statement isn't met within the function, the action call will not run or render anything, and that works fine; will not produce errors.

    e.g., if( hook_here ) // do not do like this