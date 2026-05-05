(() => {
    const doc = document.documentElement;
    const header = document.getElementById('siteHeader');
    const scrollProgressBar = document.querySelector('#scroll-progress span');
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    const onScroll = () => {
        if (header) {
            if (window.scrollY > 20) {
                header.classList.add('is-compact');
            } else {
                header.classList.remove('is-compact');
            }
        }

        if (scrollProgressBar) {
            const scrollTop = window.scrollY;
            const docHeight = doc.scrollHeight - window.innerHeight;
            const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            scrollProgressBar.style.width = `${Math.max(0, Math.min(scrollPercent, 100))}%`;
        }

        if (scrollTopBtn) {
            if (window.scrollY > 1000) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });
    }

    const revealItems = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window && revealItems.length) {
        const observer = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -10% 0px' }
        );

        revealItems.forEach((el, index) => {
            el.style.transitionDelay = `${Math.min(index * 40, 220)}ms`;
            observer.observe(el);
        });
    } else {
        revealItems.forEach((el) => el.classList.add('is-revealed'));
    }

    const parallaxItems = document.querySelectorAll('[data-parallax]');
    const motionReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches || !!(window.senaData && window.senaData.reduceMotion);
    const apoioSliders = document.querySelectorAll('[data-apoio-swiper]');

    if (apoioSliders.length && typeof window.Swiper === 'function') {
        apoioSliders.forEach((slider) => {
            const swiper = new window.Swiper(slider, {
                loop: true,
                speed: 9100,
                slidesPerView: 1.0,
                spaceBetween: 18,
                autoplay: motionReduced
                    ? false
                    : {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                allowTouchMove: true,
                watchSlidesProgress: true,
                breakpoints: {
                    576: {
                        slidesPerView: 1.6,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2.2,
                        spaceBetween: 22,
                    },
                    992: {
                        slidesPerView: 3.2,
                        spaceBetween: 24,
                    },
                    1200: {
                        slidesPerView: 5.2,
                        spaceBetween: 24,
                    },
                },
            });

            const clearHighlightedCards = () => {
                slider.querySelectorAll('.quote-card.destaque').forEach((card) => {
                    card.classList.remove('destaque');
                });
            };

            const applyRandomHighlight = () => {
                const visibleCards = Array.from(slider.querySelectorAll('.swiper-slide-visible .quote-card'));
                const allCards = Array.from(slider.querySelectorAll('.swiper-slide .quote-card'));
                const cards = visibleCards.length ? visibleCards : allCards;

                if (!cards.length) {
                    return;
                }

                clearHighlightedCards();
                const randomIndex = Math.floor(Math.random() * cards.length);
                cards[randomIndex].classList.add('destaque');
            };

            const destaqueInterval = window.setInterval(applyRandomHighlight, 4000);
            window.requestAnimationFrame(applyRandomHighlight);

            swiper.on('destroy', () => {
                window.clearInterval(destaqueInterval);
                clearHighlightedCards();
            });

            if (!motionReduced) {
                slider.addEventListener('mouseenter', () => {
                    if (swiper.autoplay) {
                        swiper.autoplay.stop();
                    }
                });
                slider.addEventListener('mouseleave', () => {
                    if (swiper.autoplay) {
                        swiper.autoplay.start();
                    }
                });
            }
        });
    }

    if (!motionReduced && parallaxItems.length) {
        const updateParallax = () => {
            const viewportHeight = window.innerHeight || doc.clientHeight;

            parallaxItems.forEach((item) => {
                const speed = Number(item.getAttribute('data-parallax')) || 0.12;
                const rect = item.getBoundingClientRect();
                if (rect.bottom < 0 || rect.top > viewportHeight) {
                    return;
                }
                const midpoint = rect.top + rect.height / 2;
                const distance = midpoint - viewportHeight / 2;
                const move = distance * speed * -0.2;
                item.style.transform = `translate3d(0, ${move}px, 0)`;
            });
        };

        window.addEventListener('scroll', updateParallax, { passive: true });
        window.addEventListener('resize', updateParallax);
        updateParallax();
    }
})();
