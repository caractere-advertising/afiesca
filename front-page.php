<?php get_header();?>

<?php get_template_part( 'templates-parts/header-nav');?>

<section id="hero-container">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper">
            <?php if(have_rows('slides')):
                while(have_rows('slides')) : the_row();?>
                    <?php $bg = get_sub_field('background_image');?>
                    <?php $actif = get_sub_field('actif');?>
                    <?php $cta = get_sub_field('liens');?>

                    <?php if($actif == true ):?>
                    <div class="swiper-slide">
                        <img src="<?php echo $bg['url'];?>" alt="bg_slider" />
                        <div class="content">
                            <?php $sousTitre = get_sub_field('sous-titre');?>
                            <p class="baseline" ><?php if($sousTitre): echo $sousTitre;endif;?></p>
                            <?php 
                                $titre = get_sub_field('titre');
                                $blue = get_field('fond_bleu');

                                if($titre): echo '<span data-swiper-parallax="-300">'.$titre.'</span>'; endif;
                            
                                if($cta):?>
                                    <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>" data-swiper-parallax="-200">
                                        <a href="<?php echo $cta['url'];?>" class="cta"><?php echo $cta['title'];?></a>
                                    </span>
                                <?php endif;?>
                        </div>
                    </div>
                    <?php endif;
                endwhile;
            endif;?>
        </div>

        <div class="swiper-button-prev swiper-button"></div>
        <div class="swiper-button-next swiper-button"></div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-card-services' );?>

<section id="section_nosproduits">
    <div class="container">
        <?php get_template_part( 'templates-parts/section-nosproduits' );?>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-mots-president' );?>
<?php get_template_part( 'templates-parts/section-confiance' );?>

<section id="disclaimer">
    <?php 
        $disbg = get_field('background');
        $title = get_field('titre_disclaimer');
        $disdesc = get_field('description_disclaimer');
        $linkdis = get_field('link_disclaimer');
    ?>

    <div class="container from-bottom">
        <img src="<?php echo $disbg['url'];?>" />
        <div class="box-content from-right">
            <?php echo $title;?>
            <?php echo $disdesc;?>
            <a href="<?php echo $linkdis['url'];?>" class="cta"><?php echo $linkdis['title'];?></a>
        </div>
    </div>
</section>

<section id="statistique">
    <div class="container">

        <div class="col-g">
            <?php $products = get_field('products');

            if(have_rows('produits_frontPage')):
                while(have_rows('produits_frontPage')) : the_row();
                    $icon = get_sub_field('icone_produits');
                    $txt = get_sub_field('texte_produits');

            ?>
            <div class="product_front from-left"><?php
                if($icon):?>
                    <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['title'];?>" />
                <?php endif;
                
                ?><div class="txt"><?php
                if($txt): echo $txt;endif?>
                </div>
            </div><?php

            endwhile;
            endif;?>

        </div>
        <div class="col-d">
            <?php 
            $imgStats = get_field('img_statistique');
            $descStats = get_field('description_stats');
            $dmdOffre = get_field('demandez_une_offre');
            $imgOffre = get_field('img_statistique');?>

            <div class="block_stats">

                <?php if($imgStats):?>
                <img class="from-right" src="<?php echo $imgStats['url'];?>" alt="<?php echo $imgStats['title'];?>" />
                <?php endif;?>

                <span class="from-right">
                    <?php if($descStats): echo $descStats; endif;?>
                </span>
            </div>

            <div class="getOffre from-right">
                <?php if($dmdOffre): echo $dmdOffre; endif;?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('templates-parts/section-cta-contact');?>
<?php get_template_part('templates-parts/disclaimer-banner');?>

<section id="actualites">
    <div class="container columns">
        <div class="intro_actu">
            <div class="col-g">
                <span class="from-left"><?php echo get_field('titre_actus');?></span>
            </div>
            <div class="col-d">
                <span class="from-left"><?php echo get_field('texte_actus');?></span>
            </div>
        </div>
    </div>
    <div class="container">
        
        <div class="grid_articles">
            <?php 
            $args = array(
                    'post_type' => 'post',
                    'posts_per_page'=> 2,
                    'post_statut' => 'publish'
            );

            $query = new WP_Query( $args );

            if($query->have_posts()):
                while($query->have_posts()): $query->the_post();?>
            <div class="card_article from-bottom">
                <?php if ( has_post_thumbnail() ):?>
                <div class="home-thumbnail">
                    <?php the_post_thumbnail();?>
                </div>
                <?php endif;?>
                <h3><?php the_title();?></h3>

                <a href="<?php the_permalink();?>" class="red from-bottom">Découvrir</a>
            </div><?php
                endwhile;
            endif;
            
            wp_reset_postdata();?>
        </div>
        <?php $pageActus = get_field('link_actus','options');?>

        <?php if($pageActus):?>
            <div class="view_more">
                <a href="<?php echo $pageActus['url'];?>" class="cta bgBlue from-bottom"><?php echo $pageActus['title'];?></a>
            </div>
        <?php endif;?>
    </div>
</section>

<?php get_template_part( 'templates-parts/contact' );?>

<?php get_footer();?>