<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.PrestonBezant.com
 * @since      1.0.0
 *
 * @package    Rep_lookup
 * @subpackage Rep_lookup/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<script name="KEY">
	var API_KEY = "<?php echo get_option('Rep_lookup')['google_api_key']; ?>";
</script>

<?php echo file_get_contents( plugins_url( '../../templates/lookup-page.html', __FILE__ ) ); ?>


