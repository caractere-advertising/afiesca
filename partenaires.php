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

// Parcourez les données des clients
if ($clients) {
    foreach ($clients as $client) {
        $name = $client['nom'];
        $info = $client['informations'];
        $left = $client['position_left'];
        $top = $client['position_top'];
        
        // Ajoutez un nouvel objet à la tableau items pour chaque client
        $items[] = array(
            'type' => 'text',
            'title' => $name,
            'description' => $info,
            'position' => array(
                'left' => $left,
                'top' => $top
            ),
            'customClassName' => "my-custom-css-class"
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
        <?php endif;?>

        <div class="result" id="result-account-manager">
            <h1 class="subtitle red upp bold">Votre account manager</h1>
            
            <?php if (have_rows('provinces')) : ?>
                <?php while (have_rows('provinces')) : the_row(); ?>
                    <div class="card">
                        <?php $name = get_sub_field('nom'); ?>
                        <?php $informations = get_sub_field('informations'); ?>
                        <?php $cta = get_sub_field('email');?>
                        <?php if ($name) : ?>
                            <?php echo $name; ?>
                        <?php endif; ?>

                        <div class="am-content">
                            <?php if ($informations) : ?>
                                <div class="red upp bold"><?php echo $informations; ?></div>
                            <?php endif; ?>
                            <?php if($cta):?>
                                <a href="mailto:<?php echo $cta;?>" class="cta cta-border round">Contact par email</a>
                            <?php endif;?>
                        </div>
                    </div>
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

        var options = {
            allowHtml: true,
            triggerEvent: 'click',
            shareBox: false,
        }
        
        // Plugin activation
    $("#my-interactive-image").interactiveImage(items, options);

// Gestionnaire d'événements pour afficher les informations du client
$('#my-interactive-image').on('click', '.interactive-point', function() {
    var index = $(this).index();
    $('.result .card').eq(index).show();
});

// Cachez les informations du client lorsqu'on clique en dehors des marqueurs
$('#map-container').on('click', function(event) {
    if (!$(event.target).closest('.interactive-point').length) {
        $('.result .card').hide();
    }
});
    });
</script>

<?php get_footer();
