<?php
/**
 * Plugin Name: Vine Embed
 * Version: 0.2
 * Description: Just add Vine links into your posts and the plugin will add the embed code for you.
 * Author: Dominik Schilling
 * Author URI: http://wphelper.de/
 * Plugin URI: http://wpgrafie.de/wp-plugins/vine-embed/en/
 *
 * License: GPLv2 or later
 *
 *	Copyright (C) 2013 Dominik Schilling
 *
 *	This program is free software; you can redistribute it and/or
 *	modify it under the terms of the GNU General Public License
 *	as published by the Free Software Foundation; either version 2
 *	of the License, or (at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Don't call this file directly.
 */
if ( ! class_exists( 'WP' ) ) {
	die();
}


/**
 * The class.
 */
final class DS_Vine_Embed {
	/**
	 * The Vine API URL.
	 */
	private static $api_endpoint = 'https://vine.co/';

	/**
	 * Register the embed handler.
	 */
	public static function init() {
		wp_embed_register_handler(
			'vine',
			'#https?:\/\/vine\.co\/v\/([a-z0-9]+)\/?#i',
			array( __CLASS__, 'embed_handler_vine' )
		);
	}

	/**
	 * Callback function for the spotify embeds. Prints the HTML embed code.
	 *
	 * @param  mixed $matches Matches through the regex search.
	 *               $matches[0] The Vine URL.
	 *               $matches[1] The video ID.
	 * @param  array $attr    Custom attributes from the [embed][/embed] shortcut
	 * @param  string $url    The matched URL.
	 * @param  array $rawattr Includes the height and width from media settings
	 *
	 * @return string         The HTML embed code.
	 */
	public static function embed_handler_vine( $matches, $attr, $url, $rawattr ) {
		if ( empty( $matches ) )
			return;

		static $vine_embed_script;

		if ( null === $vine_embed_script )
			$vine_embed_script = true;
		else
			$vine_embed_script = false;

		// The video ID.
		$id = $matches[1];

		// Set the size of the embed iframe.
		if ( ! empty( $attr['size'] ) && 'small' == $attr['size'] ) {
			$width = $height = 320;
		} elseif ( ! empty( $attr['size'] ) && 'large' == $attr['size'] ) {
			$width = $height = 480;
		} elseif ( ! empty( $attr['size'] ) && 'huge' == $attr['size'] ) {
				$width = $height = 600;
		} else {
			if ( ! empty( $rawattr['width'] ) && ! empty( $rawattr['height'] ) ) {
				$width  = $rawattr['width'];
				$height = $rawattr['height'];
			} else {
				list( $width, $height ) = wp_expand_dimensions( 320, 320, $attr['width'], $attr['height'] );
			}
		}

		// Set the type, can be simple (default) or postcard.
		$type = apply_filters( 'vine_embed_default_type', 'simple' );
		if ( ! empty( $attr['type'] ) && 'postcard' == $attr['type'] )
			$type = 'postcard';

		// Generate the base embed source.
		$embed_src = sprintf(
			'%sv/%s/embed/%s',
			self::$api_endpoint,
			$id,
			$type
		);

		// Set autoplay audio.
		$play_audio = apply_filters( 'vine_embed_default_play_audio', false );
		if ( in_array( 'play-audio', array_values( $attr ) ) )
			$play_audio = true;

		if ( $play_audio )
			$embed_src = add_query_arg( 'audio', '1', $embed_src );

		// The embed code.
		return sprintf(
			'<iframe class="vine-embed" src="%s" width="%d" height="%d" frameborder="0" allowTransparency="true"></iframe>%s',
			esc_url( $embed_src ),
			(int) $width,
			(int) $height,
			$vine_embed_script ? '<script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>' : ''
		);
	}
}

// Gogogo.
add_action( 'plugins_loaded', array( 'DS_Vine_Embed', 'init' ) );
