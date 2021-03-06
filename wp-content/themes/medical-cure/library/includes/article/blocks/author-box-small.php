<?php
/*
todo: add option into theme options to show/hide author box
todo: validate the option here
*/

$settings_obj = new C5_theme_options();
$enable_article_author = $settings_obj->get_meta_option('enable_article_author','on');


$user_id = get_the_author_meta( 'ID');
$author_data = new CODE125_AUTHOR_DATA($user_id);
$icons = $author_data->get_social_icons();
$avatar = get_avatar( $user_id, 50 );
$author_posts_url = get_author_posts_url( $user_id );
$display_name = get_the_author_meta( 'display_name');
$description = get_the_author_meta( 'description');
?>

<div class="code125-article-author-info">
  <div class="code125-author-avatar"><a href="<?php echo esc_url($author_posts_url);?>"><?php echo $avatar; ?></a></div>
  <div class="code125-author-info">
    <a class="code125-author-name" href="<?php echo esc_url($author_posts_url);?>"><span><?php echo esc_html__('by','medical-cure');?></span><p><?php echo $display_name;?></p></a>
  </div>
  <div class="code125-author-meta">
    <?php get_template_part( C5_ARTICLES_TEMPLATE  . 'blocks/meta-date' ); ?>
    <?php get_template_part( C5_ARTICLES_TEMPLATE  . 'blocks/meta-comment' ); ?>
  </div>
</div>
