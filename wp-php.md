# WordPress & PHP

## Custom page template

A template that gives the user of your theme multiple options for displaying pages.

    custom-page-full-width.php (template without sidebar)

When telling WP that a particular php file is a custom template, make sure you use multi-line comment and it’s super important to include the template name.

    /*
        Template Name: Name Of Your Page Template
    */

Same goes for any custom plug-ins, however it needs more information as seen below.

    Plugin Name: …
    Plugin URI: …
    Description: …
    Version: …
    Author: …
    Author URI: …
    License: …
    Text Domain: …

## Basic Function

Use a prefix before your function name as to avoid using the same name as WP functions.

```php
function meo_say_hello() {
    echo 'Hello World';
}
```

## Pluggable Function

When you write functions in your parent theme and want to override it in your child theme, have the parent theme’s functions be _pluggable_.

Meaning, WP will look in child theme first for that particular function before it looks at the parent theme.

It will only run if there isn’t another function with the same name somewhere present, and that somewhere present is in the child theme. Because the child theme’s functions file is run before the parent themes.

If you don’t make the functions pluggable and there are 2 functions with the same name, it will throw an error and you’ll get the white screen of doom.

```php
if( ! function_exists( 'meo_say_hello' ) ) {

    function meo_say_hello() {
        echo 'If the meo_say_hello function does not exist,
        it will be created and ran here.';
    }

 }
```

## Hooks: Action & Filter

In order to run a function, you must use _hooks_.
Without hooking the functions you’ve written, nothing happens.
Your function will just sit in your functions file or your plugins in your plugins file.

Use the add_action() function to add/use hooks provided by WP.

add_action() – takes 2 parameters

1. name of action hook, you’re hooking the function to
2. name of your function

widgets_init is a WP action hook.

    add_action( ‘widgets_init’, ‘ff_say_hello’ );

That’s how to run a function.
