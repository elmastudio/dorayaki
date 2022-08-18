<?php
/**
 * The default template for displaying content
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <div class="entry-details">
            <div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
            <div class="entry-author"><span><?php _e('by', 'dorayaki') ?></span>
                <?php
                    printf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'dorayaki' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    sprintf( esc_attr__( 'All posts by %s', 'dorayaki' ), get_the_author() ),
                    get_the_author() );
                ?>
            </div>
            <div class="entry-edit"><?php edit_post_link(__( 'Edit', 'dorayaki') ); ?></div>
            <div class="entry-cats"><?php the_category(); ?></div>
        </div><!--end .entry-details -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dorayaki' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    </header><!--end .entry-header -->

    <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- end .entry-summary -->
 
    <?php else : ?>

    <div class="entry-content clearfix">
        <?php if( has_post_thumbnail ()) : ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
        <?php endif; ?>

        <?php // Show Excerpt via Theme Options
            $options = get_option('dorayaki_theme_options');
        if($options['show-excerpt'] ) : ?>
                <?php the_excerpt(); ?>
        <?php else : ?>
                <?php the_content('<span class="morelink-icon">Read more</span>', 'dorayaki' ); ?>
        <?php endif; ?>

        <?php wp_link_pages(array( 'before' => '<div class="page-link">' . __('Pages:', 'dorayaki'), 'after' => '</div>' )); ?>
    </div><!-- end .entry-content -->

    <?php endif; ?>

    <footer class="entry-meta clearfix">
        <?php if (comments_open() ) : ?>
<div class="entry-comments">
<?php comments_popup_link('<span class="leave-reply">' . __('0 comments', 'dorayaki') . '</span>', __('1 comment', 'dorayaki'), __('% comments', 'dorayaki')); ?>
            </div><!-- .comments-link -->
        <?php endif; // comments_open() ?>
    </footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->