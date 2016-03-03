=== Plugin Name ===
Contributors: Waterloo Plugins
Tags: bmi, bmi calculator, calculate bmi, body mass index, health, diet, material design, bootstrap, shortcode
Requires at least: 3.0
Tested up to: 4.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a simple, stylable BMI calculator to your WordPress blog. Comes with several stylish themes.

== Description ==

Add a body mass index calculator to your blog by using the `[bmi]` shortcode. See the screenshots for previews.

There are 3 built-in styles: material design, Bootstrap, and default (your theme's styles).

Options:

* theme - `material`, `clean`, `default`, or `none`
* metric - Label text for metric section
* imperial - Label text for imperial section
* height - Label text for height input
* weight - Label text for weight input
* heightPlaceholder - Placeholder text for height input
* weightPlaceholder - Placeholder text for weight input
* submit - Text for submit button
* result - Text for result, use `%bmi%` to represent the calculated BMI

Examples:
`[bmi theme="clean"]`
`[bmi theme="material" heightPlaceholder="Enter your height" submit="Calculate your BMI!" result="Your BMI is %bmi%"]`

== Installation ==

1. Upload `bmi-calculator-shortcode.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `[bmi]` in your post

== Frequently Asked Questions ==

= Are there going to be more themes? =

Yes, in future updates.

= How do I add my own theme? =

You can use `none` as the theme to disable styling and add add your own styles.

== Screenshots ==

1. Material design theme
2. Clean (Bootstrap) theme
3. Default theme
4. Material design theme with input

== Changelog ==

= 1.0.1 =
* Minor performance fix

= 1.0 =
* Initial
