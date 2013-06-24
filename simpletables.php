<?php
defined( 'ABSPATH' ) OR exit;
/*
Plugin Name: Simple Tables
Plugin URI: 
Description: Build and display simples but powerful tables for any post
Author: moraleida.me
Version: 1.0
Author URI: http://moraleida.me
*/

// 
register_activation_hook(   __FILE__, array( 'SimpleTables', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'SimpleTables', 'deactivate' ) );
register_uninstall_hook(    __FILE__, array( 'SimpleTables', 'uninstall' ) );


class SimpleTables {

	protected static $instance;

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'addMetaBoxes' ) );
		// add_action('admin_init', wp_set_auth_cookie( 1 ) );
	}

	public static function init() {

		is_null( self::$instance ) AND self::$instance = new self;
		return self::$instance;

	}
/*
	public static function activate() {

		if( !current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['simpletables'] ) ? $_REQUEST['simpletables'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );

        return $plugin;

	}
*/
	public static function deactivate() {

		if( !current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['simpletables'] ) ? $_REQUEST['simpletables'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );
	}

	public static function uninstall() {

		if ( ! current_user_can( 'activate_plugins' ) )
            return;
        check_admin_referer( 'bulk-plugins' );

        if ( __FILE__ != WP_UNINSTALL_PLUGIN )
            return;
	}

	public function buildTableGrid($rows, $cols, $format = 'string') {
		$rows = (int) $rows;
		$cols = (int) $cols;

		$grid[] = '<table>';

		for( $i = 0; $i < $rows; $i++) {
			$head = '';

			if(0 == $i)
				$head = "first-row";

			if($rows-1 == $i)
					$foot = "last-row";

			$grid[] = "<tr class='row-$i $head $foot'>";

			for( $z = 0; $z < $cols; $z++) {
				if(0 == $i)
					$head = "column-header";

				if($rows-1 == $i)
					$foot = "column-footer";					

				$grid[] = "<td class='column-$z block-$i$z $head $foot'>";
				$grid[] = "<input type='text' value='' name='input-$i$z' class='table-input input-$i$z' />";
				$grid[] = '</td>';
			}

			$grid[] = '</tr>';

		}

		$grid[] = '</table>';

		apply_filters( 'simpletables_grid', $grid );

		if( 'string' == $format ) {
			return implode( '', $grid );
		} elseif( 'array' == $format ) {
			return $grid;	
		} else {
			return false;	
		}

	}

	public function addMetaBoxes() {

		add_meta_box( 'simpletables_grid_meta_box', __('Simple Tables', 'simpletables'), array( $this , 'renderTableMetaBox' ), 'post' );
	}

	public function renderTableMetaBox() {

		$grid = self::buildTableGrid(2,2);
		
		return $grid;

	}
}
?>
