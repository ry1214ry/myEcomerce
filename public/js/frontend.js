(() => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const scrollBehavior = reducedMotion ? 'auto' : 'smooth';

    document.documentElement.classList.add('js-enhanced');

    function initNavbarState() {
        const navbar = document.querySelector('.navbar-main');

        if (!navbar) {
            return;
        }

        const syncState = () => {
            navbar.classList.toggle('is-scrolled', window.scrollY > 12);
        };

        syncState();
        window.addEventListener('scroll', syncState, { passive: true });
    }

    function initMobileNav() {
        const navbar = document.querySelector('.navbar-main');
        const offcanvasElement = document.querySelector('#mainNav.offcanvas');

        if (!navbar || !offcanvasElement || !window.bootstrap?.Offcanvas) {
            return;
        }

        const offcanvas = window.bootstrap.Offcanvas.getOrCreateInstance(offcanvasElement);

        const syncState = (isOpen) => {
            navbar.classList.toggle('is-menu-open', isOpen);
        };

        offcanvasElement.addEventListener('shown.bs.offcanvas', () => {
            syncState(true);
            offcanvasElement.querySelector('.navbar-mobile-search input')?.focus();
        });

        offcanvasElement.addEventListener('hidden.bs.offcanvas', () => {
            syncState(false);
        });

        offcanvasElement
            .querySelectorAll('.nav-link, .dropdown-item, [data-nav-dismiss]')
            .forEach((link) => {
                link.addEventListener('click', () => {
                    if (window.innerWidth >= 992 || link.classList.contains('dropdown-toggle')) {
                        return;
                    }

                    offcanvas.hide();
                });
            });
    }

    function initBackToTop() {
        const button = document.querySelector('[data-back-to-top]');

        if (!button) {
            return;
        }

        const syncState = () => {
            button.classList.toggle('is-visible', window.scrollY > 320);
        };

        syncState();
        window.addEventListener('scroll', syncState, { passive: true });

        button.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: scrollBehavior,
            });
        });
    }

    function initReveal() {
        const revealElements = document.querySelectorAll('.reveal');

        if (!revealElements.length) {
            return;
        }

        if (reducedMotion || !('IntersectionObserver' in window)) {
            revealElements.forEach((element) => element.classList.add('visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px',
        });

        revealElements.forEach((element) => observer.observe(element));
    }

    function initSmoothAnchors() {
        document.addEventListener('click', (event) => {
            const link = event.target.closest('a[href^="#"]');

            if (!link) {
                return;
            }

            const href = link.getAttribute('href');

            if (!href || href === '#' || link.hasAttribute('data-bs-toggle')) {
                return;
            }

            const target = document.querySelector(href);

            if (!target) {
                return;
            }

            event.preventDefault();

            const navbarHeight = document.querySelector('.navbar-main')?.offsetHeight ?? 0;
            const top = Math.max(
                target.getBoundingClientRect().top + window.scrollY - navbarHeight - 16,
                0
            );

            window.scrollTo({
                top,
                behavior: scrollBehavior,
            });

            target.setAttribute('tabindex', '-1');
            target.focus({ preventScroll: true });

            if (window.history.replaceState) {
                window.history.replaceState(null, '', href);
            }
        });
    }

    function initAlertAutoDismiss() {
        document.querySelectorAll('.alert-dismissible').forEach((alert) => {
            window.setTimeout(() => {
                if (!document.body.contains(alert)) {
                    return;
                }

                if (window.bootstrap?.Alert) {
                    window.bootstrap.Alert.getOrCreateInstance(alert).close();
                    return;
                }

                alert.remove();
            }, 4500);
        });
    }

    function initFormSubmissionState() {
        const selector = 'button[type="submit"], input[type="submit"]';

        document.addEventListener('submit', (event) => {
            const form = event.target;

            if (!(form instanceof HTMLFormElement)) {
                return;
            }

            const method = (form.getAttribute('method') || 'get').toLowerCase();

            if (method === 'get' || form.hasAttribute('data-allow-repeat-submit')) {
                return;
            }

            if (form.dataset.submitting === 'true') {
                event.preventDefault();
                return;
            }

            form.dataset.submitting = 'true';
            form.classList.add('is-submitting');

            form.querySelectorAll(selector).forEach((button) => {
                button.dataset.wasDisabled = button.disabled ? 'true' : 'false';

                if (!button.disabled) {
                    button.disabled = true;
                }
            });
        });

        window.addEventListener('pageshow', () => {
            document.querySelectorAll('form.is-submitting').forEach((form) => {
                form.dataset.submitting = 'false';
                form.classList.remove('is-submitting');

                form.querySelectorAll(selector).forEach((button) => {
                    if (button.dataset.wasDisabled === 'false') {
                        button.disabled = false;
                    }
                });
            });
        });
    }

    function initImageFadeIn() {
        document.querySelectorAll('img').forEach((image) => {
            image.classList.add('media-fade');

            const markReady = () => image.classList.add('is-loaded');

            if (image.complete) {
                markReady();
                return;
            }

            image.addEventListener('load', markReady, { once: true });
            image.addEventListener('error', markReady, { once: true });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initNavbarState();
        initMobileNav();
        initBackToTop();
        initReveal();
        initSmoothAnchors();
        initAlertAutoDismiss();
        initFormSubmissionState();
        initImageFadeIn();
    });
})();
