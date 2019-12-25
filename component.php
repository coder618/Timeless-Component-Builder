<?php
/**
 * Plugin Name: Basic Component System
 * Description: Build Basic Component With the help of Piklist
 * Author: coder618
 * Author URI: https://coder618.github.io
 * Version: 1.0.0 
 * Text Domain : basic-component
*/
class Basic_Component_System{

    public function __construct() {
        $this->reg_hooks();
        $this->load_dependencies();
        // $this->register_cpt(); 
        // $this->register_taxonomies();
    }

    /* Register Custom Post Type */
    public function register_CPT() {
        register_post_type( 'bcs_component',
            array(
                'labels' => array(
                    'name' => __( 'Components', 'basic-component' ),
                    'singular_name' => __( 'Component', 'basic-component' )
                ),
                'public' => true,
                'has_archive' => false,
                'publicly_queryable' =>false,
                'show_in_rest' => false,
                'supports' => [ 'title', 'thumbnail', ],
                // 'rewrite' => array('slug' => 'bc_components'),
            )
        );
    }


    ## Register Taxonomy
    public function register_taxonomies() {

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'Component Type', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Component Type', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Component Type', 'textdomain' ),
            'all_items'         => __( 'All Types', 'textdomain' ),            
            'add_new_item'      => __( 'Add New Component Type', 'textdomain' ),
            'new_item_name'     => __( 'New Component Type Name', 'textdomain' ),
            'menu_name'         => __( 'Component Type', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => false,
            // 'rewrite'           => array( 'slug' => 'genre' ),
        );
        register_taxonomy( 'component_type', ['bcs_component'],  $args );
    }

    // this function will register shortcode
    public function register_shortcode($atts=[]) {
        $html = '';
        $func_name = '';
        $id = '';

        if(array_key_exists('cat', $atts) && !empty($atts['cat'])){
            $func_name = 'bcs_component_'.$atts['cat'];
        }else{
            $html .= 'cat value not found in shortcode';
        }

        if(array_key_exists('id', $atts) && !empty($atts['id'])){
            $id = $atts['id'];
        }else{
            $html .= ' ID value not found in shortcode';
        }


        if( empty($func_name) || empty($id)  ){
            return $html;
        }

        if( function_exists( $func_name ) ){
            $html .= $func_name( $id );
        }else{
            $html .= "Function Not Exist, Please define a Function ({$func_name}) and return the markup in html";
        }
        return $html;

    }

    private function load_dependencies() {
		/**
		 * ajax request handler
		 */
        require plugin_dir_path( __FILE__ ) .  'inc/add_categories.php';
        require plugin_dir_path( __FILE__ ) .  'inc/add_metabox.php';
        require plugin_dir_path( __FILE__ ) .  'inc/generate-metabox.php';
        require plugin_dir_path( __FILE__ ) .  'inc/save_metabox.php';

        /**
		 *  shortcode register
		 */
        // require plugin_dir_path( __FILE__ ) .  'inc/register_shortcode.php';
    }


    
    /**
     * All the Hook of this plugin will register/call within this method
     * 
     */
    private function reg_hooks(){
        // add cpt in hook
        add_action( 'init', [ $this, 'register_CPT' ], 1 );
        
        // add taxonomies hook
        add_action( 'init', [ $this, 'register_taxonomies' ], 2 );
        
        // register shortcode
        add_shortcode( 'bcs_component', [ $this , 'register_shortcode' ] );

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
               
        
    }
    /**
     * Enqueue all Necessary assets
     * 
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'bcs_component_style', plugin_dir_url( __FILE__ ). 'dist/bcs-style.css', [], 1, 'all' );
    }   
    
}
new Basic_Component_System();


