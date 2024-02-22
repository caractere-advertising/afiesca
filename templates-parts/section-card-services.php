<section id="aboutus">
    <div class="swiper-mobile">
        <div class="swiper-resp">
            <div class="swiper-wrapper">
                <?php if(have_rows('services','options')): 
                        while(have_rows('services','options')): the_row();

                            $img = get_sub_field('background_service');
                            $link = get_sub_field('lien_service');?>

                            <div class="swiper-slide card"
                                style=" background:url(<?php if($img): echo $img['url']; endif;?>) center;background-size:cover;">
                                <a href="<?php if($link):echo $link['url'];endif;?>">
                                    <?php 
                                        $nameService = get_sub_field('nom_service');
                                        
                                        if($nameService):?>
                                            <h4><?php echo $nameService;?></h4>
                                        <?php endif;
                                    ?>
                                </a>
                            </div>
                        <?php endwhile;
                endif;?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="grid">
            <?php if(have_rows('services','options')): 
                while(have_rows('services','options')): the_row();?>
                    <?php 
                    $img = get_sub_field('background_service');
                    $link = get_sub_field('lien_service');?>

                    <?php if($link): ?>
                        <a href="<?php echo $link['url'];?>">
                            <div class="card from-bottom"
                                style="background:url(<?php if($img): echo $img['url']; endif;?>) center;background-size:cover;">
                                <?php 
                                    $nameService = get_sub_field('nom_service');
                                                
                                    if($nameService):?>
                                        <h4><?php echo $nameService;?></h4>
                                    <?php endif;
                                ?>
                            </div>
                        </a>
                    <?php endif;
                endwhile;
            endif;?>
        </div>

        <?php if(is_front_page()):
            get_template_part( 'templates-parts/section-assurance' );
        endif;?>
    </div>
</section>