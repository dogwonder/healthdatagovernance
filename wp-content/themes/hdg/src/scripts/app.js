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

    const cardClick = (elem)=>{  

        const cardLinks = document.querySelectorAll(elem);

        if (!cardLinks) return;

        Array.prototype.forEach.call(cardLinks, function(card, i){

            card.addEventListener("click", handleClick);

            // Click handler but only if text is not selected
            function handleClick(event) {
                const isTextSelected = window.getSelection().toString();
                if (!isTextSelected) {
                    window.location = card.dataset.url;
                }
            }

        });   
        
    };

    class TextareaHandler {
        constructor(elem) {
            document.querySelectorAll(elem).forEach((textarea) => {
                // Set the minimum number of rows for each textarea based on its 'rows' attribute or default to 2
                textarea.setAttribute('rows', 4);
                // Update each textarea to adjust its size
                this.update(textarea);
            });
        }
    
        // Check if the textarea has a scrollbar
        isScrolling(textarea) {
            return textarea.scrollHeight > textarea.clientHeight;
        }
    
        // Increase the number of rows of the textarea until it no longer needs to scroll
        grow(textarea) {
            let clientHeight = textarea.clientHeight;
            let rows = this.rows(textarea);
            while (this.isScrolling(textarea)) {
                rows++;
                textarea.rows = rows;
                const newClientHeight = textarea.clientHeight;
                if (newClientHeight === clientHeight) {
                    break; // Stop if the height does not change
                }
                clientHeight = newClientHeight;
            }
        }
    
        // Decrease the number of rows of the textarea until it reaches the minimum or starts to need a scrollbar
        shrink(textarea) {
            let clientHeight = textarea.clientHeight;
            const minRows = parseInt(textarea.dataset.minRows);
            let rows = this.rows(textarea);
            while (!this.isScrolling(textarea) && rows > minRows) {
                rows--;
                textarea.rows = Math.max(rows, minRows);
                if (textarea.clientHeight === clientHeight) {
                    break; // Stop if the height does not change
                }
                if (this.isScrolling(textarea)) {
                    this.grow(textarea); // Grow again if we over-shrunk
                    break;
                }
            }
        }
    
        // Update the textarea by growing or shrinking it as needed
        update(textarea) {
            if (this.isScrolling(textarea)) {
                this.grow(textarea);
            } else {
                this.shrink(textarea);
            }    
        }
    
        // Helper method to get the current number of rows of the textarea
        rows(textarea) {
            return textarea.rows || parseInt(textarea.dataset.minRows);
        }
    }
    

    //Init
    document.addEventListener("DOMContentLoaded", function() {
        externalLinks();
        smoothScroll();
        scrollWrapper();
        toggleNav('#nav-toggle', '#nav-primary', '#masthead');
        cardClick('.hdg-card');
        new TextareaHandler('textarea');
     });
    
})();