<?php
/**
 * Template Name: Principles
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

get_header();
// Hide title via custom field
if ( class_exists( 'acf' ) ) {
	$hidden_title = get_field( 'hide_title' );
}
?>
<div id="primary" class="hdg-content-wrapper">

	<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

	 	<div class="entry-wrapper">
        	<div class="entry-wrapper__inner full">

				<div class="entry-main stack">

					<?php if ( ! $hidden_title ) : 
                    the_title(
                        '<h1 class="hdg-page-header__title" itemprop="headline">',
                        "</h1>"
                    );
					endif;
                    ?>

					<h2 id="h-about-the-principles" class="wp-block-heading hdg-block-heading hdg-pbe-md">About the Principles</h2>

					<div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-1 wp-block-columns-is-layout-flex">
						<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:50%">

						<div x-data="modalHandler()" @keydown.escape.window="closeModal()">

						<div id="wheel-container" class="wheel-container">

							<?php get_template_part( 'template-parts/_molecules/principles-modal' ); ?>
							
							<div
								class="hdg-modal-overlay"
								:class="{ 'active': isOpen }"
								@click="closeModal()"
							>
								<div class="hdg-modal stack" @click.stop>
									<div class="modal-header">
										<h2 x-text="modalData.name"></h2>
										<button class="close-button" @click="closeModal()">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Pro 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M326.6 166.6L349.3 144 304 98.7l-22.6 22.6L192 210.7l-89.4-89.4L80 98.7 34.7 144l22.6 22.6L146.7 256 57.4 345.4 34.7 368 80 413.3l22.6-22.6L192 301.3l89.4 89.4L304 413.3 349.3 368l-22.6-22.6L237.3 256l89.4-89.4z"/></svg>
										</button>
									</div>
									<div class="modal-body stack">
										<p x-text="modalData.description"></p>
										<p><strong x-text="modalData.principle"></strong></p>
										<p><a :href="modalData.link" target="_blank" class="hdg-button">Read more about the principles</a></p>
									</div>
								</div>
							</div>

						</div>

						</div>

							
						</div>
						<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:50%">
							<p>The Health Data Governance Principles bring a human rights and equity lens to the governance of health data and are oriented towards supporting sustainable and resilient public health systems that can deliver universal health coverage (UHC). They create a common vision where all people and communities can share, use and benefit from health data.</p>
							<p>The Health Data Governance Principles have been primarily driven and developed by civil society through an inclusive and consultative, bottom-up process stewarded by Transform Health. This process brought together more than 200 contributors from more than 130 organisations through global and regional workshops and a one-month public consultation period.</p>
							<p>Download the Principles (<a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/EN-Health-Data-Governance-Principles-1.pdf">English</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/FR-Health-Data-Governance-Principles.pdf">French</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/SP-Health-Data-Governance-Principles.pdf">Spanish</a>)</p>

							Download a snapshot of the Principles (<a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/EN-Snapshot-of-the-Principles.pdf">English</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/FR-Snapshot-of-the-Principles.pdf">French</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/SP-Snapshot-of-the-Principles.pdf">Spanish</a>)

						</div>
					</div>

					<?php the_content(); ?>

				</div>

			</div>
		</div>

		</article>

</div>
<?php 
$principle_data = [
    'protect_people' => [
        'title' => 'Protect People',
        'intro' => 'Health data governance must ensure protection for individuals, groups and communities against data-related harm and violations.',
        'principles' => [
            'Protect individuals and communities', 
            'Build trust in data systems', 
            'Ensure data security'
        ]
    ],
    'promote_health_value' => [
        'title' => 'Promote Health Value',
        'intro' => 'Health data governance must maximise the value obtained from the use of data to improve health outcomes for both individuals and society.',
        'principles' => [
            'Enhance health systems and services', 
            'Promote data sharing and interoperability', 
            'Facilitate innovation using health data'
        ]
    ],
    'prioritise_equity' => [
        'title' => 'Prioritise Equity',
        'intro' => 'Health value created by the use of data must equitably benefit individuals and communities.',
        'principles' => [
            'promote-equitable-benefits-from-health-data', 
            'establish-data-rights-and-ownership'
        ]
    ]
];
$principle_data_json = json_encode($principle_data);
?>
<script>
	function modalHandler() {
        return {
            isOpen: false,
            modalData: {
                name: '',
                description: '',
				principle: '',
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
				const prinicpleData = <?php echo $principle_data_json; ?>;
				// console.log(prinicpleData);

				//Get all the principles from the JSON object
				const principles = Object.values(prinicpleData).reduce((acc, curr) => {
					return acc.concat(curr.principles);
				}, []);

				//Loop through each principle and add event listener
				principles.forEach(principle => {
					
					//Convert principle to lowercase and replace spaces with hyphens
					principleLower = principle.toLowerCase().replace(/\s/g, '-');
					const principleElement = document.querySelector(`[data-link=${principleLower}]`);

					// console.log(principleElement);
					if (principleElement) {
						principleElement.addEventListener('click', () => {
							const principleData = Object.values(prinicpleData).find(principleData => principleData.principles.includes(principle));
							// const linkFull = `/principles/principles-core-elements/#h-${principleLower}`;
							const linkFull = `/principles/principles-core-elements/`;
							// console.log(principleData);
							const data = {
								name: principleData.title || 'No Name',
								description: principleData.intro || 'No Description',
								principle: principle,
								link: linkFull || '#'
							};
							this.openModal(data);
						});
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
