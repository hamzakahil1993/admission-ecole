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

    function isTcfToggleElement() {
        var radioInput = document.querySelector('input[name="assertion[isTcf]"]:checked');
        var tcfScore = document.querySelector('.tcfScore');
        if (tcfScore) {
            if (radioInput && radioInput.value == 1) {
                tcfScore.style.display = 'block';
            } else {
                tcfScore.style.display = 'none';
            }
        }
    }
    var isTcfRadioInputs = document.querySelectorAll('input[name="assertion[isTcf]"]');
    isTcfRadioInputs.forEach(function (input) {
        input.addEventListener('change', isTcfToggleElement);
    });

    function whereToStudyToggleElement() {
        var radioInput = document.querySelector('input[name="assertion[whereToStudy]"]:checked');
        var otherWhereToStudy = document.querySelector('.otherWhereToStudy');
        if (otherWhereToStudy) {
            if (radioInput && radioInput.value == 2) {
                otherWhereToStudy.style.display = 'block';
            } else {
                otherWhereToStudy.style.display = 'none';
            }
        }
    }
    var whereToStudyRadioInputs = document.querySelectorAll('input[name="assertion[whereToStudy]"]');
    whereToStudyRadioInputs.forEach(function (input) {
        input.addEventListener('change', whereToStudyToggleElement);
    });

    function isReorientationToggleElement() {
        var radioInput = document.querySelector('input[name="assertion[isReorientation]"]:checked');
        var reorientationDetail = document.querySelector('.reorientationDetail');
        if (reorientationDetail) {
            if (radioInput && radioInput.value == 1) {
                reorientationDetail.style.display = 'block';
            } else {
                reorientationDetail.style.display = 'none';
            }
        }
    }
    var isReorientationRadioInputs = document.querySelectorAll('input[name="assertion[isReorientation]"]');
    isReorientationRadioInputs.forEach(function (input) {
        input.addEventListener('change', isReorientationToggleElement);
    });

    function reorientationDetailToggleElement(event) {
        var reorientationDetailExtended = document.querySelector('.reorientationDetailExtended');
        const selectedValue = event.target.value;
        if (selectedValue == 'Autre') {
            reorientationDetailExtended.style.display = 'block';
        } else {
            reorientationDetailExtended.style.display = 'none';
        }
    }
    const reorientationDetailInput = document.getElementById('assertion_reorientationDetail');
    reorientationDetailInput.addEventListener('change', reorientationDetailToggleElement);

    function isAssertToOtherSchoolToggleElement() {
        var radioInput = document.querySelector('input[name="assertion[isAssertToOtherSchool]"]:checked');
        var assertToOtherSchoolName = document.querySelector('.assertToOtherSchoolName');
        var assertToOtherSchoolNoWhy = document.querySelector('.assertToOtherSchoolNoWhy');
        if (assertToOtherSchoolName && assertToOtherSchoolNoWhy) {
            if (radioInput && radioInput.value == 1) {
                assertToOtherSchoolName.style.display = 'block';
                assertToOtherSchoolNoWhy.style.display = 'none';
            } else {
                assertToOtherSchoolNoWhy.style.display = 'block';
                assertToOtherSchoolName.style.display = 'none';
            }
        }
    }
    var isAssertToOtherSchoolRadioInputs = document.querySelectorAll('input[name="assertion[isAssertToOtherSchool]"]');
    isAssertToOtherSchoolRadioInputs.forEach(function (input) {
        input.addEventListener('change', isAssertToOtherSchoolToggleElement);
    });


    function assertToOtherSchoolNoWhyToggleElement(event) {
        var assertToOtherSchoolNoWhyOther = document.querySelector('.assertToOtherSchoolNoWhyOther');
        const selectedValue = event.target.value;
        if (selectedValue == 'Autre') {
            assertToOtherSchoolNoWhyOther.style.display = 'block';
        } else {
            assertToOtherSchoolNoWhyOther.style.display = 'none';
        }
    }
    const assertToOtherSchoolNoWhyInput = document.getElementById('assertion_assertToOtherSchoolNoWhy');
    assertToOtherSchoolNoWhyInput.addEventListener('change', assertToOtherSchoolNoWhyToggleElement);

    function positionToggleElement(event) {
        var positionOther = document.querySelector('.positionOther');
        const selectedValue = event.target.value;
        if (selectedValue == 'Autre') {
            positionOther.style.display = 'block';
        } else {
            positionOther.style.display = 'none';
        }
    }
    const positionInput = document.getElementById('assertion_position');
    positionInput.addEventListener('change', positionToggleElement);


    function howDidYouKnowOurAgencyToggleElement(event) {
        var howDidYouKnowOurAgencyOther = document.querySelector('.howDidYouKnowOurAgencyOther');
        const selectedValue = event.target.value;
        if (selectedValue == 4) {
            howDidYouKnowOurAgencyOther.style.display = 'block';
        } else {
            howDidYouKnowOurAgencyOther.style.display = 'none';
        }
    }
    const howDidYouKnowOurAgencyInput = document.getElementById('assertion_howDidYouKnowOurAgency');
    howDidYouKnowOurAgencyInput.addEventListener('change', howDidYouKnowOurAgencyToggleElement);
});

