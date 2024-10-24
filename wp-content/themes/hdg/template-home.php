<?php
/**
 * Template Name: Carousel
 *
 * The template for displaying all blocks
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

 get_header();
 ?>

<style>
					.carousel-container {
						width: 100%;
						height: 100%;
						display: flex;
						align-items: center;
						justify-content: center;
					}
					.carousel {
						display: flex;
					}
					.carousel button {
						opacity: 0.5;
						border: none;
						-webkit-appearance: none;
						background-color: transparent;
					}
					.carousel button svg {
						width: 3rem;
						color: black;
						fill: none;
					}
					.carousel button svg {

					}
					.cursor-not-allowed {
						cursor: not-allowed;
					}
					.carousel ul {
						overflow-x: hidden;
						display: flex;
						list-style: none;
						width: 100%;
					}
					.carousel li {
						width: 33.333%;
						scroll-snap-align: start;
						flex-shrink: 0;
					}
				</style>
 
	 <div id="primary" class="hdg-content-wrapper">
		 
		 <?php
		 while ( have_posts() ) :
			 the_post(); ?>
 
			<article id="post-<?php the_ID(); ?>" <?php post_class('hdg-page stack'); ?>>

			<div class="carousel-container">
				<?php //the_content(); ?>

				

					<script src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.js"></script>

					<div
						x-data="{
							skip: 3,
							atBeginning: false,
							atEnd: false,
							next() {
								this.to((current, offset) => current + (offset * this.skip))
							},
							prev() {
								this.to((current, offset) => current - (offset * this.skip))
							},
							to(strategy) {
								let slider = this.$refs.slider
								let current = slider.scrollLeft
								let offset = slider.firstElementChild.getBoundingClientRect().width
								slider.scrollTo({ left: strategy(current, offset), behavior: 'smooth' })
							},
							focusableWhenVisible: {
								'x-intersect:enter'() {
									this.$el.removeAttribute('tabindex')
								},
								'x-intersect:leave'() {
									this.$el.setAttribute('tabindex', '-1')
								},
							},
							disableNextAndPreviousButtons: {
								'x-intersect:enter.threshold.05'() {
									let slideEls = this.$el.parentElement.children

									// If this is the first slide.
									if (slideEls[0] === this.$el) {
										this.atBeginning = true
									// If this is the last slide.
									} else if (slideEls[slideEls.length-1] === this.$el) {
										this.atEnd = true
									}
								},
								'x-intersect:leave.threshold.05'() {
									let slideEls = this.$el.parentElement.children

									// If this is the first slide.
									if (slideEls[0] === this.$el) {
										this.atBeginning = false
									// If this is the last slide.
									} else if (slideEls[slideEls.length-1] === this.$el) {
										this.atEnd = false
									}
								},
							},
						}"
						class=""
					>
						<div
							x-on:keydown.right="next"
							x-on:keydown.left="prev"
							tabindex="0"
							role="region"
							aria-labelledby="carousel-label"
							class="carousel"
						>
							<h2 id="carousel-label" class="sr-only" hidden>Carousel</h2>

							<!-- Prev Button -->
							<button
								x-on:click="prev"
								class=""
								:aria-disabled="atBeginning"
								:tabindex="atEnd ? -1 : 0"
								:class="{ 'opacity-50 cursor-not-allowed': atBeginning }"
							>
								<span aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
								</span>
								<span class="visually-hidden">Skip to previous slide page</span>
							</button>

							<span id="carousel-content-label" class="visually-hidden" hidden>Carousel</span>

							<ul
								x-ref="slider"
								tabindex="0"
								role="listbox"
								aria-labelledby="carousel-content-label"
								class=""
							>
								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=1" alt="placeholder image">
								</li>

								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=2" alt="placeholder image">
								</li>

								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=3" alt="placeholder image">
								</li>

								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=4" alt="placeholder image">
								</li>

								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=5" alt="placeholder image">
								</li>

								<li x-bind="disableNextAndPreviousButtons" class="" role="option">
									<img class="mt-2 w-full" src="https://picsum.photos/400/200?random=6" alt="placeholder image">
								</li>
							</ul>

							<!-- Next Button -->
							<button
								x-on:click="next"
								class="text-6xl"
								:aria-disabled="atEnd"
								:tabindex="atEnd ? -1 : 0"
								:class="{ 'opacity-50 cursor-not-allowed': atEnd }"
							>
								<span aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
								</span>
								<span class="visually-hidden">Skip to next slide page</span>
							</button>
						</div>
					</div>
				</div>


			</article><!-- #post-<?php the_ID(); ?> -->
 
		 <?php endwhile; // End of the loop.
		 ?>
	 
	 </div><!-- #primary -->
 
 <?php
 get_footer();
 