## Palm AI Community

A WordPress plugin to manage That have an AI Simulation for generating summary for post content for New created custom post type "Community Discussions" ,
i made some options insside the plugins to genrating the summary via AJAX Or not.


## Features

- Adds a settings page for AI summary options -- Theme options -- (content length, AJAX summary generation yes or Not)
- Add  AI summary to the single post for each post.
- Registers custom post types for scalability
- Easy integration with your WordPress admin

## Installation

1. Download or clone this repository into your `wp-content/plugins` directory:
2. pload this plugin to your wordpress plugins.
3. Activate the plugin from the WordPress admin dashboard.

## Usage

- Go to **Palm AI Summary Settings** in your WordPress admin menu.
- Set your preferred content summary length for choose generation content length from post-content.
- Enable or disable AJAX summary generation by checking the checkbox or not.
- go to Community Discussions post-type and start adding new post.
- **Notice** : you should add the post content for the post to start generation and i avoid to check if the content is empty (the generation based on post-conent).
- when click on button Generate AI Summary at the bottom of page it will generate the content based on the length from settings.
- the sycle will fired and saved the geneartion to the post meta.
- You will be able to the content of post with the generated AI Summary in single post page when you "View Post".

## File Structure

- inc/settings.php – Admin settings page for summary options.
- inc/post-types/.. – Registers custom any post types inside this folder then include it via inc/post-types.php.
- inc/content-display.php - Display AI Summary generated to the single post by using the_content().

