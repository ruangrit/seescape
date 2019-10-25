<?php

namespace WBCR\Factory_413\Updates;

// Exit if accessed directly
use Wbcr_Factory413_Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @author Webcraftic <wordpress.webraftic@gmail.com>, Alex Kovalev <alex.kovalevv@gmail.com>
 * @link https://webcraftic.com
 * @copyright (c) 2018 Webraftic Ltd
 * @version 1.0
 */
class Wordpress_Repository extends Repository {
	
	/**
	 * Wordpress constructor.
	 *
	 * @param Wbcr_Factory413_Plugin $plugin
	 * @param bool $is_premium
	 */
	public function __construct( Wbcr_Factory413_Plugin $plugin ) {
		$this->plugin = $plugin;
	}
	
	public function init() {
		// TODO: Implement init() method.
	}
	
	/**
	 * @return bool
	 */
	public function need_check_updates() {
		return false;
	}
	
	/**
	 * @return bool
	 */
	public function is_support_premium() {
		return false;
	}
	
	/**
	 * @return string
	 */
	public function get_download_url() {
		return '';
	}
	
	/**
	 * @return string
	 */
	public function get_last_version() {
		return '0.0.0';
	}
	
	public function check_updates() {
	
	}
	
	/**
	 * @return bool
	 */
	public function need_update() {
		return false;
	}
}