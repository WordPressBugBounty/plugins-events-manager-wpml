<?php
class EM_WPML_Taxonomies {
	public static function init(){
		add_filter('em_pre_taxonomy_template', 'EM_WPML_Taxonomies::em_pre_taxonomy_template', 10, 2);
		add_filter('em_taxonomy_template', 'EM_WPML_Taxonomies::em_pre_taxonomy_template', 10, 2);
	}
	
	/**
	 * @param EM_Taxonomy_Frontend $frontend_class
	 * @param EM_Taxonomy_Term $tax_class
	 */
	public static function em_pre_taxonomy_template( $frontend_class, $tax_class ){
		if( $frontend_class::get_page_id() ){
			add_action('pre_get_posts', 'EM_WPML_Taxonomies::pre_get_posts', 10, 1);
		}
	}
	
	/**
	 * @param EM_Taxonomy_Frontend $frontend_class
	 * @param EM_Taxonomy_Term $tax_class
	 */
	public static function em_taxonomy_template( $frontend_class, $tax_class ){
		if( $frontend_class::get_page_id() ){
			remove_action('pre_get_posts', 'EM_WPML_Taxonomies::pre_get_posts', 10);
		}
	}
	
	public static function pre_get_posts( $wp_query ){
		$wp_query->query_vars['suppress_filters'] = true;
	}
}
EM_WPML_Taxonomies::init();