// Import necessary AlpineJS core and intersect plugin
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';
import ui from '@alpinejs/ui';

window.Alpine = Alpine;
Alpine.plugin(intersect);
Alpine.plugin(focus);
Alpine.plugin(ui);

Alpine.data('scrollSpy', function () {
    return {
        activeSection: null,
        sections: [],
        observer: null,
        lastY: 0,  // to track scroll direction
        rootMarginValue: '0px 0px -80% 0px',  // Once we clear 80% of the viewport height from the bottom, trigger the intersection

        init() {
            //Skip any section that has the 'dont-show-on-page-menu' class
            this.sections = Array.from(document.querySelectorAll('h2[id]:not(.dont-show-on-page-menu)')).map(el => el.id);

            if (!this.sections.length) return;

            // Manually set the first section as active initially
            this.activeSection = this.sections[0];  // Set the first section as active by default

            this.observer = new IntersectionObserver((entries, observer) => {
                let currentIntersecting = {};

                entries.forEach(entry => {
                    currentIntersecting[entry.target.id] = entry.isIntersecting;
                });

                // Adjust activeSection based on intersections
                for (let i = this.sections.length - 1; i >= 0; i--) {
                    const id = this.sections[i];
                    if (currentIntersecting[id]) {
                        this.activeSection = id;
                        break; // Stop at the first intersecting section found from the bottom up
                    }
                }

            }, {
                threshold: 0.9,  // Consider adjusting this if needed
                rootMargin: this.rootMarginValue  // Triggers when the target enters the top 200px of the viewport
            });

            // Observe all sections
            this.sections.forEach(id => {
                this.observer.observe(document.getElementById(id));
            });
        }
    };
});

Alpine.data('carousel', function () {
    return {
        
        skip: 3, // Number of slides to skip (change as needed)
        atBeginning: true, // Start at the beginning
        atEnd: false, // Not at the end initially
        currentIndex: 0, // Track the current index

        init() {
            // Set the initial state of the buttons
            this.updateButtonStates();
        },

        next() {
            this.currentIndex += this.skip;
            this.scrollToCurrent();
            this.updateButtonStates();
        },

        prev() {
            this.currentIndex -= this.skip;
            this.scrollToCurrent();
            this.updateButtonStates();
        },

        scrollToCurrent() {
            let slider = this.$refs.slider;
            let offset = slider.firstElementChild.getBoundingClientRect().width; // Width of each slide
            slider.scrollTo({ left: offset * this.currentIndex, behavior: 'smooth' });
        },

        updateButtonStates() {
            let slider = this.$refs.slider;
            let totalItems = slider.children.length;

            // Update button states based on the current index
            this.atBeginning = this.currentIndex <= 0;
            this.atEnd = this.currentIndex >= totalItems - 1;
        }
    };
});

Alpine.start();