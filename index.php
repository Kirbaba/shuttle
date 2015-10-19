<?php
get_header();
?>
<section class="home">
    <?php echo getEnterBox(); ?>
    <div class="home__calendar">
        <?php do_shortcode('[calendar_main]');?>
    </div>
</section>
<?php get_footer(); ?>

