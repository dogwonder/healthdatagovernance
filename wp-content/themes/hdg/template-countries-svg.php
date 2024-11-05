<?php
/**
 * Template Name: Country snapshots - SVG
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

get_header();

global $post;
$paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$numberposts = '-1';

$post_args = array(
	'post_type'      => 'country',
	'posts_per_page' => $numberposts,
	'post_status'    => 'publish'
);

$country_query = new WP_Query( $post_args );

// Create an array to store the country data
$country_data = array();

if ( $country_query->have_posts() ) :
    while ( $country_query->have_posts() ) :
        $country_query->the_post();
        $iso_code = strtolower(get_post_meta(get_the_ID(), 'iso_code', true));
		$coordinates = get_field('coordinates', get_the_ID());
		$latitude = $coordinates['latitude'] ?? '';
		$longitude = $coordinates['longitude'] ?? '';
        $country_data[] = array(
            'title' => get_the_title(),
            'link' => get_permalink(),
            'iso_code' => $iso_code, 
			'latitude' => $latitude,
			'longitude' => $longitude
        );
    endwhile;
endif;

// Convert the PHP array to a JSON object
$country_data_json = json_encode($country_data);
// print_r($country_data_json);
?>
<div id="primary" class="hdg-content-wrapper">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/_templates/content', 'page' );
	endwhile; // End of the loop.
	?>
	<?php if ( $country_query->have_posts() ) : ?>
		<div class="entry-content">
		<?php
		while ( $country_query->have_posts() ) :
			$country_query->the_post();
			$iso_code = get_field('iso_code') ?? '';
			?>
			<div class="hdg-country" data-iso-code="<?php echo esc_html(strtolower($iso_code)) ?>">
			<?php 
			if ($iso_code) {
				echo '<span class="hdg-country__iso">' . esc_html($iso_code) . '</span>';
			}
			echo the_title();
			?>
			</div>
		<?php endwhile; // End of the loop.
		endif; ?>
		</div>

		<div x-data="modalHandler()" @keydown.escape.window="closeModal()">

			<div id="map-container" class="map-container">
			<?php 
				//https://github.com/ahuseyn/SVG-World-Map-with-labels?tab=readme-ov-file
				get_template_part( 'template-parts/_molecules/countries');
			?>
			<!-- Modal Overlay -->
			<div
				class="modal-overlay"
				:class="{ 'active': isOpen }"
				@click="closeModal()"
			>
				<!-- Modal Content -->
				<div class="modal" @click.stop>
					<div class="modal-header">
						<h2 x-text="modalData.name"></h2>
						<button class="close-button" @click="closeModal()">&times;</button>
					</div>
					<div class="modal-body">
						<a :href="modalData.link" target="_blank">Visit Website</a>
					</div>
				</div>
			</div>

		</div>

		
		<?php wp_reset_postdata(); ?>
		<?php wp_reset_query(); ?>	
</div>
<script>
	function modalHandler() {
        return {
            isOpen: false,
            modalData: {
                name: '',
                description: '',
                link: '#'
            },
            openModal(data) {
                this.modalData = data;
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
            },
            init() {
    // Parse the JSON object from PHP
    const countryData = <?php echo $country_data_json; ?>;
    console.log(countryData);

    countryData.forEach(country => {
        const isoCode = country.iso_code;
        const latitude = country.latitude; // Assuming latitude is provided in the country data
        const longitude = country.longitude; // Assuming longitude is provided in the country data

        if (isoCode && latitude && longitude) {
            const svgElement = document.querySelector(`.landxx.${isoCode}`);

            if (svgElement) {
				
                svgElement.classList.add('active');

                // Get the bounding box of the SVG element
                const bbox = svgElement.getBBox();

                // Calculate the position for the circle dot based on latitude and longitude
                const cx = bbox.x + (bbox.width * (longitude + 180) / 360);
                const cy = bbox.y + (bbox.height * (90 - latitude) / 180);

                // Create a circle dot
                const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                const radius = 20; // Adjust the radius as needed

                // Offset the cx and cy by the radius to center the circle correctly
                circle.setAttribute('cx', cx + radius); // Set the calculated x position with offset
                circle.setAttribute('cy', cy + radius); // Set the calculated y position with offset
                circle.setAttribute('r', radius); // Set the radius
                circle.setAttribute('fill', 'red'); // Adjust the color as needed
                circle.classList.add('active-dot');

                // Append the circle to the parent of the svgElement to ensure it appears above
                // svgElement.parentNode.appendChild(circle);

                // Add hover effects (optional)
                svgElement.addEventListener('mouseover', () => {
                    svgElement.classList.add('highlight');
                });
                svgElement.addEventListener('mouseout', () => {
                    svgElement.classList.remove('highlight');
                });

                // Add click event to open modal
                svgElement.addEventListener('click', (event) => {
                    event.preventDefault();
                    // You can enhance this with more data as needed
                    const data = {
                        name: country.title || 'No Name',
                        link: country.link || '#'
                    };
                    this.openModal(data);
                });
            }
        }
    });
}
        }
    }
	window.addEventListener('DOMContentLoaded', () => {
		modalHandler().init();
	});
</script>


<?php
get_footer();
