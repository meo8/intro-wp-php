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

## How to Run Functions
There are multiple ways to run functions.

1. Call it directly in your theme files
2. Use hooks

## Hooks: Action & Filter

In order to run a function, you use _hooks_.
Without hooking the functions you’ve written, nothing happens.
Your function will just sit in your functions file or your plugins in your plugins file, but until you hook them to an action or you call them within your theme, they won't actually work.

## Action Hooks 
These hooks are empty. If you add a function to an action hook, it will be the only thing that happens at that point. So it'll add something new to that point in the code where the action hook is located.

### **Action Hook Example**
Use the `add_action()` function to add/use hooks provided by WP.

    Parameters:

    1. name of action hook, you’re hooking the function to
    2. name of your function
    3. priority (optional; defaults to 10)

*widgets_init* is a WP action hook.

    add_action( ‘widgets_init’, ‘ff_say_hello’ );

That’s how to run a function.

### **Create Action Hooks**
Create a hook within your theme files, where you want your function to attach to your hook, and be sure to give it a relevant name.

    do_action( 'after_header' )

Within your functions file, call the hook.

    add_action( 'after_header', 'meo_say_hello' );

You can add multiple functions to a single hook (including pluggable functions).

You can have the function run in a particular order by using the `add_hook`'s 3rd parameter; priority.

When using the priority parameter, it's good practice to include the priority number for all the functions that are sharing the same hook even if the one of them has the default, 10, value.

    add_action( 'after_header', 'meo_say_bye', 20 );
    add_action( 'after_header', 'meo_say_hello', 10 );

That way, it's clear of what's happening.

It's also good practice to leave a comment next to the hook about what's being hooked to it. That helps you remember the function name as well as other developers looking at it later so they can edit it if they need to.

## Filter Hooks
These hooks are not empty. It surrounds some existing text/content/code and by attaching a function to a filter hook, what you'll do is replace that existing content with your new content. 

So it means that when you're coding a theme or a plugin, you can add some default text for example, wrap it in a filter and then you can override that with another function if you want to in the future.

### **Create Filter Hook**
Create a filter hook by using `apply_filters( string $tag, mixed $value )`.

    Parameters:

    1. name of the filter hook
    2. content to be filtered
    3. args (optional – additional parameters to pass to the callback function)

```php
echo apply_filters( 'meo_new_filter', '<h3>Latest Posts</h3>' )
```

You could use that in your theme for example, if you want to put "Latest Post" as a heading, but you wanted to give yourself the option or other users of your theme the option to override that at a later point, either in a plugin, or in the themes functions file. 

Think of it as default content. 

> Note: when working in PHP, `apply_filters()` alone, won't actually be output. You need to add `echo` before `apply_filters()`. You'll find the `echo` is often used with filters when you're adding your own filters.

### Override Filter Action Default Content
To override the filter action content, you would write a function and use `add_filter()` to hook your function to that filter you created.

```php
function meo_new_heading() {
    '<h3> Meo\'s Latest Post</h3>'
}

add_filter( 'meo_new_filter', 'meo_new_heading' );
```

When `add_filter()` doesn't run/get executed, the use of `apply_filters( 'filter_name', $value )`, will return the value of `$value` by default.