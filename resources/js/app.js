// Menu Toggle Button
document.addEventListener('DOMContentLoaded', function () {
    const menuBtn  = document.getElementById('menuBtn');
    const mainMenu = document.getElementById('mainMenu');

    if (menuBtn && mainMenu) {
        menuBtn.addEventListener('click', () => {
            mainMenu.classList.toggle('hidden');
        });
    }
});

// Accordion Section
function toggleAccordion(button) {
    const content     = button.nextElementSibling;
    const icon        = button.querySelector('.rotate-icon');
    const allContents = document.querySelectorAll('.accordion-content');
    const allIcons    = document.querySelectorAll('.rotate-icon');

    allContents.forEach(item => {
        if (item !== content) item.classList.remove('active');
    });
    allIcons.forEach(item => {
        if (item !== icon) item.classList.remove('active');
    });

    content.classList.toggle('active');
    icon.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function () {
    const accordionTriggers = document.querySelectorAll('[data-accordion-trigger]');
    accordionTriggers.forEach(trigger => {
        trigger.addEventListener('click', function () {
            toggleAccordion(this);
        });
    });
});

// ============================================================
// BLOG LOAD MORE / OFFLOAD — WITH AJAX SUPPORT
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const grid        = document.getElementById('blogGrid');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const offloadBtn  = document.getElementById('offloadBtn');

    if (!grid || !loadMoreBtn) return;

    const initialPosts  = parseInt(grid.dataset.initialPosts)  || 6;
    const loadMoreCount = parseInt(grid.dataset.loadMoreCount) || 3;
    const totalPosts    = parseInt(grid.dataset.totalPosts)    || 0;
    const excludedIds   = grid.dataset.excludedIds             || '';

    let visibleCount = Array.from(grid.querySelectorAll('.blog-card'))
                           .filter(c => !c.classList.contains('hidden')).length;
    let ajaxOffset   = 0;

    // ── Load More ─────────────────────────────────────────────────────────────
    function showNextBatch() {
        const firstNewIndex = visibleCount;
        let shown  = 0;
        let hidden = Array.from(grid.querySelectorAll('.blog-card.hidden'));

        // Step 1: Hidden DOM cards pehle dikhao
        for (let i = 0; i < hidden.length && shown < loadMoreCount; i++) {
            hidden[i].classList.remove('hidden');
            visibleCount++;
            shown++;
        }

        // Naye cards pe scroll karo
        setTimeout(() => {
            const allCards     = Array.from(grid.querySelectorAll('.blog-card'));
            const firstNewCard = allCards[firstNewIndex];
            if (firstNewCard) {
                const yOffset = -10;
                const y = firstNewCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }
        }, 150);

        // Step 2: Agar aur chahiye to AJAX
        if (shown < loadMoreCount && visibleCount < totalPosts) {
            fetchMorePosts(loadMoreCount - shown, firstNewIndex + shown);
        } else {
            updateButtons();
        }
    }

    // ── AJAX fetch ────────────────────────────────────────────────────────────
    function fetchMorePosts(count, scrollToIndex) {
        loadMoreBtn.disabled    = true;
        loadMoreBtn.textContent = 'Loading...';

        const data = new FormData();
        data.append('action',       'blog_load_more');
        data.append('nonce',        blogAjax.nonce);
        data.append('ajax_offset',  ajaxOffset);
        data.append('count',        count);
        data.append('excluded_ids', excludedIds);

        fetch(blogAjax.ajax_url, { method: 'POST', body: data })
            .then(r => r.json())
            .then(res => {
                if (res.success && res.data.html && res.data.count > 0) {
                    grid.insertAdjacentHTML('beforeend', res.data.html);
                    ajaxOffset   += res.data.count;
                    visibleCount += res.data.count;

                    setTimeout(() => {
                        const allCards     = Array.from(grid.querySelectorAll('.blog-card'));
                        const firstNewCard = allCards[scrollToIndex];
                        if (firstNewCard) {
                            const yOffset = -10;
                            const y = firstNewCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
                            window.scrollTo({ top: y, behavior: 'smooth' });
                        }
                    }, 150);
                }

                loadMoreBtn.disabled    = false;
                loadMoreBtn.textContent = 'Load more';
                updateButtons();
            })
            .catch(() => {
                loadMoreBtn.disabled    = false;
                loadMoreBtn.textContent = 'Load more';
            });
    }

    // ── Offload — Step by step (Load More ki tarah ulta) ─────────────────────
    function offload() {
        const allCards = Array.from(grid.querySelectorAll('.blog-card'));

        // Kitni cards visible hain abhi
        const currentVisible = allCards.filter(c => !c.classList.contains('hidden')).length;

        // Agar already initial pe aa gaye to kuch nahi karna
        if (currentVisible <= initialPosts) return;

        // Pichli `loadMoreCount` cards hide karo
        const newVisible = Math.max(currentVisible - loadMoreCount, initialPosts);

        // newVisible se aage wali cards hide karo
        allCards.forEach((card, i) => {
            if (i >= newVisible) {
                card.classList.add('hidden');
            }
        });

        visibleCount = newVisible;

        // Last visible card pe scroll karo (jaise Load More mein pehli nai card pe jate hain)
        setTimeout(() => {
            const lastVisibleCard = allCards[newVisible - 1];
            if (lastVisibleCard) {
                const yOffset = -10;
                const y = lastVisibleCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }
        }, 150);

        updateButtons();
    }

    // ── Buttons ───────────────────────────────────────────────────────────────
    function updateButtons() {
        loadMoreBtn.classList.toggle('hidden', visibleCount >= totalPosts);
        if (offloadBtn) offloadBtn.classList.toggle('hidden', visibleCount <= initialPosts);
    }

    loadMoreBtn.addEventListener('click', showNextBatch);
    if (offloadBtn) offloadBtn.addEventListener('click', offload);

    updateButtons();
});

// ============================================================
// Splide Section (testimonial section)
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const sliderEl = document.getElementById('testimonial-slider');
    if (!sliderEl) return;

    try {
        var splide = new Splide('#testimonial-slider', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            gap: '24px',
            arrows: false,
            pagination: false,
            breakpoints: {
                1024: { perPage: 3 },
                768:  { perPage: 2 },
                425:  { perPage: 1 }
            }
        });

        splide.mount();

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => splide.go('<'));
            nextBtn.addEventListener('click', () => splide.go('>'));
        }
    } catch (e) {
        console.warn('[Splide] Slider init failed:', e.message);
    }
});

// ============================================================
// About Counter JS - Ultra Smooth Version
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    function animateCounter(el) {
        var target   = parseInt(el.dataset.target, 10);
        var suffix   = el.dataset.suffix    || '';
        var sep      = el.dataset.separator || '';
        var duration = 2000;
        var start    = performance.now();

        function format(num) {
            var str = Math.round(num).toString();
            if (sep) str = str.replace(/\B(?=(\d{3})+(?!\d))/g, sep);
            return str + suffix;
        }

        function step(now) {
            var elapsed  = now - start;
            var progress = Math.min(elapsed / duration, 1);
            var eased    = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            el.textContent = format(eased * target);
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = format(target);
            }
        }

        requestAnimationFrame(step);
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = 'true';
                setTimeout(function () {
                    animateCounter(entry.target);
                }, 100);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold:  0.2,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.counter-number').forEach(function (el) {
        observer.observe(el);
    });
});