;(function () {

    'use strict';

    //Constants
    let desktopWidth = 992;
    let priorFocus;

    //Open links with rel='external' in new window/tab
    const externalLinks = () =>{  

        //If rel is external then open the window in a new tab
        //Get all links with rel="external"
        const externalLinks = document.querySelectorAll('a[rel="external"]');
        //Loop through links and add click event
        for (let i = 0; i < externalLinks.length; i++) {
            externalLinks[i].addEventListener('click', (e) => {
                //Prevent default action
                e.preventDefault();
                //Open new tab
                window.open(externalLinks[i].href);
            });
        };

    };

    //Smooth scroll function
    const smoothScroll = () => {

        const links = document.querySelectorAll('.scroll[href^="#"]'); // console.log(links);

        for (let i = 0; i < links.length; i++) {
          //On click open in new window/tab
          links[i].addEventListener('click', function (e) {
              
            e.preventDefault();
            
            //If ID is just #, then scroll to top
            if (this.getAttribute('href') !== '#') {
                const id = this.getAttribute('href');
                //console.log(id); // smooth scroll to element ID that matches id

                document.querySelector(id).scrollIntoView({
                behavior: 'smooth'
                });
            }
                
            
          });
        }
    };

    //Scroll observer
    const scrollWrapper = ()=>{

        //On scroll add class to header
        const header = document.querySelector('.hdg-masthead');
        
        //If header is not present bail
        if(!header) { return; }
        const headerHeight = header.offsetHeight;
        
        //If no header bail
        if(!header) { return; }

        //If window resized lets watch for when we go bigger than a tablet and switch from the burger menu to a full menu
        const observer = new ResizeObserver((observedItems) => {
            const { contentRect } = observedItems[0];
            // scrollWrapper.style.height = contentRect.height - headerHeight + 'px';
        });

        //Watch the header element
        observer.observe(header);

        //When the user scrolls add class to header and 
        window.addEventListener('scroll', function (e) {
            //only if we are on desktop
            // if (window.innerWidth < mobileWidth) { return; }
            if (window.scrollY > headerHeight) {
                header.classList.remove('is-static');
                header.classList.add('is-scrolled');
            } else {
                header.classList.add('is-static');
                header.classList.remove('is-scrolled');
            }
        });

    }

    //Vanilla nav toggle button
    const toggleNav = (button, elem, masthead)=>{

        //https://piccalil.li/tutorial/build-a-light-and-global-state-system

        //Set up the vars
        const toggleButton = document.querySelector(button);
        
        //As we have some contexts where the nav is not present we need to check for it
        if (!toggleButton) return;
        
        //If the button exists, then run the function
        
        const menu = document.querySelector(elem);
        const header = document.querySelector(masthead);

        window.subscribers = [];
        
        const defaultState = {
            status: 'closed',
            enabled: false,
        };

        const state = new Proxy(defaultState, {
            set(state, key, value) {
                const oldState = {...state};

                state[key] = value;

                window.subscribers.forEach(callback => callback(state, oldState));

                return state;
            }
        });

        //If window resized lets watch for when we go bigger than a tablet and switch from the burger menu to a full menu
        const observer = new ResizeObserver((observedItems) => {
            const { contentRect } = observedItems[0];
            // console.log(contentRect);
            // console.log(observedItems[0]);
            if (contentRect.width <= desktopWidth) {
                state.enabled = true;
                observedItems[0].target.setAttribute('data-enabled', state.enabled);
              } else {
                state.enabled = false;
                observedItems[0].target.setAttribute('data-enabled', state.enabled);
            }
            
        });
    
        //Watch the header element 
        observer.observe(header);

        //Now an event listener for the burger menu button
        toggleButton.addEventListener('click', function(event) {

            // The JSON.parse function helps us convert the attribute from a string to a real boolean (true/false).
            const open = JSON.parse(toggleButton.getAttribute('aria-expanded'));

            //Switch the state via aria-expanded and set a data attribute status="open" which we can access with CSS
            state.status = open ? 'closed' : 'open';
            toggleButton.setAttribute('aria-expanded', !open);

            /*
            Toggle the menu state:
            Make sure this is not the <nav> as it’s undiscoverable when hidden
            The <nav> should be the surrounding container for the toggled state
            */
            menu.setAttribute('status', state.status);

            //Add an additional class to the header just incase we want to do something with it in it's opened state
            header.classList.toggle('masthead-is-open');
            //Add class to document body
            document.body.classList.toggle('nav-open');

            //Menu height for offset
            //console.log(menu.offsetHeight);
            let root = document.documentElement; //Remove padding
            root.style.setProperty('--submenu-offset', menu.offsetHeight + header.offsetHeight + 'px');
            

        });

        //Close menu if user hits the escape key
        window.addEventListener('keydown', function(event) {

            if (!event.key.includes('Escape')) { return; }
            //Set aria state and our data attribute
            toggleButton.setAttribute('aria-expanded', 'false');
            //Remove the header class
            header.classList.toggle('masthead-is-open');
            document.body.classList.toggle('nav-open');

            state.status = 'closed';
            menu.setAttribute('status', state.status);

            //And remove the class if set
            if (header) {
                header.classList.remove('masthead-is-open');
                document.body.classList.remove('nav-open');
            }
            
        });
        

    };

    const sliderEqualHeight = () => {
        //Get .wp-block-cb-carousel
        const sliders = document.querySelectorAll('.wp-block-cb-carousel');
        //If no sliders bail
        if (!sliders) return;
        //Loop through sliders
        sliders.forEach(slider => {
            //Get the slides
            const slides = slider.querySelectorAll('.wp-block-cb-slide');
            //If no slides bail
            if (!slides) return;
            //Get the tallest slide
            let tallestSlide = 0;
            slides.forEach(slide => {
                if (slide.offsetHeight > tallestSlide) {
                    tallestSlide = slide.offsetHeight;
                }
            });
            //Set the height of all slides to the tallest slide
            slides.forEach(slide => {
                slide.style.height = `${tallestSlide}px`;
            });
        });
    }

    class GradientInteractive {
        constructor() {
            this.interBubble = document.querySelector('.interactive');
            this.curX = 0;
            this.curY = 0;
            this.tgX = 0;
            this.tgY = 0;
    
            this.init();
        }
    
        init() {
            window.addEventListener('mousemove', (event) => {
                this.tgX = event.clientX;
                this.tgY = event.clientY;
            });
    
            this.move();
        }
    
        move() {
            this.curX += (this.tgX - this.curX) / 20;
            this.curY += (this.tgY - this.curY) / 20;
            this.interBubble.style.transform = `translate(${Math.round(this.curX)}px, ${Math.round(this.curY)}px)`;
    
            requestAnimationFrame(() => {
                this.move();
            });
        }
    }

    class GradientHeight {

        //Get the heigh of #page and apply it to the gradient data-gradient
        constructor() {
            this.page = document.body;
            this.gradient = document.querySelector('[data-gradient]');
            this.init();
        }

        init() {
            this.setHeight();
            this.watchResize();
        }

        setHeight() {
            this.gradient.style.height = `${this.page.offsetHeight}px`;
            //If the body has a class of admin-bar add 32px to this value
            if (document.body.classList.contains('admin-bar')) {
                this.gradient.style.height = `${this.page.offsetHeight + 32}px`;
            }
            
        }

        watchResize() {
            window.addEventListener('resize', () => {
                this.setHeight();
            });
        }

    }
    
    //Init
    document.addEventListener("DOMContentLoaded", function() {
        externalLinks();
        smoothScroll();
        scrollWrapper();
        toggleNav('#nav-toggle', '#nav-primary', '#masthead');
        sliderEqualHeight();
     });

     //After window load
    window.addEventListener('load', function() {
        new GradientHeight();
    });
    
})();