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

        if($images):?>
            <div id="my-interactive-image" style="background:url('<?php echo $images['url'];?>'); width:100%;background-size:contain;height:700px;background-repeat:no-repeat;background-position:center"></div>
        <?php endif;?>

        <div class="result">
            <h1 class="subtitle red upp bold">Votre account manager</h1>
            
            <?php if (have_rows('provinces')) : ?>
                <?php while (have_rows('provinces')) : the_row(); ?>
                    <div class="card">
                        <?php $name = get_sub_field('nom'); ?>
                        <?php $informations = get_sub_field('informations'); ?>
                        <?php $cta = get_sub_field('email');?>
                        <?php if ($name) : ?>
                            <h3>Pour <strong><?php echo $name; ?></strong></h3>
                        <?php endif; ?>
                        <?php if ($informations) : ?>
                            <div class="description red upp bold"><?php echo $informations; ?></div>
                        <?php endif; ?>
                        <?php if($cta):?>
                            <a href="mailto:<?php echo $cta;?>" class="cta cta-border round">Contact par email</a>
                        <?php endif;?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
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
            var clientInfo = items[index];
            $('#client-info').html('<h3>' + clientInfo.title + '</h3><p>' + clientInfo.description + '</p>').show();
        });

        // Cachez les informations du client lorsqu'on clique en dehors des marqueurs
        $('#map-container').on('click', function(event) {
            if (!$(event.target).closest('.interactive-point').length) {
                $('#client-info').hide();
            }
        });
    });
</script>

<?php get_footer();
