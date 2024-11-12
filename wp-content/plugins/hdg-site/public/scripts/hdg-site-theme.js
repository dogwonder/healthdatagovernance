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
        currentPage: 0,           // Tracks the current page index (0-based)
        itemsPerPage: 5,          // Number of items to skip per navigation
        totalItems: 0,            // Total number of carousel items
        totalPages: 0,            // Total number of pages
        atBeginning: true,        // Indicates if the carousel is at the first page
        atEnd: false,             // Indicates if the carousel is at the last page
  
        // Initializes the carousel by calculating total items and pages
        init() {
          this.totalItems = this.$refs.slider.children.length;
          this.totalPages = Math.ceil(this.totalItems / this.itemsPerPage);
          console.log(`Total Items: ${this.totalItems}`);
          console.log(`Total Pages: ${this.totalPages}`);
          this.updateButtons();
        },
  
        // Navigates to the next set of items
        next() {
          if (this.currentPage < this.totalPages - 1) {
            this.currentPage++;
            console.log(`Navigating to next page: ${this.currentPage}`);
            this.scrollToPage();
            this.updateButtons();
          }
        },
  
        // Navigates to the previous set of items
        prev() {
          if (this.currentPage > 0) {
            this.currentPage--;
            console.log(`Navigating to previous page: ${this.currentPage}`);
            this.scrollToPage();
            this.updateButtons();
          }
        },
  
        // Scrolls the carousel to the current page
        scrollToPage() {
          const containerWidth = this.$refs.slider.clientWidth;
          const scrollPosition = this.currentPage * containerWidth;
          console.log(`Scrolling to position: ${scrollPosition}px`);
          this.$refs.slider.scrollTo({
            left: scrollPosition,
            behavior: 'smooth'
          });
        },
  
        // Updates the state of navigation buttons
        updateButtons() {
          this.atBeginning = this.currentPage === 0;
          this.atEnd = this.currentPage >= this.totalPages - 1;
          console.log(`At Beginning: ${this.atBeginning}, At End: ${this.atEnd}`);
        }
      }
});

Alpine.start();