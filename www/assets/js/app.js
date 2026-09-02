/* =============================================================================
   Hathany Cosmos Foundation — interaction layer
   No dependencies. Everything degrades to a fully readable page without JS.
   ========================================================================== */
(function () {
  'use strict';

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const $  = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

  /* ---------------------------------------------------------------------
     Masthead: solidify on scroll, hide on scroll-down, show on scroll-up
     ------------------------------------------------------------------ */
  function initHeader() {
    const header = $('[data-header]');
    const shell  = $('[data-header-shell]');
    if (!header || !shell) return;

    const SOLID_AT = 24;
    const HIDE_AT  = 400;
    let last = window.scrollY;
    let ticking = false;

    const apply = () => {
      const y = window.scrollY;

      shell.classList.toggle('bg-white/85', y > SOLID_AT);
      shell.classList.toggle('backdrop-blur-xl', y > SOLID_AT);
      shell.classList.toggle('border-ink-line', y > SOLID_AT);
      shell.classList.toggle('shadow-[0_1px_24px_-8px_rgba(19,40,49,.16)]', y > SOLID_AT);

      // Only auto-hide well down the page, and never while the drawer is open
      if (!document.body.classList.contains('no-scroll')) {
        const down = y > last && y > HIDE_AT;
        header.style.transform = down ? 'translateY(-100%)' : 'translateY(0)';
      }

      last = y;
      ticking = false;
    };

    const onScroll = () => {
      if (!ticking) { window.requestAnimationFrame(apply); ticking = true; }
    };

    apply();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---------------------------------------------------------------------
     Mobile drawer
     ------------------------------------------------------------------ */
  function initMenu() {
    const panel = $('[data-menu-panel]');
    if (!panel) return;

    const scrim = $('[data-menu-scrim]', panel);
    const sheet = $('[data-menu-sheet]', panel);
    const openBtn  = $('[data-menu-open]');
    const closeBtn = $('[data-menu-close]', panel);

    const open = () => {
      panel.classList.remove('hidden');
      document.body.classList.add('no-scroll');
      openBtn?.setAttribute('aria-expanded', 'true');
      requestAnimationFrame(() => {
        scrim.classList.replace('opacity-0', 'opacity-100');
        sheet.classList.remove('translate-x-full');
        syncOpenSubmenus();
      });
      sheet.querySelector('a')?.focus({ preventScroll: true });
    };

    const close = () => {
      scrim.classList.replace('opacity-100', 'opacity-0');
      sheet.classList.add('translate-x-full');
      openBtn?.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('no-scroll');
      setTimeout(() => panel.classList.add('hidden'), reduceMotion ? 0 : 460);
      openBtn?.focus({ preventScroll: true });
    };

    openBtn?.addEventListener('click', open);
    closeBtn?.addEventListener('click', close);
    scrim?.addEventListener('click', close);
    $$('a', sheet).forEach(a => a.addEventListener('click', close));
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && !panel.classList.contains('hidden')) close();
    });
  }

  /* ---------------------------------------------------------------------
     Desktop dropdowns

     Opening is handled in CSS (group-hover / group-focus-within) so the menus
     work without JS. This only adds what CSS cannot: correct aria state, and
     Escape to close.
     ------------------------------------------------------------------ */
  function initDropdowns() {
    $$('[data-dropdown]').forEach(dd => {
      const trigger = $('[data-dropdown-trigger]', dd);
      if (!trigger) return;

      const setState = on => trigger.setAttribute('aria-expanded', on ? 'true' : 'false');

      dd.addEventListener('mouseenter', () => setState(true));
      dd.addEventListener('mouseleave', () => setState(false));
      dd.addEventListener('focusin',    () => setState(true));
      dd.addEventListener('focusout', e => {
        if (!dd.contains(e.relatedTarget)) setState(false);
      });

      dd.addEventListener('keydown', e => {
        if (e.key !== 'Escape') return;
        setState(false);
        trigger.blur();
        trigger.focus({ preventScroll: true });
      });
    });
  }

  /* ---------------------------------------------------------------------
     Mobile drawer submenus
     ------------------------------------------------------------------ */
  function initSubmenus() {
    $$('[data-sub]').forEach(sub => {
      const trigger = $('[data-sub-trigger]', sub);
      const panel   = $('[data-sub-panel]', sub);
      if (!trigger || !panel) return;

      // Only collapse here. An already-expanded panel keeps the generous
      // fallback height rendered by PHP, because the drawer is display:none
      // at this point and scrollHeight would measure 0.
      if (trigger.getAttribute('aria-expanded') !== 'true') {
        panel.style.maxHeight = '0px';
      }

      trigger.addEventListener('click', () => {
        const open = trigger.getAttribute('aria-expanded') === 'true';
        trigger.setAttribute('aria-expanded', open ? 'false' : 'true');
        panel.style.maxHeight = open ? '0px' : panel.scrollHeight + 'px';
        sub.classList.toggle('is-open', !open);
      });
    });
  }

  // Once the drawer is actually visible, panels can be measured for real.
  function syncOpenSubmenus() {
    $$('[data-sub]').forEach(sub => {
      const trigger = $('[data-sub-trigger]', sub);
      const panel   = $('[data-sub-panel]', sub);
      if (!trigger || !panel) return;
      if (trigger.getAttribute('aria-expanded') === 'true') {
        panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  }

  /* ---------------------------------------------------------------------
     Scroll reveal
     ------------------------------------------------------------------ */
  function initReveal() {
    const items = $$('.reveal, .reveal-words');
    if (!items.length) return;

    if (reduceMotion || !('IntersectionObserver' in window)) {
      items.forEach(el => el.classList.add('is-in'));
      return;
    }

    // Split headlines into words so they can cascade in
    $$('.reveal-words').forEach(el => {
      if (el.dataset.split) return;
      el.dataset.split = '1';
      const words = el.textContent.trim().split(/\s+/);
      el.textContent = '';
      words.forEach((w, i) => {
        const span = document.createElement('span');
        span.textContent = w;
        span.style.transitionDelay = `${i * 55}ms`;
        el.appendChild(span);
        if (i < words.length - 1) el.appendChild(document.createTextNode(' '));
      });
    });

    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-in');
        io.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    items.forEach(el => io.observe(el));
  }

  /* ---------------------------------------------------------------------
     Counters
     ------------------------------------------------------------------ */
  function initCounters() {
    const nodes = $$('[data-count]');
    if (!nodes.length) return;

    const fmt = n => n.toLocaleString('en-US');

    const run = (el) => {
      const target = parseFloat(el.dataset.count) || 0;
      if (reduceMotion) { el.textContent = fmt(target); return; }

      const DUR = 1900;
      const start = performance.now();

      const tick = (now) => {
        const p = Math.min((now - start) / DUR, 1);
        const eased = 1 - Math.pow(1 - p, 4);          // easeOutQuart
        el.textContent = fmt(Math.round(target * eased));
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    };

    if (!('IntersectionObserver' in window)) { nodes.forEach(run); return; }

    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        run(entry.target);
        io.unobserve(entry.target);
      });
    }, { threshold: 0.5 });

    nodes.forEach(el => io.observe(el));
  }

  /* ---------------------------------------------------------------------
     Accordion (FAQ)
     ------------------------------------------------------------------ */
  function initAccordion() {
    $$('[data-accordion]').forEach(group => {
      const items = $$('[data-acc-item]', group);

      items.forEach(item => {
        const btn   = $('[data-acc-trigger]', item);
        const panel = $('[data-acc-panel]', item);
        if (!btn || !panel) return;

        btn.addEventListener('click', () => {
          const isOpen = btn.getAttribute('aria-expanded') === 'true';

          // Single-open accordion
          items.forEach(other => {
            const ob = $('[data-acc-trigger]', other);
            const op = $('[data-acc-panel]', other);
            if (!ob || !op) return;
            ob.setAttribute('aria-expanded', 'false');
            op.style.maxHeight = null;
            other.classList.remove('is-open');
          });

          if (!isOpen) {
            btn.setAttribute('aria-expanded', 'true');
            panel.style.maxHeight = panel.scrollHeight + 'px';
            item.classList.add('is-open');
          }
        });
      });
    });
  }

  /* ---------------------------------------------------------------------
     Collections: category filter + load more, sharing one visibility model.

     Markup contract:
       [data-collection][data-page-size][data-step]
         [data-collection-filters] > button[data-filter]
         [data-collection-grid]    > *[data-filter-item]
         [data-collection-status]  live region
         [data-collection-more]    button
     ------------------------------------------------------------------ */
  function initCollections() {
    $$('[data-collection]').forEach(root => {
      const grid = $('[data-collection-grid]', root);
      if (!grid) return;

      const items    = $$('[data-filter-item]', grid);
      const buttons  = $$('[data-filter]', root);
      const moreBtn  = $('[data-collection-more]', root);
      const status   = $('[data-collection-status]', root);
      const noneMsg  = $('[data-collection-empty]', root);

      const pageSize = parseInt(root.dataset.pageSize, 10) || 8;
      const step     = parseInt(root.dataset.step, 10) || pageSize;

      let filter = 'all';
      let shown  = pageSize;

      const matches = item => filter === 'all' || item.dataset.filterItem === filter;

      /**
       * Single source of truth for what is on screen.
       *
       * Visibility is driven by the `hidden` class alone. Fading is delegated
       * to the existing reveal system by replaying `is-in`, because the
       * `.reveal.is-in` rule outranks an `opacity-0` utility on specificity
       * and the two would otherwise cancel each other out.
       */
      function render(animateFrom) {
        const matched = items.filter(matches);

        items.forEach(item => {
          const idx     = matched.indexOf(item);
          const visible = idx !== -1 && idx < shown;

          if (!visible) {
            item.classList.add('hidden');
            return;
          }

          const wasHidden = item.classList.contains('hidden');
          item.classList.remove('hidden');

          // Replay the entrance for anything appearing now
          if (wasHidden || animateFrom !== undefined) {
            const offset = animateFrom === undefined ? idx : idx - animateFrom;
            const delay  = Math.min(Math.max(offset, 0), 8) * 60;
            item.style.setProperty('--reveal-delay', delay + 'ms');

            if (reduceMotion) {
              item.classList.add('is-in');
            } else {
              item.classList.remove('is-in');
              requestAnimationFrame(() =>
                requestAnimationFrame(() => item.classList.add('is-in')));
            }
          }
        });

        const visibleCount = Math.min(shown, matched.length);

        if (status) {
          status.textContent = matched.length
            ? `Showing ${visibleCount} of ${matched.length}`
            : '';
        }

        if (moreBtn) {
          const remaining = matched.length - visibleCount;
          moreBtn.classList.toggle('hidden', remaining <= 0);
          const label = $('[data-collection-remaining]', moreBtn);
          if (label) label.textContent = remaining > 0 ? `(${remaining} more)` : '';
        }

        if (noneMsg) noneMsg.classList.toggle('hidden', matched.length > 0);
      }

      buttons.forEach(btn => {
        btn.addEventListener('click', () => {
          filter = btn.dataset.filter;
          shown  = pageSize;

          buttons.forEach(b => {
            const on = b === btn;
            b.classList.toggle('bg-teal-600', on);
            b.classList.toggle('text-white', on);
            b.classList.toggle('border-teal-600', on);
            b.classList.toggle('border-ink-line', !on);
            b.classList.toggle('text-ink-soft', !on);
            b.setAttribute('aria-pressed', on ? 'true' : 'false');
          });

          render(0);
        });
      });

      moreBtn?.addEventListener('click', () => {
        const from = shown;
        shown += step;
        render(from);

        // Move focus to the first newly revealed item so keyboard and screen
        // reader users land on the new content rather than the button.
        const matched = items.filter(matches);
        const target  = matched[from];
        if (target) {
          const focusable = target.matches('a, button') ? target : $('a, button', target);
          focusable?.focus({ preventScroll: true });
        }
      });

      render();
    });
  }

  /* ---------------------------------------------------------------------
     Lightbox (gallery)
     ------------------------------------------------------------------ */
  function initLightbox() {
    const triggers = $$('[data-lightbox]');
    if (!triggers.length) return;

    const box = document.createElement('div');
    box.className = 'fixed inset-0 z-[80] hidden items-center justify-center bg-ink/92 p-6 backdrop-blur-sm';
    box.innerHTML =
      '<button class="absolute right-6 top-6 grid h-12 w-12 place-items-center rounded-full border border-white/25 text-white transition hover:bg-white hover:text-ink" data-lb-close aria-label="Close">' +
        '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"><path d="M6 6 18 18M18 6 6 18"/></svg>' +
      '</button>' +
      '<figure class="max-h-full max-w-5xl scale-95 opacity-0 transition-all duration-500" data-lb-figure>' +
        '<img class="max-h-[78vh] w-auto rounded-2xl object-contain shadow-lift" data-lb-img alt="">' +
        '<figcaption class="mt-4 text-center text-sm text-white/75" data-lb-cap></figcaption>' +
      '</figure>';
    document.body.appendChild(box);

    const fig = $('[data-lb-figure]', box);
    const img = $('[data-lb-img]', box);
    const cap = $('[data-lb-cap]', box);

    const open = (src, caption, alt) => {
      img.src = src; img.alt = alt || caption || '';
      cap.textContent = caption || '';
      box.classList.remove('hidden');
      box.classList.add('flex');
      document.body.classList.add('no-scroll');
      requestAnimationFrame(() => fig.classList.remove('scale-95', 'opacity-0'));
    };

    const close = () => {
      fig.classList.add('scale-95', 'opacity-0');
      document.body.classList.remove('no-scroll');
      setTimeout(() => { box.classList.add('hidden'); box.classList.remove('flex'); img.src = ''; },
                 reduceMotion ? 0 : 300);
    };

    triggers.forEach(t => t.addEventListener('click', (e) => {
      e.preventDefault();
      open(t.dataset.lightbox, t.dataset.caption || '', t.dataset.alt || '');
    }));

    box.addEventListener('click', e => { if (e.target === box || e.target.closest('[data-lb-close]')) close(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && box.classList.contains('flex')) close(); });
  }

  /* ---------------------------------------------------------------------
     Back to top
     ------------------------------------------------------------------ */
  function initToTop() {
    const btn = $('[data-to-top]');
    if (!btn) return;

    const toggle = () => {
      const on = window.scrollY > 700;
      btn.classList.toggle('opacity-0', !on);
      btn.classList.toggle('translate-y-4', !on);
      btn.classList.toggle('pointer-events-none', !on);
    };

    toggle();
    window.addEventListener('scroll', toggle, { passive: true });
    btn.addEventListener('click', () =>
      window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' }));
  }

  /* ---------------------------------------------------------------------
     Subtle pointer parallax (hero art)
     ------------------------------------------------------------------ */
  function initParallax() {
    const layers = $$('[data-parallax]');
    if (!layers.length || reduceMotion || window.matchMedia('(pointer: coarse)').matches) return;

    let raf = null;

    window.addEventListener('mousemove', (e) => {
      if (raf) return;
      raf = requestAnimationFrame(() => {
        const cx = (e.clientX / window.innerWidth  - 0.5) * 2;
        const cy = (e.clientY / window.innerHeight - 0.5) * 2;
        layers.forEach(el => {
          const depth = parseFloat(el.dataset.parallax) || 8;
          el.style.transform = `translate3d(${cx * depth}px, ${cy * depth}px, 0)`;
        });
        raf = null;
      });
    }, { passive: true });
  }

  /* ---------------------------------------------------------------------
     Contact / volunteer form — client-side validation only.
     Wired to a backend when the CMS goes in.
     ------------------------------------------------------------------ */
  function initForms() {
    $$('[data-form]').forEach(form => {
      const note = $('[data-form-note]', form);

      form.addEventListener('submit', (e) => {
        e.preventDefault();

        let ok = true;
        $$('[required]', form).forEach(field => {
          const bad = !field.value.trim() ||
                      (field.type === 'email' && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(field.value));
          field.classList.toggle('border-ember-500', bad);
          field.classList.toggle('border-ink-line', !bad);
          if (bad) ok = false;
        });

        if (!note) return;

        if (!ok) {
          note.textContent = 'Please complete the highlighted fields.';
          note.className = 'mt-4 text-sm font-medium text-ember-600';
          return;
        }

        note.textContent = 'Thanks — this form is not connected yet. It will send once the site goes live.';
        note.className = 'mt-4 text-sm font-medium text-teal-700';
        form.reset();
      });
    });
  }

  /* ------------------------------------------------------------------ */
  // Reveal everything unconditionally. Used as the failsafe so a scripting
  // error can never leave the page sitting at opacity 0.
  function revealAll() {
    $$('.reveal, .reveal-words').forEach(el => el.classList.add('is-in'));
  }

  function init() {
    // Each module is independent: one throwing must not stop the rest.
    [
      initHeader, initMenu, initDropdowns, initSubmenus, initReveal, initCounters,
      initAccordion, initCollections, initLightbox, initToTop, initParallax, initForms,
    ].forEach(fn => {
      try { fn(); } catch (err) {
        console.error(`[hcf] ${fn.name} failed:`, err);
        if (fn === initReveal) revealAll();
      }
    });

    // Belt and braces: anything still hidden after 3s gets shown.
    setTimeout(() => {
      $$('.reveal:not(.is-in), .reveal-words:not(.is-in)').forEach(el => {
        const r = el.getBoundingClientRect();
        if (r.top < window.innerHeight) el.classList.add('is-in');
      });
    }, 3000);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
