<?php
// single text variable
$message = 'Hello World';

// using a variable with a function
$todaysDate = date( 'l jS F Y' );
echo $todaysDate;

// using variables to store results of a database call
$args = array(
        'parent' => 0,
        'sort_order' => ASC,
        'sort_column' => 'menu_order'
    );

// retrieveing array of top level pages from db
$myPages = get_pages( $args );

// checks if myPages is populated and actually has pages
if( $myPages ) {

    echo '<ul class="pages">';
        // goes thru each element (page) within myPages array
        foreach( $myPages as $page ) {
            // each page has a number of fields (columns) retrieved from the db
            // stores desired field's value 
            $pageID = $page->ID;
            $pageTitle = $page->post_title;
            // get_page_link() function takes an argument of the page's ID to retrieve the link to that page
            echo '<li><a href="' . get_page_link( $pageID ) . '">' . $pageTitle . '"</a></li>';

        }

    echo '</ul>';
    
}

/*
 * New example: putting it all together – can only run in the loop because the current scenario is that you're working with the current post. The following can run in either a standard loop or a foreach() loop.
 */

// overrides the variable above
$message = 'Hello Everybody';
// using a variable with a Template Tag 
// used to retrieve value of a custom field called mood
// true ensures that it only brings back the first result
$mood = get_post_meta( get_the_ID(), 'mood', true );

/* If the first thing that you're echoing is either the results of a function or it's a variable, you don't put quotation mark in from of it, but then you do need to do that for any text */
echo $message . ", today's date is " . $todaysDate . " and I'm feeling " . $mood . ".";
// echo "$message, today's date is $todaysDate and I'm feeling $mood."

// retrieves the 5 most recent posts
$args = array( 'posts_per_page' => 5);

// retrieveing array of top level pages from db
$myPosts = posts( $args );

// checks if myPosts is populated and actually has pages
if( $myPosts ) {

    $message = 'Hello everybody';

    echo '<ul class="posts">';
        // goes thru each element (page) within myPosts array
        foreach( $myPosts as $post ) {
            // each post has a number of fields (columns) retrieved from the db
            // stores desired field's value 
            $postID = $post->ID;
            $mood = get_post_meta( $post, 'mood', true);
            // format & post ID to retrieve post's published date
            $postedDate = get_the_date( 'l jS F Y' , $postID ); 

            // get_page_link() function takes an argument of the post's ID to retrieve the link to that post
            echo '<li>' . $message . ', I wrote this post on ' . $postedDate . 'I was feeling ' . $mood . '.' . '</li>';
            // echo "<li>$message today's date is $todaysDate and I'm feeling $mood.</li>";

        }

    echo '</ul>';
    
}
