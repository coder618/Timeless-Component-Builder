=== Render Posts ===
Contributors: coder618
Donate link: https://coder618.github.io
Tags: Component System, Component Builder
Requires at least: 4.6
Tested up to: 5.3.2
Stable tag: 1.0
Requires PHP: 7.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
This plugin will help developer to build solid component.
This plugin based on some wordpress core function like : add_filter , meta box , Custom post type, 
thats why you can consider this plugin is a timeless plugin, because i dont think wordpress going to replace 
this function in the.


== Installation ==
1. Upload the plugin folder to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress.

This plugin do not have any settings page, so after install you just have to active the plugin, thats it.


== Frequently Asked Questions ==

= Is this plugin have any settings page =
No, This plugin currently do not have any settings page. you just have to activated the plugin to use.

= Is this plugin compatible with other builder =
Yes, You can, use this plugin with other builder like : gutenberg, elementor, Composer etc. Because this component render via shortcode


== Screenshots ==
.

== Changelog ==

= 1.0.0 =
* First release.

== Upgrade Notice ==

= 1.0.0 =
First relase.

== How to use == 
== How to Create Component: ==
There are Only 2 step you have to follow to create a component, which is
1. Create Component Fields
2. Create Component Rendering Template (a .php file)

Detail:
Step 1: 
To add a component Field first you have to define a function with any name you want. 
Then you need to add those function in a filter hook name ---- tcb__fileds -----

example:
function banner_fields($arr){	
	$arr['banner'] = [	        
        [
            'type' => 'text',
            'field' => 'title',
            'label' => __('Banner Title', 'tcb'),
			'columns' => '12',
		],		
        [
            'type' => 'textarea',
            'field' => 'detail',
            'label' => __('Banner detail', 'tcb'),
			'columns' => '12',
		],		
    ]
    return $arr;
}
add_filter( 'tcb__fileds', 'banner_fields' );

Step 2: 
Create a template file (.php) at the location " activated-theme/tcb/component-{$component-category}.php"
In the template file you just have to call a function to receive the user input data.
eg: $component_data = tcb_data();
After that all the user provided data will store in the $component_data variable as array.

Now you can use the data as per your application need.

Isn't that simple.






Shortcode : [render-posts]
Available Arguments : 
1. *type = "You Post type " 
1. number = "Posts Per Page" -- if not specify it will inherit from wordpress global posts_per_page option serttings.
1. title = "Section title"
1. detail = "Section Detail"
1. noloadmore = "true" -- Set it if you dont want to show loadmore button

*required field.

eg. [render-posts type="post"]

== Technical documentation ==
How to add Custom Post template.

To make a custom post template you have to crate a php function with a specific name. 
And Your function have to RETURN(NOT echo) the whole markup as a string. This function will have one argument post id.

Function Name: postType_template($post_id) ,
eg: post_template($post_id) , event_template($post_id), member_template($post_id) for post, event and member Post Type.

Example function:
// Template For Post post type.
`
function  post_template($id){
        $c_id = $id; 
        $post_img_url = get_the_post_thumbnail_url($c_id, 'large');
        $title = esc_html(get_the_title($c_id));
        $html = '';
        $html .= '<a href="'.get_permalink($c_id).'" class="default-post-template">';
            if($post_img_url):
                $html .= '<img src="'.$post_img_url.'" alt="'.$title.'">';
            endif;            
            $html .= '<div class="text-section">';
                $html .= '<h3 class="title">'.$title.'</h3>';
                $html .= '<p>'.get_the_excerpt($c_id).'</p>';
            $html .= '</div>';
        $html .= '</a>';
        return $html;
}
`

Your defined  template function will receive a single post id  as its first argument. you can use the id to manupulate/make the posts markup for post/cpt template.
After create the function, you have to Attached/link your created function to function.php or via other plugin so that your created function can be access from any place from the wordpress.


Note : You have to return the markup, you cant echo the markup from the function. It can  cause error.