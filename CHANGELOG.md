# Changelog

Notable changes to the CUSBRO theme, block by block. See
`PROJECT_ROADMAP.md` for current status, QA detail, and what's next —
this file is the short version, for "when/why did that change" later.

No dates on version headers until there's a real Git tag to back them
up — a guessed or backfilled date is worse than no date, it just looks
authoritative. Once a version is actually tagged, add the date (or the
tag name) under its heading, e.g. `v0.7` / `2026-07-25` or `v0.7` /
`Tag: v0.7`.

**Current stable release:** `calculator-v1.0` *(tagged, merged to
`main`, pushed)* — update this line each time a new version gets its
own tag, so it's always obvious at a glance which entry below is
actually live vs. still in progress.

## v0.7 — Cases 🔒

Built, technically QA'd, and visually QA'd (Desktop/Laptop/Tablet/
Mobile) — Release intentionally held open, see PROJECT_ROADMAP.md's
content-gating rule. Not tagged: this version isn't shippable yet.

- 6 demo cases (3 passenger cars + truck + bus + motorcycle) as
  placeholder content — badge + SVG icon per category (icons reused
  from Services, no new colors added — stays within the navy/orange
  Architecture Rules)
- CTA scoped locally (`.cases__cta .btn`) rather than reusing the
  sitewide `.btn--primary`, which still carries the old pre-rebrand
  blue (`#0C5ADB`) instead of this section's navy/orange
- Found and fixed a real sitewide bug during QA: `.about-grid`'s grid
  items had no `min-width: 0` (the classic grid/flex "won't shrink
  below content" trap) and `overflow-x: hidden` was missing on `html`
  (only on `body`) — together these caused horizontal overflow on
  mobile that made unrelated sections look broken in the same
  screenshots
- Content is explicitly fictional pending real client cases (Phase 2:
  content-only swap, no HTML/CSS/JS changes)

## v0.6 — Calculator ✅

Tag: `calculator-v1.0`

- Rebuilt the customs calculator on `feature/calculator-refactor`:
  reframed from "customs-duty calculator" to lead-conversion tool,
  config-driven JS (`CALC_CONFIG`, no magic numbers)
- Deleted the old `inc/customs/` PHP engine (10 files) — dead weight,
  zero callers
- Truck/bus excise: weight tier × age bracket × new-vs-used
  (registration history), age computed from an exact registration
  **date** (not just year), with a corrected tier boundary — exactly
  5 full years already counts as the next bracket, not the base rate
- Car excise verified to already match Law № 2611-VIII exactly;
  removed the incorrect flat hybrid rate — hybrids are taxed by their
  combustion engine's ignition type, split into explicit
  `hybrid_petrol`/`hybrid_diesel` options instead of guessing
- Electric duty exemption (0%) corrected to passenger cars only —
  electric trucks/buses/motorcycles pay the standard 10%; large diesel
  buses (>5000cm³) carry 20%, not 10%
- Motorcycle form restricted to petrol/electric (no diesel/hybrid
  variants exist); year field dropped where the vehicle's excise
  formula never reads it (electric cars, motorcycles, trucks/buses)
- Live NBU exchange rates (`inc/helpers.php::cusbro_get_nbu_rates()`,
  transient-cached, date-pinned) replacing static hardcoded rates;
  removed a since-expired VAT exemption clause as dead code
- Result now shows in whichever currency the car was priced in, with
  UAH + the other major currency as smaller reference lines; pension
  fund shown as its own line, not folded into the total
- Fixed CTA misdirection: Hero and Process both promised generic
  "Розрахувати митні платежі" but only linked to the vehicle-only
  calculator — reworded to be honest about scope
- Fixed a sitewide asset cache-busting bug: every CSS/JS file shared
  one static version string, risking stale browser cache after any
  edit — switched to per-file `filemtime()` versioning
- Found and removed dead pre-refactor calculator files that survived
  in Local Sites after being deleted in Git
- Cross-validated multiple test cases (truck, bus, electric car)
  against an independent reference calculator (mdoffice.com.ua) —
  duty/excise/VAT matched to the cent
- Added a hover ripple animation to Process's step numbers
  (`prefers-reduced-motion` respected); fixed two unrelated mobile
  bugs found along the way (Services CTA text overflow, Hero H1
  edge gutter at ≤480px)

## v0.5 — Process

- "Як ми працюємо" 4-step stepper, "Ваша роль / Наша робота" split per
  step, CTA bridging into the Calculator
- Fixed the mobile connecting line (percentage `height` on an
  absolutely-positioned element resolves to 0 against an auto-height
  ancestor — switched to `top`/`bottom`)

## v0.4 — Advantages

- 6-item advantages grid, deliberately not a reuse of the Services
  card pattern per an explicit "no banal icon+text cards" brief
- Numeral contrast fix: accent orange as text failed AA — moved accent
  to a decorative bar instead

## v0.3 — Services

- 6 service cards (legkovi/vantazhni/avtobusy/mototsykly → calculator,
  import/export tovariv → contact)
- Card-link hover contrast fix: accent orange text on white failed AA
  — kept text navy, moved accent to icon/underline only

## v0.2 — Hero

- Full rebrand: navy/orange palette, Manrope, new copy, contact card
  with real Telegram/Viber/WhatsApp/phone channels
- CTA contrast fix: white text on accent orange failed AA — switched
  to navy text
- Fixed `#contact` pointing at a dead, handler-less form
  (`template-parts/contact.php`) — the real, working anchor was always
  `cta.php`, just needed its placeholder phone number and copy fixed

## v0.1 — Header + theme foundation

- Header rebuild matching the new design system, mobile menu,
  `aria-expanded`
- Theme scaffold, `functions.php` include pattern, base `main.css`
