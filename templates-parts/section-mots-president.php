    <section id="mot_president">
    <div class="container">
        <div class="columns">
            <div class="col-g">
                <?php $img = get_field('image_nossolutions','options');
                
                if(is_page(318)):
                    $titrePresident = get_field('titre_du_president','options');
                    if($titrePresident): echo $titrePresident; endif;
                endif;
                
                if($img):?>
                    <div class="block_img" <?php if(is_page(318)): echo "style=\"bottom: -200px;\"";endif;?>>
                        <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-left" />
                    </div>
                <?php endif;?>
            </div>
            <div class="col-d from-right">
                <?php 
                $txtPresident = get_field('texte_du_president','options');
                $titrePresident = get_field('titre_du_president','options');
                
                if(!is_page(318)):
                    if($titrePresident): echo $titrePresident; endif;
                endif;
                
                if($txtPresident): echo $txtPresident; endif;
                ?>
            </div>
        </div>
    </div>

    <div class="separator"></div>
</section>