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

$clients = get_field('provinces');

// Initialisez un tableau vide pour stocker les items
$items = array();
$items_mob = array();
$items_tab = array();

// Parcourez les données des clients
if ($clients) {
    foreach ($clients as $client) {
        $name = $client['nom'];
        $info = $client['informations'];
        $left = $client['coordonnees_left']['desktop'];
        $top = $client['coordonnees_top']['desktop'];

        $taleft = $client['coordonnees_left']['tablet'];
        $tatop = $client['coordonnees_top']['tablet'];
        
        $moleft = $client['coordonnees_left']['mobile'];
        $motop = $client['coordonnees_top']['mobile'];
        
        // Ajoutez un nouvel objet à la tableau items pour chaque client
        $items[] = array(
            'type' => 'text',
            'title' => $name,
            'description' => $info,
            'position' => array(
                'left' => $left,
                'top' => $top
            )
        );

        $items_tab[] = array(
            'type' => 'text',
            'title' => $name,
            'description' => $info,
            'position' => array(
                'left' => $taleft,
                'top' => $tatop
            )
        );

        $items_mob[] = array(
            'type' => 'text',
            'title' => $name,
            'description' => $info,
            'position' => array(
                'left' => $moleft,
                'top' => $motop
            )
        );
    }
}

get_template_part( 'templates-parts/header-nav');?>
<header id="header" style="background:url('<?php echo $bg_url;?>');"></header>


<section id="interactivMap">
    <div class="container">
        <?php $images = get_field('images-map');
        $description = get_field('description');

        if($images):?>
            <div id="my-interactive-image" style="background:url('<?php echo $images['url'];?>'); background-size:contain;background-repeat:no-repeat;background-position:center"></div>
            <div id="my-interactive-image-tablet" style="background:url('<?php echo $images['url'];?>'); background-size:contain;background-repeat:no-repeat;background-position:center"></div>
            <div id="my-interactive-image-mobile" style="background:url('<?php echo $images['url'];?>'); background-size:contain;background-repeat:no-repeat;background-position:center"></div>


            <?php endif;?>

        <div class="result" id="result-account-manager">
            <div class="">
            <?php $subtitle = get_field('surtitre');?>
            <h1 class="subtitle red upp bold"><?php if($subtitle): echo $subtitle; endif;?></h1>
            
            <?php if (have_rows('provinces')) : ?>
                <?php $i = 1;?>
                <?php while (have_rows('provinces')) : the_row(); ?>
                    <div class="card columns" data-index="<?php echo $i;?>">
                        <div class="thumbnails">
                            <?php $img = get_field('photo-am');
                            if($img):?>
                                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'];?>"/>
                            <?php endif;?>
                        </div>

                        <div class="details_am">
                            <?php 
                                $name = get_sub_field('nom');
                                $informations = get_sub_field('informations');
                                $cta = get_sub_field('email');
                                
                                if ($name):
                                    echo $name;
                                endif;
                            ?>

                            <div class="am-content">
                                <?php if ($informations) : ?>
                                    <div class="red upp bold"><?php echo $informations; ?></div>
                                <?php endif; ?>
                                <?php if($cta):?>
                                    <a href="mailto:<?php echo $cta;?>" class="cta cta-border round">Contact par email</a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php $i += 2;?>
                <!-- Incrémenter de 2 pour tenir compte des hotspots et des éléments item suivants -->
                <?php endwhile; ?>
            <?php endif; ?>

            <div class="description">
                <?php if($description): echo $description;endif;?>
            </div>
        </div>
    </div>
</section>

<section id="grayBack">
    <?php get_template_part( 'templates-parts/line-separator');?>
    <?php get_template_part( 'templates-parts/section-nosproduits');?>
    <?php get_template_part( 'templates-parts/line-separator');?>
</section>

<script>
    // Items collection
    $(document).ready(function() {
        var items = <?php echo json_encode($items); ?>;
        var items_tablet = <?php echo json_encode($items_tab);?>;
        var items_mobile = <?php echo json_encode($items_mob);?>;

        var options = {
            allowHtml: true,
            triggerEvent: 'click',
            shareBox: false,
        }
        
        // Plugin activation
    $("#my-interactive-image").interactiveImage(items, options);
    $("#my-interactive-image-tablet").interactiveImage(items_tablet, options);
    $("#my-interactive-image-mobile").interactiveImage(items_mobile, options);

    // Définition de la fonction pour activer la carte
    function activeCard() {
        var index = $(this).index();

        $(".hotspot").css('color','#b52b43')
        $(this).css('color','black');
        
        $('.result .card').hide();
        $('.result .card[data-index="' + index + '"]').show();
        
        $('html, body').animate({
            scrollTop: $('.result .card[data-index="' + index + '"]').offset().top - 150
        }, 700);
    }

    // Gestionnaire d'événements pour afficher les informations du client sur desktop et tablette
    $('#my-interactive-image').on('click', '.hotspot', activeCard);
    $('#my-interactive-image-tablet').on('click', '.hotspot', activeCard);
    $('#my-interactive-image-mobile').on('click', '.hotspot', activeCard);
    

    // Cachez les informations du client lorsqu'on clique en dehors des marqueurs
    $('#map-container').on('click', function(event) {
            if (!$(event.target).closest('.hotspot').length) {
                $('.result .card').hide(); // Masquez toutes les cartes
            }
        });
    });
</script>

<?php get_footer();
