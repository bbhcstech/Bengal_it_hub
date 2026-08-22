document.addEventListener('DOMContentLoaded', () => {
    /* ---- Theme Toggle ---- */
    const root = document.documentElement;
    const THEME_KEY = 'bith-theme';

    function applyTheme(theme) {
        if (theme === 'dark') {
            root.classList.add('dark');
        } else {
            root.classList.remove('dark');
        }
        document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
            btn.setAttribute('aria-pressed', String(theme === 'dark'));
        });
    }

    function initTheme() {
        const stored = localStorage.getItem(THEME_KEY);
        if (stored) {
            applyTheme(stored);
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            applyTheme(prefersDark ? 'dark' : 'light');
        }
    }

    function toggleTheme() {
        const isDark = root.classList.contains('dark');
        const next = isDark ? 'light' : 'dark';
        applyTheme(next);
        localStorage.setItem(THEME_KEY, next);
    }

    initTheme();

    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
        btn.addEventListener('click', toggleTheme);
    });

    const button = document.querySelector('[data-menu-button]');
    const menu = document.querySelector('[data-mobile-menu]');
    const closeButton = document.querySelector('[data-menu-close]');
    const backdrop = document.querySelector('[data-mobile-backdrop]');

    function setMobileMenu(open) {
        if (!menu || !button) return;

        menu.classList.toggle('hidden', !open);
        if (backdrop) {
            backdrop.classList.toggle('hidden', !open);
        }
        button.setAttribute('aria-expanded', String(open));
        button.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        document.body.classList.toggle('bih-mobile-menu-open', open);

        if (open) {
            closeButton?.focus({ preventScroll: true });
        }
    }

    button?.addEventListener('click', () => {
        setMobileMenu(menu?.classList.contains('hidden') ?? true);
    });

    closeButton?.addEventListener('click', () => setMobileMenu(false));
    backdrop?.addEventListener('click', () => setMobileMenu(false));

    menu?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setMobileMenu(false));
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setMobileMenu(false);
        }
    });

    window.addEventListener('resize', () => {
        if (window.matchMedia('(min-width: 1280px)').matches) {
            setMobileMenu(false);
        }
    });

    document.querySelector('[data-back-button]')?.addEventListener('click', () => {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = '/';
        }
    });

    document.querySelector('[data-scroll-top]')?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.querySelector('[data-scroll-bottom]')?.addEventListener('click', () => {
        window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' });
    });

    document.querySelectorAll('[data-dropdown]').forEach((wrapper) => {
        const trigger = wrapper.querySelector('[data-dropdown-trigger]');
        if (!trigger) return;

        const setOpen = (open) => trigger.setAttribute('aria-expanded', String(open));

        // Click/tap opens it too — the hover/focus-within CSS alone leaves
        // touch-only devices with no way to reach these submenus at all.
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            setOpen(trigger.getAttribute('aria-expanded') !== 'true');
        });

        wrapper.addEventListener('focusin', () => setOpen(true));
        wrapper.addEventListener('focusout', (event) => {
            if (!wrapper.contains(event.relatedTarget)) {
                setOpen(false);
            }
        });
        wrapper.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
                trigger.focus();
            }
        });
        document.addEventListener('click', (event) => {
            if (!wrapper.contains(event.target)) {
                setOpen(false);
            }
        });
    });

    const filterButtons = document.querySelectorAll('[data-product-filter]');
    const productCards = document.querySelectorAll('[data-product-card]');
    const emptyState = document.querySelector('[data-product-empty]');

    filterButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            filterButtons.forEach((b) => b.classList.remove('is-active'));
            btn.classList.add('is-active');

            const target = btn.dataset.productFilter;
            let visibleCount = 0;

            productCards.forEach((card) => {
                const matches = target === 'all' || card.dataset.segment === target;
                card.classList.toggle('hidden', !matches);
                if (matches) {
                    visibleCount += 1;
                }
            });

            emptyState?.classList.toggle('hidden', visibleCount > 0);
        });
    });
});

/* =====================================================================
   BENGAL IT HUB — HOMEPAGE SIGNAL ORBIT JS
   Scroll-reveal, animated counters, cursor glow, ecosystem tabs, FAQ.
   Uses bih- prefixed classes so nothing conflicts with existing JS above.
   ===================================================================== */

(function () {
    'use strict';

    /* ---- Scroll reveal (bih-reveal / bih-in-view) ---- */
    var revealEls = document.querySelectorAll('.bih-reveal');
    if (revealEls.length) {
        if ('IntersectionObserver' in window) {
            var revealObs = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('bih-in-view');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0, rootMargin: '200px 0px 200px 0px' });
            revealEls.forEach(function (el) { revealObs.observe(el); });
        } else {
            revealEls.forEach(function (el) { el.classList.add('bih-in-view'); });
        }

        // Safety-net: force-reveal anything missed (fast scroll, background tab restore)
        function bihSweepReveal() {
            var vh = window.innerHeight;
            revealEls.forEach(function (el) {
                if (el.classList.contains('bih-in-view')) return;
                var r = el.getBoundingClientRect();
                if (r.top < vh + 300 && r.bottom > -300) el.classList.add('bih-in-view');
            });
        }
        var bihRevealTicking = false;
        window.addEventListener('scroll', function () {
            if (!bihRevealTicking) {
                requestAnimationFrame(function () { bihSweepReveal(); bihRevealTicking = false; });
                bihRevealTicking = true;
            }
        }, { passive: true });
        window.addEventListener('load', bihSweepReveal);
        setTimeout(bihSweepReveal, 800);
        setTimeout(bihSweepReveal, 2000);
    }

    /* ---- Animated stat counters ([data-counter]) ---- */
    document.querySelectorAll('[data-counter]').forEach(function (el) {
        var raw = el.textContent.trim();
        var numMatch = raw.match(/\d+/);
        if (!numMatch) return;
        var target = parseInt(numMatch[0], 10);
        var suffix = raw.replace(/^\d+/, '');
        var started = false;
        var cObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !started) {
                    started = true;
                    var current = 0;
                    var step = Math.max(1, Math.ceil(target / 40));
                    var interval = setInterval(function () {
                        current += step;
                        if (current >= target) { current = target; clearInterval(interval); }
                        el.textContent = current + suffix;
                    }, 30);
                }
            });
        }, { threshold: 0.5 });
        cObs.observe(el);
    });

    /* ---- Cursor glow (desktop only) ---- */
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        var glow = document.createElement('div');
        glow.className = 'bih-cursor-glow';
        document.body.appendChild(glow);
        var gx = 0, gy = 0, cx = 0, cy = 0;
        window.addEventListener('mousemove', function (e) {
            gx = e.clientX; gy = e.clientY;
            glow.classList.add('bih-active');
        }, { passive: true });
        (function glowLoop() {
            cx += (gx - cx) * 0.12;
            cy += (gy - cy) * 0.12;
            glow.style.transform = 'translate(' + cx + 'px, ' + cy + 'px) translate(-50%, -50%)';
            requestAnimationFrame(glowLoop);
        })();
    }

    /* ---- Ecosystem tab switcher ([data-bih-eco-tab]) ---- */
    var ecoTabs = document.querySelectorAll('[data-bih-eco-tab]');
    if (ecoTabs.length) {
        ecoTabs.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = btn.dataset.bihEcoTab;
                ecoTabs.forEach(function (b) { b.classList.remove('bih-active'); });
                btn.classList.add('bih-active');
                document.querySelectorAll('[data-bih-eco-panel]').forEach(function (panel) {
                    panel.classList.toggle('bih-active', panel.dataset.bihEcoPanel === target);
                });
            });
        });
    }

    /* ---- HP FAQ accordion ---- */
    document.querySelectorAll('.bih-hp-faq-item .bih-hp-faq-q').forEach(function (q) {
        q.addEventListener('click', function () {
            var item = q.closest('.bih-hp-faq-item');
            var wasOpen = item.classList.contains('bih-open');
            if (item.parentElement) {
                item.parentElement.querySelectorAll('.bih-hp-faq-item').forEach(function (i) {
                    i.classList.remove('bih-open');
                });
            }
            if (!wasOpen) item.classList.add('bih-open');
        });
    });

})();
