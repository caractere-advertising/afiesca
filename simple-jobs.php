<?php 
/* Template Name: simple-jobs */

get_header();

$subtitle = get_field('subtitle-sm');
$titre = get_field('titre_page');
$intro = get_field('introduction');
$introJobs = get_field('introduction-jobs');

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

<?php if($jobActif):
    if(current_user_can('administrator')):?>
        <section id="simple-page">
            <div class="container">
                <div class="colg">
                    <div class="intro from-bottom">
                        <h2><?php if($subtitle) : echo $subtitle;endif;?></h2>
                        <?php if($titroffre): echo $titroffre; endif;?>
                    </div>
                </div>
                <div class="content_service">
                    <?php if($introJobs): echo $introJobs;endif;?>
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

<section id="presa_jobs">
    <div class="container">
        <div class="colg">
            <div class="intro from-bottom">
                <?php if($titre) : echo $titre;endif;?>
            </div>
        </div>
        <div class="content_service">
            <div class="intro from-bottom"><?php if($intro) : echo $intro;endif;?></div>
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