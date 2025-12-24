# FishAI WordPress Theme

This is a simple custom WordPress theme that embeds the FishAI image classifier UI as a page template.

## Installation

1. Copy the `wp-fishai-theme` folder into your WordPress `wp-content/themes/` directory.
2. Activate the **FishAI** theme in the WordPress admin: Appearance → Themes.
3. Create a new Page in WordPress and select the **FishAI App** template from the Page Attributes (Template) dropdown, then publish.

## Notes

- Tailwind is loaded via CDN for convenience.
- Font Awesome is loaded via CDN.
- The image classification is currently simulated (random selection from a local database). I can add real API hooks if you have a model endpoint.
- To switch to a Tailwind build pipeline (optimized CSS), I can add a build setup (Node, PostCSS, Tailwind CLI).

If you'd like, I can also add a shortcode so you can embed the app inside posts or multiple pages.
