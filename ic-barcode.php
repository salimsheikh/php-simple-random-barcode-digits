<?php
/*
Plugin Name: IC Barcode

*/

if(!class_exists('IC_Barcode')){
	class IC_Barcode{
		
		function __construct()
		{
			//add_action('admin_init', array($this, 'admin_init'));
		}
		
		function admin_init()
		{
			global $wpdb;
			$s = "SELECT post_id FROM {$wpdb->postmeta} AS b WHERE b.meta_key = '_barcode'";
			$sql = "SELECT p.ID AS id FROM {$wpdb->posts} AS p ";
			$sql .= " WHERE p.post_type IN ('product','product_variation') ";
			$sql .= " AND p.id NOT IN ($s)";
			
			$items = $wpdb->get_results($sql);
			
			foreach($items as $key => $item){
				$r = rand(100000000,999999999);
				//error_log($r);
				update_post_meta($item->id,'_barcode', $r);
			}
		}
	}
}

$obj = new IC_Barcode();
?>