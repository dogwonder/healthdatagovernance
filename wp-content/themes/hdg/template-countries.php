<?php
/**
 * Template Name: Country snapshots
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

	// $coordinates = get_field('coordinates', get_the_ID());
	// Use wp_remote_get to fetch the JSON file
	$countriesData = wp_remote_get(get_template_directory_uri() . '/src/utils/countries.json');
	
	if (is_wp_error($countriesData)) {
		// Handle error
		$countriesJSON = '[]';
	} else {
		$countries = wp_remote_retrieve_body($countriesData);
		$countriesJSON = json_decode($countries, true);
	}
	// print_r($countriesJSON);

	// Create a lookup table for latitude and longitude based on iso-alpha-2 code
    $coordinatesLookup = [];
    foreach ($countriesJSON as $country) {
        $isoAlpha2 = trim($country['iso-alpha-2'], ' "');
        $coordinatesLookup[$isoAlpha2] = [
            'latitude' => trim($country['latitude'], ' "'),
            'longitude' => trim($country['longitude'], ' "')
        ];
    }

	// print_r($coordinatesLookup);

    while ( $country_query->have_posts() ) :

        $country_query->the_post();

        $iso_code_lower = strtolower(get_post_meta(get_the_ID(), 'iso_code', true));
		$iso_code = get_post_meta(get_the_ID(), 'iso_code', true);

		$report = get_field('report', get_the_ID());
		
		// $coordinates = get_field('coordinates', get_the_ID());
		// $latitude = $coordinates['latitude'] ?? '';
		// $longitude = $coordinates['longitude'] ?? '';

		// Get the latitude and longitude from the lookup table
        $latitude = $coordinatesLookup[$iso_code]['latitude'] ?? '';
        $longitude = $coordinatesLookup[$iso_code]['longitude'] ?? '';

		$region_terms = get_the_terms(get_the_ID(), 'region');
		$default_region = array(
			(object) array(
				'term_id' => 0,
				'name' => 'Default Region',
				'slug' => 'default',
				'term_group' => 0,
				'term_taxonomy_id' => 0,
				'taxonomy' => 'region',
				'description' => '',
				'parent' => 0,
				'count' => 0,
				'filter' => 'raw'
			)
		);

		// If no region is assigned, use the default region
		$region = (!empty($region_terms) && is_array($region_terms)) ? $region_terms : $default_region;
		
        $country_data[] = array(
            'title' => get_the_title(),
			'content' => get_the_content(),
            'link' => get_permalink(),
			'tags' => get_the_tags(),
            'iso_code' => $iso_code, 
			'report' => $report,
			'latitude' => $latitude,
			'longitude' => $longitude, 
			'region' => $region // Include the term slug for the region
        );

		
    endwhile;
endif;

// Convert the PHP array to a JSON object
$country_data_json = json_encode($country_data);
// print_r($country_data_json);
?>
<div id="primary" class="hdg-content-wrapper">

		<!-- Leaflet CSS -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
		<!-- Leaflet JavaScript -->
		<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
	
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/_templates/content', 'page' );
		endwhile; // End of the loop.
		?>

<script>
// Initialize the map and set its view to the world
const map = L.map('map').setView([20, 0], 3);

const colors = {
	'asia': '#4d8b74',
	'africa': '#4b4cee',
	'america': '#6025a3',
	'europe': '#d9a4f0',
	'oceania': '#d38420'
};
// const map = L.map('map').setView([53, 12], 5);

// Add a tile layer (OpenStreetMap tiles)
// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
// 	attribution: '&copy; OpenStreetMap contributors'
// }).addTo(map);

// Add a tile layer using locally sourced images
L.tileLayer('<?php echo get_template_directory_uri(); ?>/src/map/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 18,
    tileSize: 256,
    zoomOffset: 0
}).addTo(map);

// Define the bounds for the image overlay
// const imageUrl = '<?php echo get_template_directory_uri(); ?>/src/images/world.png'; // Replace with your PNG path
// const imageBounds = [[-90, -180], [90, 180]]; // Bottom left and top right corners

// // Add the image overlay
// L.imageOverlay(imageUrl, imageBounds).addTo(map);

//Remove the zoom control
// map.zoomControl.remove();

//Disable zooming
// map.scrollWheelZoom.disable();

const countryData = <?php echo $country_data_json; ?>;
// Define global offsets for latitude and longitude
//const latitudeOffset = -3; // Adjust this value as needed
//const longitudeOffset = -9; // Adjust this value as needed
const latitudeOffset = 0; // Adjust this value as needed
const longitudeOffset = 0; // Adjust this value as needed

// Define custom SVG icon
// const customIcon = L.icon({
//     iconUrl: '<?php echo get_template_directory_uri(); ?>/src/map/pin.svg', // Path to your custom SVG
//     iconSize: [32, 32], // Size of the icon
//     iconAnchor: [16, 32], // Point of the icon which will correspond to marker's location
//     popupAnchor: [0, -32] // Point from which the popup should open relative to the iconAnchor
// });

// Store country markers using their ISO codes
const countryMarkers = {};

// Loop through the countries array and add markers
countryData.forEach(function(country) {

	
	const adjustedLatitude = parseFloat(country.latitude) + latitudeOffset;
	const adjustedLongitude = parseFloat(country.longitude) + longitudeOffset;
	const iconUrl = '<?php echo get_template_directory_uri(); ?>/src/map/pin-' + country.region[0].slug + '.svg';
	
	// console.log(iconUrl);
	const customIcon = L.icon({
		iconUrl: iconUrl,
		iconSize: [48, 48],
		iconAnchor: [24, 48],
		popupAnchor: [0, -48]
	});

	// Create a marker
	var marker = L.marker([adjustedLatitude, adjustedLongitude], { icon: customIcon }).addTo(map);


	// Store the marker reference using the ISO code
    countryMarkers[country.iso_code] = marker;

	// Create a list of tags
	var tagsList = '';

	// console.log(country.tags);
	if (country.tags && country.tags.length > 0) {
		country.tags.forEach(function(tag) {
			tagsList = `<span>${tag.name}</span>`;
		});
	}

	// Create popup content
    var popupContent = `
        <div class="country-container stack stack-small">
            <h3>${country.title}</h3>
            <div>${country.content}</div>
            ${country.report ? `<p><a class="hdg-button hdg-button--small" href="${country.report}" target="_blank">Access detailed report</a></p>` : ''}
        </div>
    `;

	// Bind a popup to the marker
    marker.bindPopup(popupContent);
});

// Attach event listeners to buttons
document.querySelectorAll('.hdg-map__countries-popover-button').forEach(button => {
    button.addEventListener('click', function() {

        const isoCode = this.getAttribute('data-iso-code');
        const marker = countryMarkers[isoCode];

        if (marker) {
            marker.openPopup();
            //map.setView(marker.getLatLng(), 5); // Adjust zoom level as needed
        }
    });
});
</script>


<?php
get_footer();
