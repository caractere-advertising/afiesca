<?php

/*
Template Name: Jobs
Template Post Type: Jobs, Job, job, jobs, 
*/

get_header();

$titre        = get_field('titre');
$content      = get_field('contenu');

$image        = get_field('image'); 
$cta          = get_field('cta');

$titroffre    = get_field('titre_offre');
$contentOffre = get_field('contenu_offre');

$contact      = get_field('contact');

$bg_header = get_field('image');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('image');
    $bg_url = $bg_header['url'];
endif;

get_template_part( 'templates-parts/header-nav');?>

<header id="header" style="background:url('<?php echo $bg_url;?>');"></header>

<section id="simple-page">
    <div class="container">
        <div class="colg">
            <div class="intro from-bottom">
                <?php if($titre) : echo $titre;endif;?>
            </div>
        </div>
        <div class="cold">
            <div class="intro from-bottom"><?php if($content) : echo $content;endif;?></div>
        </div>
    </div>
</section>

<section id="section_bleue">
    <div class="container">
        <div class="cold from-right">
            <div class="title titlelvl2">
                <?php if($titroffre): echo $titroffre; endif;?>
            </div>
            <div class="content entry-content content-listing">
                <?php if($contentOffre): echo $contentOffre; endif;?> 
            </div>
        </div>
    </div>
</section>

<section id="outro">
    <div class="container">
        <div class="colg">
            <h2><?php echo "Vous souhaitez"; ?></br><strong><?php echo "postuler ?";?></strong></h2>
        </div>
        
        <div class="cold">
            <?php if($contact): echo $contact; endif;?>
        </div>
    </div>
</section>


<?php 
$title_vosp = get_field('titre-vosp');

if($title_vosp):
    get_template_part( 'templates-parts/line-separator' );
    get_template_part( 'templates-parts/section-nosproduits' );
    get_template_part( 'templates-parts/line-separator' );
endif;?>

<?php get_template_part('templates-parts/disclaimer-banner');?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<?php get_footer();

