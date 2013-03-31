=== Vine Embed ===
Contributors: ocean90
Tags: WP Embed, Embed, Video, Vine
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=VR8YU922B7K46
Requires at least: 2.9
Tested up to: 3.6
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily embed a Vine video into your posts.


== Description ==

Vine Embed is based on the new [API by Vine](https://vine.co/blog/embed-vine-posts).
With Vine Embed you can easily share your little videos with other users.

= What's your part? =
Just place a Vine link into your posts. For example `https://vine.co/v/bjHh0zHdgZT`
**By default no shortcodes are necessary, just a link!**
And that was about your part. Easy, isn't it?

= What does the plugin? =
The plugin will fetch your links of your music and will convert it to a sexy Spotify Play Button.

= Some usage examples =
To embed a simple vide just embed a link like this:
`https://vine.co/v/bjHh0zHdgZT`

There are two different types of embeds, simple and postcard. You can see the difference [here](https://vine.co/v/bjHh0zHdgZT/embed).
The default type is `simple`. To use the `postcard` type you had to choose the [embed] shortcode. Something like this:
`[embed type="postcard"]https://vine.co/v/bjHh0zHdgZT[/embed]`

For more examples please vist the [FAQ section](http://wordpress.org/extend/plugins/spotify-embed/faq/).

**Sounds pretty good? Install now!**

*Vine Embed is not associated in any way with Vine by Vine Labs, Inc..*

= Feedback =
If you want, you can drop me a line @[ocean90](http://twitter.com/ocean90) on Twitter or @[Dominik Schilling](https://plus.google.com/101675293278434581718/) on Google+.

= More =
If you want, you can try also some of my [other plugins](http://profiles.wordpress.org/users/ocean90) or visit my site [wpGrafie.de](http://wpgrafie.de/).



== Frequently Asked Questions ==

= What about sizes? =
Yes, there are three different sizes. Small, big, and huge. By default the size is based on [$content_width](http://codex.wordpress.org/Content_Width).
Examples:
`[embed size="small"]https://vine.co/v/bjHh0zHdgZT[/embed]`
`[embed size="huge" type="postcard"]https://vine.co/v/bjHh0zHdgZT[/embed]`

= Is it possible to change the default video type from `simple` to `postcard`? =
Yes. You can use a filter:

`
function ds_vine_embed_default_type( $type ) {
    return 'postcard',
}
add_filter( 'vine_embed_default_type', 'ds_vine_embed_default_type' );
`

= Can I combine all these keywords? =
Yes. (But don't try to combine the size keywords, or the sky will fall on your head)



== Screenshots ==

1. An example of an embed video.



== Installation ==

Note: There will be NO settings page.

For an automatic installation through WordPress:

1. Go to the 'Add New' plugins screen in your WordPress admin area
1. Search for 'Vine Embed'
1. Click 'Install Now' and activate the plugin


For a manual installation via FTP:

1. Upload the `vine-embed` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' screen in your WordPress admin area


To upload the plugin through WordPress, instead of FTP:

1. Upload the downloaded zip file on the 'Add New' plugins screen (see the 'Upload' tab) in your WordPress admin area and activate.



== Changelog ==

= 0.1.0 =
* First release.
