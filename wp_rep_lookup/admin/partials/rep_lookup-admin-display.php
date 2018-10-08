<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.PrestonBezant.com
 * @since      1.0.0
 *
 * @package    Rep_lookup
 * @subpackage Rep_lookup/admin/partials
 */
?>

<div class="wrap">

<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
<form method="post" name="rep_lookup_options" action="options.php">
	 <?php
        //Grab all options
        $options = get_option($this->plugin_name);
        

        // Cleanup
        $google_api_key = $options['google_api_key'];
      
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

    

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h2><?php esc_attr_e( 'Settings', 'Rep Lookup' ); ?></h2>
<?php settings_fields($this->plugin_name); ?>


<fieldset>
	<legend class="screen-reader-text"><span><?php _e('Add API key for Google Maps', $this->plugin_name); ?></span></legend>
	<label for="<?php echo $this->plugin_name; ?>-google_api_key">Google Maps Api Key</label>
	<input type="text" id="<?php echo $this->plugin_name; ?>-google_api_key" name="<?php echo $this->plugin_name; ?>[google_api_key]" value="<?php if(!empty($google_api_key)) echo $google_api_key; else echo 'AIzaSyDoZS07ZPfGy8HYYYwIvYE2Pa_Is0mCFZI'?>" class="regular-text" /><br>   
</fieldset>

<!-- <fieldset>
    <legend class="screen-reader-text"><span><?php _e('Load jQuery from CDN instead of the basic wordpress script', $this->plugin_name); ?></span></legend>
    <label for="<?php echo $this->plugin_name; ?>-jquery_cdn">
        <input type="checkbox"  id="<?php echo $this->plugin_name; ?>-jquery_cdn" name="<?php echo $this->plugin_name; ?>[jquery_cdn]" value="1" <?php checked($jquery_cdn,1); ?>/>
        <span><?php esc_attr_e('Load jQuery from CDN', $this->plugin_name); ?></span>
    </label>
    <fieldset>
        <p>You can choose your own cdn provider and jQuery version(default will be Google Cdn and version 1.11.1)-Recommended CDN are <a href="https://cdnjs.com/libraries/jquery">CDNjs</a>, <a href="https://code.jquery.com/jquery/">jQuery official CDN</a>, <a href="https://developers.google.com/speed/libraries/#jquery">Google CDN</a> and <a href="http://www.asp.net/ajax/cdn#jQuery_Releases_on_the_CDN_0">Microsoft CDN</a></p>

        <legend class="screen-reader-text"><span><?php _e('Choose your prefered cdn provider', $this->plugin_name); ?></span></legend>
        <input type="url" class="regular-text" id="<?php echo $this->plugin_name; ?>-cdn_provider" name="<?php echo $this->plugin_name; ?>[cdn_provider]" value="<?php if(!empty($cdn_provider)) echo $cdn_provider; ?>"/>
    </fieldset>
</fieldset> -->

<?php submit_button('Save all changes', 'primary','submit', TRUE); ?>


</form>
</div><!-- end .wrap -->