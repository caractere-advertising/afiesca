<?php 
$title = get_field('titre-vosp');
$baseline = get_field('baseline-vosp');

$links = get_field('liens_vosp_copier');

?>

<div class="section_vosp">
    <?php 
    echo '<span class="from-bottom">'. $title . '</span><span class="balls from-bottom"></span><h3 class="from-bottom">'.$baseline.'</span></h3>';
    echo '<div class="list-btn from-bottom">';
    foreach ($links as $link):
        echo '<a href="' . $link->post_guid. '" class="cta-border">' . $link->post_title . '</a>';
    endforeach;?>
    </div>
</div>
