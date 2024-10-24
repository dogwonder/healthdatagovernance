// Import necessary AlpineJS core and intersect plugin
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus'
window.Alpine = Alpine;
Alpine.plugin(intersect);
Alpine.plugin(focus);

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

// Start the AlpineJS application
Alpine.start();