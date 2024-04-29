<?php 
/* Template Name: partenaires */

get_header();

$bg_header = get_field('bg_header');
$titre = get_field('titre');
$surtitre = get_field('surtitre');
$intro = get_field('introduction');


if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

get_template_part( 'templates-parts/header-nav');?>
<header id="header" style="background:url('<?php echo $bg_url;?>');"></header>


<section id="interactivMap">
    <div class="container">
        <?php $images = get_field('images-map');?>

        
            <div id="my-interactive-image" <?php if($images):?> style="background:url('<?php echo $images['url'];?>'); width:100%;background-size:contain;height:700px;background-repeat:no-repeat;background-position:center"<?php endif;?>></div>
        

        <div class="result">
            <?php if (have_rows('provinces')) : ?>
                <?php while (have_rows('provinces')) : the_row(); ?>
                    <div class="card">
                        <?php $name = get_sub_field('nom'); ?>
                        <?php $informations = get_sub_field('informations'); ?>
                        <?php if ($name) : ?>
                            <h3><?php echo $name; ?></h3>
                        <?php endif; ?>
                        <?php if ($informations) : ?>
                            <div class="description"><?php echo $informations; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer();