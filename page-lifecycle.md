# WordPress Page Lifecycle

A page lifecycle is nothing more than a combination of the events that take place from when a broswer requests a page to when the server returns the page to the browser.

For example, you're loading up a single page. At a high level, WP will do something like the following:

    1. Look at the requested page ID
    2. Query the database for the page by its ID
    3. Query the database for any associated data (such as categories, tags, images, etc.)
    4. Query the database for comments associated with it
    5. Return all of the data to the browser

The template files and the calls to the API functions are then responsible for rendering, styling, and positioning the data on the screen.

> While WP is running its series of queries and preparing to render data back to the browser, it's looking at all of the custom hooks – that is, the actions and filters – that have been written and is passing data through those filters before returning data to the browser.

At this point, it's important to define hooks and look at the differences between actions and filters and how they play into this whole lifecycle.

## All About Hooks
WordPress hooks refer to two things – actions and filters. 

> Hooks enable us to literally  hook into parts of the WP page lifecycle to retrieve, insert, or modify data, or they allow us to take certain actions behind the scenes.

    1. Actions are different than Filters.
    2. You can't simply throw a hook into an arbitrary point of execution. There are times during which certain hooks fire and optimal times for you to take advantage of that.

Actions are events in the WP page lifecycle when certain things have occurred – certain resources are loaded, certain facilities are available, and depending on how early the action has occurred, some things have yet to load. 

> Actions are basically certain points during the page lifecycle in which you can introduce your own functionality. This means you have the ability to make something happen while a page is loading.

### Filter All The Things
Filters are completely differfent to actions. Like actions, they are similar points that occur during the WP page lifecycle; however, what they do is different.

> Filters are functions that WP passes data through during certain points of the page lifecycle. They are primarily responsible for intercepting, managing, and returning data before rendering it to the browser or saving data from the browser to the database.

## When To Use Hooks
- Use actions when you want to add something to the existing page such as stylesheets, JS dependencies, or send an email when an event has happened.
- Use filters when you want to manipulate data coming out of the database prior to going to the browser, or coming from the browser prior to going into the database.
