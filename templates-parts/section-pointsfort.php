<?php 
    $title_ptsfort = get_field('titre_point_fort');
    ?>


<div class="content_service">
    <?php if($title_ptsfort): echo $title_ptsfort;endif;

    if(have_rows('liste_points_forts')):
        while(have_rows('liste_points_forts')) : the_row();
        
        $titres_pf = get_sub_field('titres_pf');
        $descr_pf = get_sub_field('description_pf');
        ?>

    <div class="card_pf from-bottom">
        <?php if($titres_pf):?><h4><?php echo $titres_pf ;?></h4><?php endif;?>
        <?php if($descr_pf): echo $descr_pf; endif;?>
    </div>
    <?php 

        endwhile;
    endif;

    if(have_rows('liste_documents')):
        while(have_rows('liste_documents')) : the_row();
        
        $document = get_sub_field('document');
        $liens = get_sub_field('liens');
        $libelle = get_sub_field('libelle');?>

    <?php if($document):?>
        <a href="<?php echo $document['url'];?>" target="_blank" class="from-left">
            <div class="document_ddl">
                <img src="<?php echo get_template_directory_uri(  );?>/assets/img/icone_pdf.svg" alt="icone_ddl" />
                <p><?php echo $libelle;?></p>
            </div>
        </a><?php 
    elseif($liens):?>
        <a href="<?php echo $liens['url'];?>" target="_blank" class="from-left">
            <div class="document_ddl">
                <img src="<?php echo get_template_directory_uri(  );?>/assets/img/icone_pdf.svg" alt="icone_ddl" />
                <p><?php echo $libelle;?></p>
            </div>
        </a><?php 
    endif;
endwhile;
endif;?>
</div>