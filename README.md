# Wordpress Comments Form Validation

Wordpress Comments Form Validation is an open source plugin to add the [jQuery Validation plugin](http://jqueryvalidation.org/) functionality to the Wordpress comments form.

## Installation

1. Click on the 'Download Zip' button located in the sidebar of this page.
2. Login to your WordPress admin area and go to Plugins » Add New.
3. Select 'Upload' and navigate to the file you downloaded (most likely in your 'Downloads' folder).

## Issues

This plugin was designed to work with the default comment form markup, it _should_ work with most themes if they have stuck to the same naming conventions for field names.

## Tips

#### Remove Default Styling

If you would like to use your own styling for the error elements then you can easily remove the default styling by placing the following code inside a 'wp_enqueue_scripts' callback function.

```php
function themeslug_dequeue_style() {
	wp_dequeue_style( 'wp-cf-validation' );
}
add_action( 'wp_enqueue_scripts', 'themeslug_dequeue_style' );
```