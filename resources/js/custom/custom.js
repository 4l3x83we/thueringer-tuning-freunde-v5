import lozad from "lozad";
import PureCounter from "@srexi/purecounterjs/js/purecounter";
import Swiper from "swiper/bundle";
import { Fancybox } from "@fancyapps/ui";
import { de } from "@fancyapps/ui/dist/fancybox/l10n/de.esm.js";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

$(() => {
    "use strict";

    const observer = lozad();
    observer.observe();

    new PureCounter();

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    /**
     * Easy on scroll event listener
     */
    /*const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }*/

    /**
     * Header fixed top on scroll
     */
    /*let selectHeader = select('#header')
    if (selectHeader) {
        let headerOffset = selectHeader.offsetTop
        let nextElement = selectHeader.nextElementSibling
        const headerFixed = () => {
            if ((headerOffset - window.scrollY) <= 0) {
                selectHeader.classList.remove('sticky')
                selectHeader.classList.add('fixed')
            } else {
                selectHeader.classList.add('sticky')
                selectHeader.classList.remove('fixed')
            }
        }
        window.addEventListener('load', headerFixed)
        onscroll(document, headerFixed)
    }*/

    /**
     * Navbar links active state on scroll
     */
    /*let navbarlinks = select('#header a', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.remove('text-gray-900')
                navbarlink.classList.remove('dark:text-white')
                navbarlink.classList.add('font-bold')
                navbarlink.classList.add('text-primary-500')
                navbarlink.classList.add('dark:text-primary-500')
            } else {
                navbarlink.classList.remove('font-bold')
                navbarlink.classList.remove('text-primary-500')
                navbarlink.classList.remove('dark:text-primary-500')
                navbarlink.classList.add('text-gray-900')
                navbarlink.classList.add('dark:text-white')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)*/

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let header = select('#header')
        let offset = header.offsetHeight

        let elementPos = select(el).offsetTop
        window.scrollTo({
            top: elementPos - offset,
            behavior: 'smooth'
        })
    }

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash)
            }
        }
    });

    const mybutton = document.getElementById("btn-back-to-top");

    const scrollFunction = () => {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.classList.remove("hidden");
        } else {
            mybutton.classList.add("hidden");
        }
    };
    const backToTop = () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };

    mybutton.addEventListener("click", backToTop);
    window.addEventListener("scroll", scrollFunction);

    let $filterBtns = $('.filter-btn').click(function () {
        if (this.id === 'all') {
            $('.grid > div').fadeIn(450);
        } else {
            let $el = $('.' + this.id).fadeIn(450);
            $('.grid > div').not($el).hide();
        }
        $filterBtns.removeClass('filter-active');
        $filterBtns.addClass('filter-inactive');
        $(this).addClass('filter-active');
        $(this).removeClass('filter-inactive');
        // AOS.refresh();
    });

    new Swiper(".slider", {
        lazy: {
            lazyPreloadPrevNext: true,
        },
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 24,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        }
    });

    Fancybox.bind('[data-fancybox="images"]', {
        Image: {
            zoom: true,
        },
        l10n: de,
        Slideshow: {
            playOnStart: true,
        },
        Toolbar: {
            display: {
                left: [],
                middle: [],
                right: [
                    "zoom",
                    "slideshow",
                    "fullscreen",
                    "download",
                    "thumbs",
                    "close",
                ],
            }
        }
    });
});
