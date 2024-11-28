<?php
/**
 * Template Name: Principles - Alt
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


		<div class="hdg-block hdg-hero is-style-right  alignfull has-text-align-left has-image hdg-mbe-none">
			<div class="hdg-block__background">
				<figure>
					<picture>
						<source media="(min-width: 64em)" srcset="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/10/1-1536x864.jpg">
						<img src="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/10/1-640x360.jpg" alt="" width="640" height="360" fetchpriority="high">
					</picture>
				</figure>
			</div>


			<div class="hdg-hero__wrapper">
				<div class="hdg-hero__inner">   
					<div class="hdg-hero__content stack">
						<div class="acf-innerblocks-container">
								<?php the_title('<h1 class="wp-block-heading" itemprop="headline">',"</h1>");?>
						</div>
					</div>
				</div>
			</div>

		</div>


        	<div class="entry-wrapper__inner full">

				<div class="entry-main stack">

					<h2 id="h-about-the-principles" class="wp-block-heading hdg-block-heading hdg-pbe-md">About the Principles</h2>

					<div x-data="principleManager" @click.outside="restoreOriginalContent" class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-1 wp-block-columns-is-layout-flex">
						<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:50%">
							
						<div id="wheel-container" class="wheel-container">
							<?php get_template_part( 'template-parts/_molecules/principles-sidebar' ); ?>
							<?php /* ?>
							<template x-for="principle in principles" :key="principle.slug">
								<button :data-link="principle.slug" 
										@click="replaceWithPrinciple(principle.slug)">
									Replace with: <span x-text="principle.title"></span>
								</button>
							</template>
							<?php */ ?>
						</div>
							
						</div>
						<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:50%">
							<template x-if="!replaceContent">
								<p>The Health Data Governance Principles bring a human rights and equity lens to the governance of health data and are oriented towards supporting sustainable and resilient public health systems that can deliver universal health coverage (UHC). They create a common vision where all people and communities can share, use and benefit from health data.<br /><br />
								The Health Data Governance Principles have been primarily driven and developed by civil society through an inclusive and consultative, bottom-up process stewarded by Transform Health. This process brought together more than 200 contributors from more than 130 organisations through global and regional workshops and a one-month public consultation period.<br /><br />
								<strong>Download the Principles</strong> (<a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/EN-Health-Data-Governance-Principles-1.pdf">English</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/FR-Health-Data-Governance-Principles.pdf">French</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/SP-Health-Data-Governance-Principles.pdf">Spanish</a>)<br /><br />
								<strong>Download a snapshot of the Principles</strong> (<a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/EN-Snapshot-of-the-Principles.pdf">English</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/FR-Snapshot-of-the-Principles.pdf">French</a> | <a target="_blank" href="https://hdg-staging.mystagingwebsite.com/wp-content/uploads/2024/11/SP-Snapshot-of-the-Principles.pdf">Spanish</a>)</p>
							</template>

							<!-- Replaced Content -->
							<template x-if="replaceContent">
								<div class="stack">
									<h2 x-text="currentPrinciple.title"></h2>
									<p x-text="currentPrinciple.intro"></p>
									<p><a :href="`/principles/principles-core-elements/#${currentPrinciple.slug}`" 
									target="_blank" 
									class="hdg-button">
									Read more about the principles
									</a>
								</div>
							</template>

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
            [
                'title' => 'Protect individuals and communities',
				'slug' => 'protect-individuals-and-communities',
                'intro' => 'Health data governance must ensure protection for individuals, groups and communities
against data-related harm and violations. Protection for individuals is often embodied in general data protection laws. However, due to its potentially sensitive nature, health data requires additional specialised protections in law and in data practices. Unprotected health data (personal and aggregate) could expose individuals, groups and communities to harm. Health data governance must include special measures of protection against various kinds of individual and collective harm, including data-driven exploitation, harassment, discrimination, surveillance capitalism and neocolonialism.'
            ],
            [
                'title' => 'Build trust in data systems',
				'slug' => 'build-trust-in-data-systems',
                'intro' => 'Health data governance should reinforce trust in data systems and practices.'
            ],
            [
                'title' => 'Ensure data security',
				'slug' => 'ensure-data-security',
                'intro' => 'Processes for collecting, processing, storing, using, sharing and disposing data should all employ robust security mechanisms.'
            ]
        ]
    ],
    'promote_health_value' => [
        'title' => 'Promote Health Value',
        'intro' => 'Health data governance must maximise the value obtained from the use of data to improve health outcomes for both individuals and society.',
        'principles' => [
            [
                'title' => 'Enhance health systems and services',
				'slug' => 'enhance-health-systems-and-services',
                'intro' => 'Health data governance should enhance health system efficiency and resilience, improve health access, and advance health equity towards UHC.'
            ],
            [
                'title' => 'Promote data sharing and interoperability',
				'slug' => 'promote-data-sharing-and-interoperability',
                'intro' => 'Data collection and sharing is a prerequisite for creating value from health data but must be done in ways that support equity and human rights.'
            ],
            [
                'title' => 'Facilitate innovation using health data',
				'slug' => 'facilitate-innovation-using-health-data',
                'intro' => 'Governance approaches must enable innovation and flexibly accommodate new technologies and uses of data.'
            ]
        ]
    ],
    'prioritise_equity' => [
        'title' => 'Prioritise Equity',
        'intro' => 'Health value created by the use of data must equitably benefit individuals and communities.',
        'principles' => [
            [
                'title' => 'Promote equitable benefits from health data',
				'slug' => 'promote-equitable-benefits-from-health-data',
                'intro' => 'Equity in health data governance must ensure equitable representation in data of all individuals, groups and communities; extend to include meaningful participation of all groups in decision-making; and equitable access to data-generated health value about health data systems.'
            ],
            [
                'title' => 'Establish data rights and ownership',
				'slug' => 'establish-data-rights-and-ownership',
                'intro' => 'Health data governance should be rooted in strong and clear data-related rights.'
            ]
        ]
    ]
];
$principle_data_json = json_encode($principle_data);
// print_r($principle_data_json);
?>

<script>

	// Parse the JSON object from PHP
	const prinicpleData = <?php echo $principle_data_json; ?>;
	// console.log(prinicpleData);

	//Get all the principles from the JSON object
	const principles = Object.values(prinicpleData).reduce((acc, curr) => {
		return acc.concat(curr.principles);
	}, []);

	// console.log(principles);

	document.addEventListener('alpine:init', () => {
        Alpine.data('principleManager', () => ({
            replaceContent: false,
            currentPrinciple: { title: '', intro: '' },
            principles: [],

            init() {
                // Initialize the principles array with your existing JSON data
                this.principles = Object.values(<?php echo $principle_data_json; ?>)
                    .reduce((acc, curr) => acc.concat(curr.principles), []);
            },

            replaceWithPrinciple(slug) {
                const principle = this.principles.find(p => p.slug === slug);
                if (principle) {
                    this.currentPrinciple = principle;
                    this.replaceContent = true;
                }
            },

			restoreOriginalContent() {
                this.replaceContent = false;
                this.currentPrinciple = { title: '', intro: '', slug: '' };
            }
        }));
    });

</script>
		
<?php
get_footer();
