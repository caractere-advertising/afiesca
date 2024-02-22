<section id="disclaimer_banner">
    <?php 
    $bgBanner = get_field('arriere-plan_banner','options');
    $txtBanner = get_field('texte_banner','options');
    $imgBanner = get_field('image_banner','options');
    $ctaBanner = get_field('cta_banner','options');
    $blue = get_field('fond_bleu');
    ?>

    <div class="container from-left"
        <?php if($bgBanner):?> style="background:url('<?php echo $bgBanner['url'];?>') no-repeat;background-size:cover;"<?php endif;?>>
        <div class="colg">
            <?php if($txtBanner): echo $txtBanner; endif;?>
        </div>
        <div class="cold">
            <?php if($imgBanner):?>
            <img src="<?php echo $imgBanner['url'];?>" alt="<?php echo $imgBanner['title'];?>" />
            <?php endif;?>
            <?php if($ctaBanner):?><span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
                                    <a href="<?php echo $ctaBanner['url'];?>" class="cta bgBlue"><?php echo $ctaBanner['title'];?></a></span><?php endif;?>
        </div>
    </div>
</section>