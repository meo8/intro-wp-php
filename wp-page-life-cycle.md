# WordPress Page Life Cycle

A page life cycle is nothing more than a combination of the events that take place from when a broswer requests a page to when the server returns the page to the browser.

For example, you're loading up a single page. At a high level, WP will do something like the following:

    1. Look at the requested page ID
    2. Query the database for the page by its ID
    3. Query the database for any associated data (such as categories, tags, images, etc.)
    4. Query the database for comments associated with it
    5. Return all of the data to the browser

The template files and the calls to the API functions are then responsible for rendering, styling, and positioning the data on the screen.