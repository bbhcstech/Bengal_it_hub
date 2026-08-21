# Bengal IT Hub — Homepage Redesign (index.html only)

This package contains ONLY the updated homepage, as requested — the rest
of the site (services, products, industries, admin panel, etc.) is
unchanged from what you already have.

## What changed

The homepage now has a **structurally distinct layout** from the Sibiri
Innovation site, while keeping the exact same fonts (Fraunces + Outfit)
and color palette (teal + gold from your logo):

- **Hero**: replaced the "framed screenshot" hero with an animated orbit
  emblem built from your logo's globe/network icon — no photo needed.
- **Stats**: moved into a full-width dark band with icons, instead of a
  plain text row.
- **Who We Are**: a large italic pull-quote statement, followed by
  alternating zig-zag image/text rows instead of stacked cards.
- **Services**: a horizontal scroll-snap carousel instead of a grid.
- **Vision 2030**: radial progress rings instead of plain numbers.
- **Clients**: an auto-scrolling marquee strip instead of a static grid.
- **Partners / Tech Innovation / Awards**: combined into one tabbed
  "Ecosystem at a Glance" section (click the pill buttons to switch)
  instead of three separate repetitive card-grid sections.
- **HackFest**: a diagonal-clipped dark section for a sharper edge than
  the soft wave curves used elsewhere.
- Angled (diagonal) section dividers replace the soft wave dividers in a
  few places, as another point of visual difference.

## How to install it

Drop these three files into your existing `bengal-demo` folder, overwriting
what's there:

```
index.html                  → bengal-demo/index.html
assets/css/site.css         → bengal-demo/assets/css/site.css
assets/js/site.js           → bengal-demo/assets/js/site.js
```

`site.css` and `site.js` were only **added to**, not rewritten — every
other page in your existing folder still works exactly as before, since
all the new CSS classes and the one new bit of JS (the ecosystem tab
switcher) are scoped to homepage-only elements.

## How to preview

```bash
cd bengal-demo   # your existing folder, after copying the files in
python3 -m http.server 8080
# visit http://localhost:8080/index.html
```
