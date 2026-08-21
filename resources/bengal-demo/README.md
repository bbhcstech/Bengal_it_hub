# Bengal IT Hub — UI/UX Demo (Static Mockup)

A redesign of [bith.utsavonestop.com](https://bith.utsavonestop.com) using the
**same real content** from that site, rebuilt in a premium visual system
matching your logo's teal + gold palette. This is a **static HTML/CSS/JS
design demo** — not a working backend/CMS. No database, no live forms.

## What's new in this revision

- **Typography** now uses **Fraunces** (elegant italic display serif) for
  headlines and stat numbers — matching the editorial feel of the
  [Tejaswini Gautam](https://tejswini-staging.vercel.app) reference site
  you provided — paired with **Outfit** for navigation/buttons/labels.
  *(Note: I couldn't extract the literal font-family from that site's
  compiled CSS with the tools available, so this is a close aesthetic
  match rather than a pixel-identical font. If you know the exact font
  name, let me know and I'll swap it in directly.)*
- **Admin panel** added: `admin/login.html` (premium split-screen, teal/gold
  branded) and `admin/dashboard.html` (stat cards, an organic-traffic
  chart, an SEO health donut chart, HackFest registrations table, quick
  actions, team activity).
- Fixed a CSS performance bug: a universal `* { transition: ... }` rule
  was scoped down to the ~20 elements that actually need animated
  theme-switching, instead of applying to every element on the page.
- Content, navigation structure and color palette are unchanged from the
  previous revision — only the UI/UX polish and admin pages are new, per
  your request to change the UI without touching the content.

## How to view it

Open `demo-index.html` in any browser, or run a local server:

```bash
cd bengal-demo
python3 -m http.server 8080
# then visit http://localhost:8080/demo-index.html
```

## Design system — "Bengal Signal"

Colors were sampled directly from your logo image (not eyeballed):
- **Deep petrol teal** `#1E4A5F` (primary) — from the logo's textured background
- **Warm gold** `#E8AA3D` (accent) — from the globe icon and underline bar
- **Outfit** (bold geometric sans, matching "BENGAL" in the logo) for all
  headings and UI text; **Inter** for body copy. No serif — this is a
  tech/corporate identity, not an editorial one.
- Full animated dark/light mode toggle.
- Signature details: blob-mesh hero background, film-grain texture, mega-menu
  navigation, numbered service cards, wave section dividers.

All defined as CSS variables at the top of `assets/css/site.css` — change
the palette or fonts from one place.

## Content — carried over from the real site

Every section on the real homepage is reproduced with the actual copy:
hero, stats (500+ projects, 98% satisfaction), Who We Are (mission/vision/
positioning), Innovation Ecosystem, Vision 2030, all 10 services, the
4-step delivery process, Growth Engine, 12 real clients + 3 case studies,
4 product lines, 6 industries, partner categories, Tech Innovation
channels, Awards & Recognition, the full HackFest PRAGATI 2026 section,
Tech Talk channels, and all 15 real FAQ questions.

## What's included

- **Home** — the full page above, in one scroll
- **Vision 2030**, **About Us**
- **Services** — index (all 10) + one fully-designed detail page
  (AI-Marketing) + lightweight stub pages for the other 9 so every
  mega-menu link is clickable
- **Products** — index (all 4) + one full detail page (Software Development)
  + stubs for the rest
- **Industries** — index (all 6) + one full detail page (Health Care) +
  stubs for the rest
- **Our Clients** (all 12 + case studies), **Our Partners**, **Tech
  Innovation** hub + TechBiz, **Awards & Recognition**
- **HackFest PRAGATI 2026** — full standalone page with register/sponsor
  sections and anchor links matching the real site's structure
  (#guest, #adviser, #panelists, #faq, #venue, #register, #sponsor)
- **Blog**, **FAQ** (all 15 real questions), **Contact** (need-based form)

## Full vs. stub detail pages

To keep this demo a manageable size, one fully-designed example was built
per repeating category (Services, Products, Industries). The rest use a
lighter shared template linking back to the full example — clearly noted
on those pages themselves. When this becomes a real build, every page
would use the full template with complete content.

## Navigation

Mega-menu structure: **Vision | Services | Products | Industries |
Insights | HackFest 2026**, with a **Get Your Place** CTA — organized
from the real site's flat link list into grouped, scannable menus.

## Bugs found and fixed during QA

Two real issues were caught and fixed before this was packaged:
1. A CSS `background:` shorthand conflicting with a `transition:
   background-color` rule was silently breaking dark-mode switching and
   making the footer render invisible. Fixed by using `background-color`
   directly throughout.
2. On very long pages (this homepage has ~100 scroll-reveal animated
   elements), the original reveal system could miss elements during fast
   scrolling. Hardened with a wider detection margin and a continuous
   fallback sweep — verified with realistic mouse-wheel scroll testing
   (97/97 elements now reveal correctly).
