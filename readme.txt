=== WP Car Manager - OpenData RDW Kenteken Voertuiginformatie ===
Tags: RDW, Kenteken, Voertuiginformatie, WP-Car-Manager, WPCM
Contributors: automex, patrickgroot
Collaborators: automex, patrickgroot
Donate link: https://www.paypal.com/paypalme/pgroot91
Requires at least: 4.6
Tested up to: 5.6.0
Stable tag: 1.1.0
Version: 1.1.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

With the extension "OpenData RDW Kenteken Voertuiginformatie" for the plugin "[WP Car Manager](https://www.wpcarmanager.com/)" you're able to enrich your listings automatically with vehicle data based on the vehicle registration plate. 

== Description ==

= WP Car Manager - OpenData RDW Kenteken Voertuiginformatie =

With the extension "OpenData RDW Kenteken Voertuiginformatie" for the plugin "[WP Car Manager](https://www.wpcarmanager.com/)" you're able to enrich your listings automatically with vehicle data based on the vehicle registration plate. 

[youtube https://www.youtube.com/watch?v=kLEXHpTuguo]

= Data =

* Title [Make Model (Year)]
* Make
* Model
* First Registration Date
* Color
* Body Style
* Transmission
* Doors
* Engine
* Power kW
* Power HP

<strong>Important:</strong> Makes and models is something you manage yourself within the "Makes & Models" section of WP Car Manager. The only thing the plugin does is trying to match and select the make and model.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/wpcm-amex-opendata-rdw` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Done!

== Frequently Asked Questions ==

= How can I send feedback or get help with a bug? =

We’d love to hear your bug reports, feature suggestions and any other feedback! Please head over to the [GitHub](https://github.com/automex/) issues page to search for existing issues or open a new one. While we’ll try to triage issues reported here on the plugin forum, you’ll get a faster response (and reduce duplication of effort) by keeping everything centralized in the [GitHub](https://github.com/automex/) repository.

= Why should you be using an App Token? =

Using an App Token allows [us](https://www.tylertech.com/products/socrata) to throttle by application, rather than via IP address, which gives you a higher throttling limit. 

= How to obtain/generate an App Token? =

1) Signup for an account at [opendata.rdw.nl](https://opendata.rdw.nl/signup).
2) Navigate to your profile page
3) Click on the "Edit Profile" url in the top right corner of your profile.
4) Click on the "Developer Settings" menu item on the left.
5) In the section "App Tokens" you are able to create a new application.
6) Click on the "Create New App Token" button on the right.
7) Fill in all the details and click "Save".
8) Now copy your "App Token" from the overview page.

Continue your read with the following FAQ: I copied the App Token and what now?

= I copied the App Token and what now? =

1) Navigate to your WordPress Admin Area.
2) Navigate to your "Car Listings" page (WP Car Manager Plugin).
3) Click on the submenu item "Settings".
4) Click on the tab "OpenData RDW".
5) Paste the "App Token" in the "App Token" input field.
6) Click on the "Save Changes" button.

Tada! You're all set and ready to go!

= Does this plugin work with the front-end submission form? =

The short answer to that is NO. 

<strong>Will it ever be supported?</strong>

Who knows but not anytime soon.

= What font did you use for the License Plate? =

The font we used is called "Kenteken" made by [LeFly Fonts](http://lefly.vepar.nl/).

== Screenshots ==

1. Admin Area (Car listings -> Settings -> OpenData RDW).
2. Admin Area (Add New Listing -> Enter your license plate number dialog).
3. Admin Area (Add New Listing -> Enter your license plate number dialog).
4. Admin Area (Add New Listing Overview Page with filled in data).

== Changelog ==

= 1.0 =
* Initial version.

== Upgrade Notice ==
