<?php

$template_obj = new C5PB_TEMPLATE();
$template_obj->layout_css();
global $post;



?>
<div id="c5ab-col-count-js" data-col-count="<?php echo C5BP_COLUMNS_COUNT ?>"></div>
<input type="hidden" name="c5ColCount" id="c5ColCount" value="<?php echo C5BP_COLUMNS_COUNT ?>" />
<?php
$c5abShowBuilder = get_post_meta($post->ID, 'c5ab_show_builder', true);
if($c5abShowBuilder == 'True'){
	$c5abShowBuilder = 'nTrue';
}
?>
<input type="hidden" name="c5abShowBuilder" id="c5abShowBuilder" value="<?php echo $c5abShowBuilder ?>" />
<div class="c5ab-panel-container clearfix">

	<div class="c5ab-header-wrap clearfix">
	<div class="float-left">
		<span class="c5ab-load-button c5ab-add-page-template"><i class="fa fa-files-o"></i> <?php esc_html_e('Page Template', 'medical-cure') ?></span>
		<?php /* ?>
		<span class="c5ab-load-button c5ab-load-template c5abf-down-open"><?php esc_html_e('Page Template', 'medical-cure') ?>
			<ul class="c5ab-templates">

			<?php
			foreach (c5_get_ab_templates() as $key => $value) {
				if($key != $post->ID && $value!=''){
				?>
				<li data-id="<?php echo $key ?>"><?php echo $value ?></li>
				<?php
				}
			}
			 ?>
			</ul>

		</span>
		<?php
		*/

		if (isset($_GET['post']) && $_GET['post']!='') {
			$post_id = $_GET['post'];
		}else {
			$post_id = 'NULL';
		}

		 ?>

		<span class="c5ab-load-button c5ab-load-import" data-post-id="<?php echo $post_id; ?>"><i class="fa fa-download" ></i><?php esc_html_e('Import/Export', 'medical-cure') ?></span>


	</div>
	<?php
	/*
	$cache = get_post_meta($post_id , 'c5ab_cache' , true);
	if ($cache == '') {
		$cache = 'off';
	}
	 ?>
	<div class="c5ab-center-div c5ab-cache-wrap c5ab-cache-<?php echo $cache ?>">

		<input type="hidden" name="c5ab_cache" id="c5ab_cache" value="<?php echo $cache ?>" />

		<i class="fa fa-cloud-download c5ab-cache c5ab-cache-off" data-cache="off" title="<?php  esc_html_e('Cache is Disabled. Click to enable cache for this page','medical-cure'); ?>"></i>

		<i class="fa fa-cloud-download c5ab-cache c5ab-cache-on" data-cache="on" title="<?php  esc_html_e('Cache is Enabled. Click to disable cache for this page','medical-cure'); ?>"></i>

	</div>
	<?php */  ?>
	<div class="float-right">
	<?php $tablet = c5ab_get_option('tablet');
	$mobile = c5ab_get_option('mobile');
	if($mobile != 'off' || $tablet != 'off'){
	 ?>
		<ul class="c5ab_view_controls">
			<li><span class="c5ab_desktop c5abf-laptop selected"><?php esc_html_e('Desktop', 'medical-cure');  ?></span></li>
			<?php if($tablet != 'off'){ ?>
			<li><span class="c5ab_tablet  c5abf-tablet"><?php esc_html_e('Tablet', 'medical-cure');  ?></span></li>
			<?php  }
			if ($mobile != 'off') { ?>
			<li><span class="c5ab_phone  c5abf-mobile"><?php esc_html_e('Phone', 'medical-cure');  ?></span></li>
			<?php }  ?>
		</ul>
	<?php
		}
	?>
	</div>
	</div>
	<div class="c5ab-main-panel-wrap clearfix">
		<div id="c5ab-sample-layout">
			<?php
				$sample_obj = new C5PB_LAYOUT();
				$sample_obj->sample_layout();
			 ?>
		</div>

		<div id="c5ab-sample-row">
			<?php
				$sample_row_obj = new C5PB_ROW();
				$sample_row_obj->sample_layout();
			 ?>
		</div>

		<div class="c5ab-control-panel">
			<?php  $template_obj->presets(); ?>
		</div>

		<div class="c5ab-panel-wrap">
			<?php

			$template_obj->ruler();
			?>
			<div id="c5ab-panel-wrap-js" class="c5ab-panel-rows-wrap c5ab-base" data-id="0">

			<?php

			$template = get_post_meta($post->ID, 'c5ab_data', true);

			$saved_col_count =  get_post_meta($post->ID, 'c5ab_col_cout', true);
			if( is_array(@code125_decode( $template) ) ){
				$template = code125_decode( $template  );
				if($saved_col_count != C5BP_COLUMNS_COUNT){
					$template = $this->validate_col_grid($template, $saved_col_count );
				}

				foreach ($template as $row) {

				    $obj = new C5PB_ROW();
				    $obj->set_options($row);
				    $obj->html();
				}

			}else {
				?>
				<div class="c5ab-quick-tour"><span class="c5btn c5ab-launch-video" data-video="FPoO527BBNk"><?php  esc_html_e('Quick tour', 'medical-cure'); ?></span></div>
				<?php
			}

			?>

			</div>
			<div class="c5ab-add-quick-template"><span class="fa fa-plus"></span> Ready to use content blocks</div>
			<?php

			$template_obj->grid();
			 ?>
		</div>

	</div>
</div>

<?php
// create hidden fake editor
echo '<div id="c5_sample_wp_editor_id" style="display:none" >';
    wp_editor('', 'c5_sample_wp_editor');
echo '</div>';
?>

<script type="text/javascript">
/* save config object as json string in a global var - in my case et_tinyMCEPreInit  */
jQuery(document).ready(function(e) {
    if(typeof( et_tinyMCEPreInit ) == 'undefined') {
        et_tinyMCEPreInit = JSON.stringify(tinyMCEPreInit);
    }
});
</script>
