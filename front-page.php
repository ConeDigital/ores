<?php get_header() ; ?>

    <div class="cd-home-swiper-section">
        <div class="swiper-container cd-home-swiper cd-home-swiper-left">
            <div class="swiper-wrapper">
                <?php if( have_rows('hero-swiper-left') ): ?>
                    <?php while( have_rows('hero-swiper-left') ) : the_row();?>
                        <div class="cd-home-swiper-card swiper-slide" style="background-image: url('<?php the_sub_field('hero-swiper-image-left') ; ?>')">
                            <a href="<?php the_sub_field('hero-swiper-link-left') ; ?>"></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="swiper-container cd-home-swiper cd-home-swiper-middle">
            <div class="swiper-wrapper">
                <?php if( have_rows('hero-swiper-middle') ): ?>
                    <?php while( have_rows('hero-swiper-middle') ) : the_row();?>
                        <div class="cd-home-swiper-card swiper-slide" style="background-image: url('<?php the_sub_field('hero-swiper-image-middle') ; ?>')">
                            <a href="<?php the_sub_field('hero-swiper-link-middle') ; ?>"></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="swiper-container cd-home-swiper cd-home-swiper-right">
            <div class="swiper-wrapper">
                <?php if( have_rows('hero-swiper-right') ): ?>
                    <?php while( have_rows('hero-swiper-right') ) : the_row();?>
                        <div class="cd-home-swiper-card swiper-slide" style="background-image: url('<?php the_sub_field('hero-swiper-image-right') ; ?>')">
                            <a href="<?php the_sub_field('hero-swiper-link-right') ; ?>"></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<div class="cd-home-products nm-row">
    <div class="col-xs-12">
        <h2>Featured  piehejehces</h2>
        <?php echo do_shortcode('[vc_row][vc_column][featured_products per_page="12" columns="4" orderby="" order=""][/vc_column][/vc_row]') ; ?>
    </div>
</div>

<?php get_footer() ; ?>
