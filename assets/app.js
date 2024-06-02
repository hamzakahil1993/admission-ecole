import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';




window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

    // Activate SimpleLightbox plugin for portfolio items
    new SimpleLightbox({
        elements: '#portfolio a.portfolio-box'
    });

});

document.addEventListener("DOMContentLoaded", function() {
    function toggleElement(radioSelector, triggerValue, showTargetClass, hideTargetClass = null) {
        var radioInput = document.querySelector(`${radioSelector}:checked`);
        var showTargetElement = document.querySelector(`.${showTargetClass}`);
        var hideTargetElement = hideTargetClass ? document.querySelector(`.${hideTargetClass}`) : null;

        if (showTargetElement) {
            if (radioInput && radioInput.value == triggerValue) {
                showTargetElement.style.display = 'block';
                if (hideTargetElement) {
                    hideTargetElement.style.display = 'none';
                }
            } else {
                showTargetElement.style.display = 'none';
                if (hideTargetElement) {
                    hideTargetElement.style.display = 'block';
                }
            }
        }
    }

    function addToggleEvent(radioSelector, triggerValue, showTargetClass, hideTargetClass = null) {
        var radioInputs = document.querySelectorAll(radioSelector);
        radioInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                toggleElement(radioSelector, triggerValue, showTargetClass, hideTargetClass);
            });
        });
    }

    // Define the toggles
    addToggleEvent('input[name="assertion[isTcf]"]', '1', 'tcfScore');
    addToggleEvent('input[name="assertion[whereToStudy]"]', '2', 'otherWhereToStudy');
    addToggleEvent('input[name="assertion[isReorientation]"]', '1', 'reorientationDetail');
    addToggleEvent('input[name="assertion[reorientationDetail]"]', 'Autre', 'reorientationDetailExtended');
    addToggleEvent('input[name="assertion[isAssertToOtherSchool]"]', '1', 'assertToOtherSchoolName', 'assertToOtherSchoolNoWhy');
    addToggleEvent('input[name="assertion[position]"]', 'Autre', 'positionOther');
    addToggleEvent('input[name="assertion[howDidYouKnowOurAgency]"]', '4', 'howDidYouKnowOurAgencyOther');
});

