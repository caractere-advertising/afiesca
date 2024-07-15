<section id="confiance">
    <div class="container">

        <?php if(is_front_page( )):
            $titre_conf  = get_field('titre_conf','options');
            $intro_conf  = get_field('introduction_conf','options');  
        ?>
            <span class="from-bottom"><?php if($titre_conf): echo $titre_conf;endif; ?></span>
            <span class="from-bottom"><?php if($intro_conf): echo $intro_conf;endif; ?></span>
        <?php endif;?>

        <div class="table_qualite">
            <?php 
            if(have_rows('qualites','options')) :
                while(have_rows('qualites','options')): the_row();

                    $img = get_sub_field('icone');
                    $title = get_sub_field('titre');
                    $texte = get_sub_field('description');
                    $link = get_sub_field('link');?>

                    <a href="<?php echo $link['url'];?>">
                        <div class="card_qualite from-bottom">
                            <?php if($img):?>
                                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" />
                            <?php endif;?>
                            <?php if($title):?>
                                <h4><?php echo $title;?></h4>
                            <?php endif;?>
                            <?php if($texte):?> 
                                <p><?php echo $texte;?></p>
                            <?php endif;?>
                        </div>
                    </a>
            <?php endwhile;
            endif;?>
        </div>

        <?php 
        $clink = get_field('cta_conf','options');
        $blue = get_field('fond_bleu');?>
        <?php if($clink):?>
            <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
                <a href="<?php echo $clink['url'];?>" class="cta"><?php echo $clink['title'];?></a>
            </span>
        <?php endif;?>
    </div>
</section>