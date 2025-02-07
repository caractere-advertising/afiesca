<?php 
/* Template Name: simple-page */

get_header();

$subtitle = get_field('subtitle-sm');
$titre = get_field('titre_page');
$intro = get_field('introduction');
$section_bleue = get_field('section_bleue');
$textCta = get_field('texte_cta');
$cta = get_field('cta');
$outro = get_field('outro');

$jobActif     = get_field('actif_listing');
$titroffre    = get_field('titre_offre');
$listings     = get_field('listing_offre');

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

get_template_part( 'templates-parts/header-nav');?>

<header id="header" style="background:url('<?php echo $bg_url;?>');">
</header>

<section id="simple-page">
    <div class="container">
        <div class="colg">
            <div class="intro from-bottom">
                <h2><?php if($subtitle) : echo $subtitle;endif;?></h2>
                <?php if($titre) : echo $titre;endif;?>
            </div>
        </div>
        <div class="cold">
            <div class="intro from-bottom"><?php if($intro) : echo $intro;endif;?></div>
    
            <div class="par_cta">
                <?php if($cta) : echo '<a href="'.$cta['url'].'" class="cta cta-blue">'. $cta['title'] .'</a>';endif;?>
            </div>
        </div>
    </div>
</section>

<?php if($jobActif):
    if(current_user_can('administrator')):?>
        <section id="presa_jobs">
            <div class="container entry-content">
            <?php if($titroffre): echo $titroffre; endif;?>

                <div class="content_service">
                    <?php if($listings):
                        foreach($listings as $job):
                            $permalink = get_permalink( $job->ID );
                            $title = get_the_title( $job->ID );?>

                            
                            <a href="<?php echo $permalink;?>">
                                <div class="document_ddl">
                                    <?php echo '<p>'.$title.'</p>';?>Découvrir
                                </div>
                            </a>
                        <?php endforeach; 
                        wp_reset_postdata();
                    endif;?>
                </div>
            </div>
        </section>
  <?php endif;
endif;?>

<?php if($section_bleue):?>
<section id="section_bleue">
    <div class="container">
        <div class="colg"></div>
        <div class="cold from-right">
            <?php echo $section_bleue;?>
        </div>
    </div>
</section>
<?php endif;?>

<?php if($outro):?>
<section id="outro">
    <div class="container">
        <div class="colg"></div>
        <div class="cold">
            <div class="outro from-right"><?php echo $outro;?></div>
        </div>
    </div>
</section>
<?php endif;?>

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