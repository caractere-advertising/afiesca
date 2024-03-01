<?php 
$title = get_field('titre-vosp');
$baseline = get_field('baseline-vosp');

$links = get_field('liens_vosp');
$blue = get_field('fond_bleu');
?>

<div class="section_vosp from-bottom">
    <?php 
    if($title && $baseline): echo '<span class="from-bottom">'. $title . '</span><span class="balls from-bottom"></span><h3 class="from-bottom">'.$baseline.'</span></h3>';endif;
    echo '<div class="list-btn from-bottom">';
    if($links):
        foreach ($links as $link):?>
            <span class="cta-item<?php echo $blue == true ? '' : '-blue';?>">
                <a href="<?php echo $link->guid;?>" class="cta cta-border from-bottom"><?php echo $link->post_title;?></a>
            </span>
        <?php endforeach;
    endif;?>
</div>
</div>