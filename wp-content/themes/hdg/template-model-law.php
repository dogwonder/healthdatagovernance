<?php
/**
 * Template Name: Model Law
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdg
 */

get_header();
?>

	<div id="primary" class="hdg-content-wrapper">
		<?php
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/_templates/content', 'page' ); 

		endwhile; // End of the loop.
		?>
	</div>
	

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Get all tabs (parent of H3)
    const tabs = document.querySelectorAll('.hdg-tab');
    const tabsData = [];
    const tabList = document.querySelector('.hdg-tabs-list');

    // Collect tab data
    tabs.forEach((tab, index) => {
        const tabTitle = tab.querySelector('h3');
        const tabData = {
            title: tabTitle ? tabTitle.innerText : `Tab ${index + 1}`,
            element: tab // Store the tab element itself
        };
        tabsData.push(tabData);
    });

    // Generate navigation for tabs
    tabsData.forEach((tab, index) => {
        const tabNavItem = document.createElement('li');
		//If the tab title is "Key considerations when implementing the model law" then make it "Key considerations"
		if(tab.title == "Key considerations when implementing the model law"){
			tab.title = "Key considerations";
		}
        tabNavItem.innerHTML = `
            <a href="#" data-index="${index}">
                ${tab.title}
            </a>
        `;
        tabNavItem.classList.add('hdg-tab-nav-item');
        if (index === 0) {
            tabNavItem.classList.add('active'); // Highlight the first tab by default
        }
        tabList.appendChild(tabNavItem);
    });

    // Show the first tab by default
    tabsData.forEach((tab, index) => {
        if (index === 0) {
            tab.element.style.display = 'block';
        } else {
            tab.element.style.display = 'none';
        }
    });

    // Add click event to each tab navigation link
    document.querySelectorAll('.hdg-tab-nav-item a').forEach(navItem => {
        navItem.addEventListener('click', event => {
            event.preventDefault(); // Prevent default link behavior

            // Get the index of the tab to show
            const index = navItem.getAttribute('data-index');

            // Hide all tabs
            tabsData.forEach(tab => {
                tab.element.style.display = 'none';
            });

            // Remove active class from all nav items
            document.querySelectorAll('.hdg-tab-nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Show the selected tab
            const activeTab = tabsData[index];
            if (activeTab) {
                activeTab.element.style.display = 'block';
            }

            // Highlight the active navigation item
            navItem.parentElement.classList.add('active');
        });
    });


    });
</script>



<?php
get_footer();
