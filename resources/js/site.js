document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('[data-menu-button]');
    const menu = document.querySelector('[data-mobile-menu]');

    button?.addEventListener('click', () => {
        menu?.classList.toggle('hidden');
        button.setAttribute('aria-expanded', String(!menu?.classList.contains('hidden')));
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
