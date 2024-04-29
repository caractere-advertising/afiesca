<?php 
/* Template Name: partenaires */

get_header();

$bg_header = get_field('bg_header');
$titre = get_field('titre');
$surtitre = get_field('surtitre');
$intro = get_field('introduction');


if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;


get_template_part( 'templates-parts/header-nav');?>
<header id="header" style="background:url('<?php echo $bg_url;?>');"></header>


<section id="interactivMap">
    <div class="container">
        <?php $images = get_field('images-map');

        if($images):?>
            <div id="my-interactive-image" style="background:url('<?php echo $images['url'];?>'); width:100%;background-size:contain;height:700px;background-repeat:no-repeat;background-position:center"></div>
        <?php endif;?>

        <div class="result">
            <?php 
            if(have_rows('provinces')):
                while(have_rows('provinces')): the_row();
                    $name = get_sub_field('nom');
                    $informations = get_sub_field('informations');?>
                       
                    <div class="card">
                        <?php if($name): echo $name;endif;?>
                        <?php if($informations): echo $informations; endif;?>
                    </div>
                <?php endwhile;
            endif;?>

        </div>
    </div>
</section>

<script>
// Items collection
var items = [
    <?php
    if(have_rows('provinces')):
        while(have_rows('provinces')): the_row();
            $name = get_sub_field('nom');
            $informations = get_sub_field('informations');
            $left = get_sub_field('position_left');
            $top = get_sub_field('position_top');?>
                   
            {
                type: "text",
                title: "<?php echo $name;?>",
                description: "<?php echo strip_tags($informations);?>",
                position: {
                    left: <?php echo $left;?>,
                    top: <?php echo $top;?>
                }
            }
        <?php endwhile;
    endif;?>
  ];

  var options = {
    allowHtml: true
  }
  
  // Plugin activation
  $(document).ready(function() {
    $("#my-interactive-image").interactiveImage(items,options);
  });

</script>

<?php get_footer();