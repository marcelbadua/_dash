<?php
/**
 * Adds A Site Information Widget.
 *
 * @package _dash
 */
class SITE_INFORMATION extends WP_Widget
{
    private $_meta = array(
        array('dsi_address', 'textarea', 'Address'), 
        array('dsi_description', 'textarea', 'Description'), 
        array('dsi_email', 'email', 'Email'),
        array('dsi_phone', 'tel', 'Phone'),          
        array('dsi_fax', 'tel', 'Fax'), 
        array('dsi_mobile', 'tel', 'Mobile'), 
        array('dsi_linkedin', 'url', 'Linkedin'), 
        array('dsi_facebook', 'url', 'Facebook'), 
        array('dsi_twitter', 'url', 'Twitter'), 
        array('dsi_instagram', 'url', 'Instagram'), 
        array('dsi_google_plus', 'url', 'Google +'),
        array('dsi_youtube', 'url', 'Youtube'),
    );
    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'site_information',
            __('Site Information', '_dash'), 

            array (
                'description' => __( 'Add site information.' )
            )
        );
        add_action('admin_init', array(&$this, 'admin_init'));
        add_action('admin_menu', array(&$this, 'add_menu'));
    }
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        foreach ($this->_meta as $field_name):
            if ('on' == $instance[$field_name[0]]):
                if (get_option($field_name[0])): ?>
                    <div class="<?php echo $field_name[0];?>">
                        <?php 
                        switch ($field_name[1]) {
                            case "tel":
                                printf('<a href="tel:%s"><span>%s</span></a>', get_option($field_name[0]),get_option($field_name[0]));
                                break;
                            case "email":
                                printf('<a href="mailto:%s"><span>%s</span></a>', get_option($field_name[0]),get_option($field_name[0]));
                                break;
                            case "url":
                                printf('<a href="%s" target="blank"><span>%s</span></a>', get_option($field_name[0]),get_option($field_name[0]));
                                break;
                            default:
                                echo get_option($field_name[0]);
                        }
                        ?></div>
            <?php
                endif;
            endif;
        endforeach;
        echo $args['after_widget'];
    }
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $defaults = array(
            'title' => __('About Us', '_dash')
        );
        $instance = wp_parse_args(( array ) $instance, $defaults); ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', '_dash'); ?></label><input class="widefat"  id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']);?>" /></p>
        <?php
        foreach ($this->_meta as $field_name): ?>
            <p><input class="checkbox" type="checkbox" <?php @checked($instance[$field_name[0]], 'on'); ?> id="<?php echo $this->get_field_id($field_name[0]); ?>" name="<?php echo $this->get_field_name($field_name[0]); ?>" />
            <label for="<?php echo $this->get_field_id($field_name[0]); ?>"><?php _e($field_name[2], '_dash'); ?></label></p>
        <?php
        endforeach; 
    }
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        foreach ($this->_meta as $field_name):
            $instance[$field_name[0]] = $new_instance[$field_name[0]];
        endforeach;
        return $instance;
    }
    

    /**
    *

    **/

    /**
     * hook into WP's admin_init action hook
     */
    public function admin_init()
    {
        // register your plugin's settings
        
        // add your settings section
        add_settings_section(
            'site_information-section', 
            'Site Information', 
             array(&$this, 'settings_section_wp_plugin_template'), 
            'site_information'
        );

        foreach ($this->_meta as $field_name):

            register_setting('site_information-group', $field_name[0]);

            add_settings_field(
                'site_information-' . $field_name[0], 
                $field_name[2], 
                array(&$this, 'settings_field_input_text'), 
                'site_information', 
                'site_information-section',
                array(
                    'field' => $field_name[0],
                    'type'  => $field_name[1]
                )
            );

        endforeach;
        
        // Possibly do additional admin_init tasks
    } // END public static function activate
    

    public function settings_section_wp_plugin_template()
    {
        // Think of this as help text for the section.
        echo 'Enter site information here.';
    }
    /**
     * This function provides text inputs for settings fields
     */
    public function settings_field_input_text($args)
    {
        // Get the field name from the $args array
        $field = $args['field'];
        $type = $args['type'];
        // Get the value of this setting
        $value = get_option($field);
        // echo a proper input type="text"

        if ($type === 'textarea') {
            echo sprintf('<textarea id="%s" name="%s" rows="5" cols="50">%s</textarea>', $field, $field, $value);  
        } else {
            echo sprintf('<input type="%s" name="%s" id="%s" value="%s" />', $type,$field, $field, $value);
        }
        
        
    } // END public function settings_field_input_text($args)
    
    /**
     * add a menu
     */     
    public function add_menu()
    {
        // Add a page to manage this plugin's settings
        add_options_page(
            'Site Information', 
            'Site Information', 
            'manage_options', 
            'site_information', 
            array(&$this, 'plugin_settings_page')
        );
    } // END public function add_menu()

    /**
     * Menu Callback
     */     
    public function plugin_settings_page()
    {
        if(!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        ?>
        <div class="wrap">
            <h2>Site Information</h2>
            <form method="post" action="options.php"> 
                <?php @settings_fields('site_information-group'); ?>
                <?php @do_settings_fields('site_information-group'); ?>

                <?php do_settings_sections('site_information'); ?>

                <?php @submit_button(); ?>
            </form>
        </div>
        <?php
    } // END public function plugin_settings_page()

}
// class SITE_INFORMATION
// register SITE_INFORMATION widget
function register_site_information()
{
    register_widget('SITE_INFORMATION');
}
add_action('widgets_init', 'register_site_information');
