<section id="mot_president">
    <div class="container">
        <div class="columns">
            <div class="col-g">
                <?php $img = get_field('image_nossolutions','options');
                
                if(is_page(318)):
                    $txtPresident = get_field('texte_du_president','options');
                endif;
                
                if($img):?>
                    
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-left" />
                <?php endif;?>
            </div>
            <div class="col-d from-right">
                <?php 
                $txtPresident = get_field('texte_du_president','options');
                
                if(!is_page(318)):
                    if($txtPresident): echo $txtPresident; endif;
                endif;?>
            </div>
        </div>
    </div>

    <div class="separator"></div>
</section>