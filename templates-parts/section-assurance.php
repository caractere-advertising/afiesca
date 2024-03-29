<?php $color_bg = get_field('arriere_plan-color');$blue = get_field('fond_bleu');?>

<div class="main-content" <?php if($color_bg): echo $color_bg ? "style='background:#f7f8f9;'" : '';endif;?>>
    <div class="col-g">
        <?php 
        $img = get_field('image_about','options');
        $intro = get_field('introduction','options');
        $txtApropos = get_field('texte_apropos','options');
                
        if($intro): echo '<span class="from-bottom">' . $intro . '</span>';endif?>
        <?php if($img):?>
            <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-bottom" />
        <?php endif;?>
    </div>
    <div class="col-d">
        <?php if($txtApropos): echo '<span class="from-bottom">' . $txtApropos . '</span>'; endif?>
        <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
            <?php if(is_page(318)) :
                $btn = get_field('cta-contact');
            ?>
                <a href="<?php if($btn) : echo $btn['url'];?>" class="cta from-bottom"><?php echo $btn['title']; endif;?></a>
            <?php else :
                $btn = get_field('lien_about','options');
            ?>
                <a href="<?php if($btn) : echo  $btn['url'];?>" class="cta from-bottom"><?php echo $btn['title']; endif;?></a>
            <?php endif;?>
        </span>
    </div>
</div>