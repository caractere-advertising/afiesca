<?php 
/* Template Name: partenaires */

get_header();

$bg_header = get_field('bg_header');
$titre = get_field('titre');
$surtitre = get_field('surtitre');
$intro = get_field('introduction');
$section_bleue = get_field('section_bleue-infos');
$outro = get_field('outro-infos');

$def = get_field('liste_expli');

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
        <?php $images = get_field('images-card');

        if($images):?>
            <div id="my-interactive-image" style="background:url('<?php echo $images['url'];?>'); width:100%;background-size:contain;"></div>
        <?php endif;?>

        <div class="result">
            <?php 
            if(have_rows('provinces')):
                while(have_rows('provinces')): the_row();
                    $name = get_sub_field('name');
                    $informations = get_sub_field('informations');?>
                       
                    <div class="card">
                        <?php if($name): echo $name;endif;?>
                        <?php if($informations): echo $informations; endif;?>
                    </div>
                <?php endwhile;
            endif;?>

        </div>
    </div>
</section>

<?php get_footer();