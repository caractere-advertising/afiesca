<?php 
/* Template Name: Nos-solutions */ 

get_header();
$bg_header = get_field('background');
$blue = get_field('fond_bleu');?>

<?php get_template_part( 'templates-parts/header-nav');?>

<header id="header" style="background:url('<?php echo $bg_header['url'];?>');">
</header>

<section id="aboutus">

    <div class="swiper-mobile">
        <div class="swiper-nos">
            <div class="swiper-wrapper">
                <?php if(have_rows('services','options')): while(have_rows('services','options')): the_row();
                    $img = get_sub_field('background_service');
                    $link = get_sub_field('lien_service');?>

                    <div class="swiper-slide card"
                        style="background:url(<?php if($img): echo $img['url']; endif;?>) center;background-size:cover;">
                        <a href="<?php if($link):echo $link['url'];endif;?>">
                            <h4><?php echo get_sub_field('nom_service');?></h4>
                        </a>
                    </div>

                    <?php endwhile;
                endif;?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="grid">
            <?php if(have_rows('services')): 
                while(have_rows('services')): the_row();

                    $img = get_sub_field('background_service');
                    $link = get_sub_field('lien_service');?>

                    <a href="<?php echo $link['url'];?>">
                        <div class="card from-bottom"
                             style="background:url(<?php if($img): echo $img['url']; endif;?>) center;background-size:cover;">
                            <h4><?php echo get_sub_field('nom_service');?></h4>
                        </div>
                    </a>
                <?php endwhile;
            endif;?>
        </div>
    </div>
</section>

<section id="intro_service">
    <div class="container">
        <?php
            $title_page = get_field('titre_service');
            $subtitle = get_field('subtitle');
            $content_intro = get_field('introduction');
        ?>
        <div class="colg title_nos">
            <h2><?php if($subtitle):   echo $subtitle;   endif;?></h2>
                <?php if($title_page): echo $title_page; endif;?>
        </div>

        <div class="cold">
            <?php if($content_intro): echo $content_intro; endif;?>
        </div>
    </div>
</section>

<section id="presa_product">
    <div class="container">
        <div class="content_service">
            <?php if(have_rows('liste_service')):
                while(have_rows('liste_service')) : the_row();
                    
                $link = get_sub_field('document');
                $icone = get_sub_field('icone');?>

                <a href="<?php if($link): echo $link['url'];endif;?>">
                    <div class="document_ddl">
                        <img src="<?php if($icone) : echo $icone['url']; endif;?>" alt="icone_ddl" />
                        <p><?php if($link): echo $link['title']; endif; ?></p>
                    </div>
                </a>

                <?php endwhile;
            endif;?>
        </div>

        <?php get_template_part( 'templates-parts/line-separator' );?>
        <?php get_template_part( 'templates-parts/section-nosproduits' );?>
        <?php get_template_part( 'templates-parts/line-separator' );?>
    </div>
</section>

<section id="disclaimer_banner">
    <?php 
        $bgBanner  = get_field('arriere-plan_banner','options');
        $txtBanner = get_field('texte_banner','options');
        $imgBanner = get_field('image_banner','options');
        $ctaBanner = get_field('cta_banner','options');
    ?>

    <div class="container" style="background:url('<?php echo $bgBanner['url'];?>') no-repeat;background-size:cover;">
        <div class="colg">
            <?php if($txtBanner): echo $txtBanner;endif;?>
        </div>
        <div class="cold">
            <?php if($img):?><img src="<?php echo $imgBanner['url'];?>" alt="<?php echo $imgBanner['title'];?>" /><?php endif;?>

            <?php if($ctaBanner):?>
                <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
                    <a href="<?php echo $ctaBanner['url'];?>" class="cta bgBlue"><?php echo $ctaBanner['title'];?></a>
                </span>
            <?php endif;?>
        </div>
    </div>
</section>

<section id="confiance">
    <div class="container">
        <div class="table_qualite">
            <?php if(have_rows('qualites','options')) :
                while(have_rows('qualites','options')): the_row();?>
                    <div class="card_qualite">
                        <?php 
                            $img = get_sub_field('icone');
                            $title = get_sub_field('titre');
                            $texte = get_sub_field('description');
                        ?>

                        <?php if($img):?><img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" /><?php endif;
                        if($title):?> <h4><?php echo $title;?></h4><?php endif;
                        if($texte):?> <p><?php echo $texte;?></p><?php endif;?>
                    </div>
                <?php endwhile;
            endif;?>
        </div>

        <?php $clink = get_field('cta_conf','options');
        
        if($clink):?>
            <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
                <a href="<?php echo $clink['url'];?>" class="cta"><?php echo $clink['title'];?></a>
            </span>
        <?php endif;?>
        </div>
    </div>
</section>
<?php get_footer();