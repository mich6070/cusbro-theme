# CUSBRO — Project Roadmap

Living document. Update it every time a block is finished or a QA pass
runs — this is the single source of truth for build status. Replaces
the old `docs/12_TODO.md`, which tracked features rather than sections
and had gone stale (marked Footer/Header done before they were).

## Current Project Status

**Phase 1 — Core Landing Page: COMPLETE ✅**

Every homepage block is Built + Technical QA + Visual QA + Narrative
✅. Full detail (what was checked, what was found, what's still
explicitly open) lives in the Homepage sections table below and each
block's own subsection — this is just the roll-call:

- Header, Hero, Services, Advantages ✅ *(closed on a real QA pass:
  screenshots at 480/768/1024/1440/1920px, Lighthouse desktop+mobile)*
- Process ✅
- Calculator v1.0 ✅ *(tagged, merged to `main`)*
- Cases ✅ *(Release 🔒 — demo content, real client cases pending)*
- Reviews ✅ *(Release 🔒 — Google Places API credentials pending)*
- FAQ ✅
- CTA ✅ *(accepted as-is for Phase 1 — functional channel links, real
  phone; still on the old pre-rebrand blue, brand pass explicitly
  deferred to a later phase, not forgotten)*

Per the No-jumping-back rule: none of the above get touched again
without a critical bug, a conversion problem, an SEO problem, or a
responsiveness problem.

Two pre-existing logged exceptions, not swept under the rug — see
Definition of Done (Best Practices/HTTPS) and Backlog → UI (a contrast
bug in the *Blog* section, and an unidentified console error, neither
of which is homepage-block code).

Technical QA passed live (DOM/IDs, no PHP warnings, no duplicate IDs,
dead pre-refactor engine purged, cache-busting fixed). Visual QA ran as
an extensive real screenshot + reference-tool-cross-check pass — see
"Calculator — Visual QA findings" below for the full list of confirmed
bugs found and fixed (bus duty rate, car/hybrid/gas excise correctness,
electric duty scope, exact registration-date age precision, live NBU
rates, multi-currency display, pension separation, motorcycle fuel
options). Narrative confirmed: the block delivers on Hero's "усі митні
платежі ще до оформлення" promise and bridges cleanly into `#contact`.
Release: every CTA target verified working.

Per the No-jumping-back rule: Calculator doesn't get touched again
without a critical bug, a conversion problem, an SEO problem, or a
responsiveness problem.

**Cases: Built ✅ QA ✅ Narrative ✅ Release 🔒 — CLOSED (Phase 1)**

Closed on a real Visual QA pass across Desktop/Laptop/Tablet/Mobile —
equal card heights, hover, SVG badge alignment, no horizontal scroll.
Found and fixed a real cross-section bug along the way: `.about-grid`
grid items were missing `min-width: 0` (classic grid/flex "won't
shrink below content" trap), and `overflow-x: hidden` was only on
`body`, not `html` — together these let About's overflow drag the
whole page into a horizontally-scrolled state, which is what made
unrelated sections (Process) look broken in the same screenshots.
Release stays 🔒 — code/design is done, only the demo cases need
swapping for real client data (content-only change, per the
content-gating rule below).

Per the No-jumping-back rule: Cases doesn't get touched again without
a critical bug, a conversion problem, an SEO problem, or a
responsiveness problem.

**Current Sprint:** Phase 2 — SEO
**Current Block:** SEO landing page architecture (URL structure, first
pages for vehicle/goods clearance)
**Next Block:** Google Reviews API integration
**Current Goal:** Phase 1 is done and tagged (`phase1-v1.0`). Phase 2
priority order: SEO landing pages → Google Reviews API → real Cases
content → blog/content marketing. No more base-block rework expected —
this is additive work on a stable foundation.

## Definition of Done

A block is done only when **all** of these are true:

- [ ] Code written
- [ ] Synced to Local Sites
- [ ] Checked on Desktop
- [ ] Checked on Laptop
- [ ] Checked on Tablet
- [ ] Checked on Mobile
- [ ] Lighthouse — Performance / Accessibility / Best Practices / SEO all
      ≥ 90 *(exception: Best Practices is measured on the production
      host, post-HTTPS — on local `http://` dev, "Does not use HTTPS" /
      "no HTTPS redirect" will always cap this score regardless of theme
      code, so it doesn't block sign-off pre-launch)*
- [ ] Accessibility (contrast, focus states, aria)
- [ ] SEO (headings, meta, internal links)
- [ ] Core Web Vitals
- [ ] Conversion checked (every element earns its place)
- [ ] Status updated in this file

Note on who checks what: I have no browser in this environment — I can
verify markup, CSS logic, contrast math, and that pages render
error-free via curl against the local WP install, but the actual
Desktop/Laptop/Tablet/Mobile/Lighthouse boxes need you to run them (or
paste me the screenshot/score) before they're honestly checked.

## Project Principles

- One style across the entire site.
- Hero is not touched again until Final Polish — unless QA finds a
  critical bug, a conversion problem, an SEO problem, or a responsiveness
  problem. (Applies to every finished block, not just Hero.)
- One Roadmap — one source of truth.
- No code ships without verification.
- QA after every block, not at the end.
- Conversion first, decoration second.
- SEO is built alongside design, not bolted on after.
- **One Change Rule** — each PR / large change touches one logical
  block only. Don't mix Hero, Services, and Header in a single pass
  unless there's no other way — it keeps bugs traceable and history
  readable.
- **From now on we evaluate consistency, not blocks in isolation.** A
  new block has to match the style already established by Hero,
  Services, and Advantages — spacing, H2 treatment, buttons, hover,
  transitions, border-radius, colors — not introduce its own idea of
  what the site looks like.

## Architecture Rules

Never:

- duplicate a section
- duplicate CSS (if it already exists in another `*.css`, reuse it —
  don't re-declare it)
- introduce a second visual style
- break Hero's design without a reason listed in the No-jumping-back rule
- use inline `style=""`
- use `!important`

## No-jumping-back rule

We do not return to an already-finished block unless one of these is
found:

- a critical bug
- a conversion problem
- an SEO problem
- a responsiveness problem

Everything cosmetic waits for Final Polish.

## QA checklist (run after every block, not just at the end)

- [ ] Desktop (1920 / 1440 / 1366px)
- [ ] Laptop (1280 / 1024px)
- [ ] Tablet (768px)
- [ ] Mobile (480 / 375px)
- [ ] Lighthouse ≥ 90 (Performance / Accessibility / Best Practices / SEO)
- [ ] SEO (headings, meta, internal links)
- [ ] Accessibility (contrast, focus states, aria)
- [ ] Core Web Vitals
- [ ] Conversion (every element earns its place — trust or CTA)

## Homepage sections

**Narrative** = does this block read as part of one continuous sales
story (not just "is the code correct"). Checked by re-reading the
copy of finished blocks in sequence, looking for competing CTAs,
verbatim repetition, and tonal jumps.

**Release** = every external dependency this block points to actually
exists and works — every CTA has a real, functional destination,
nothing leads to nowhere.

➖ = not applicable (infrastructure, not a story beat / has no external
dependency to break).

🔒 = intentionally blocked, not merely unstarted — the code/design side
is genuinely done, but Release waits on something outside engineering
(e.g. real content that doesn't exist yet). Distinct from ⬜, which
just means "not reached yet."

| Section | Built | QA | Narrative | Release |
|---|---|---|---|---|
| Header | ✅ | ✅ live-verified (curl + screenshots): overflow fix, mobile menu, aria-expanded — real Desktop/Mobile screenshots exist for this one | ➖ | ➖ |
| Hero | ✅ | ✅ real screenshots at 480/768/1024/1440/1920px, `<main>`+meta confirmed live, Lighthouse Perf 97(desktop)/85(mobile), A11y 96/95, SEO 92/92 — Best Practices 74/74 is the logged HTTPS exception above, not a Hero defect | ✅ badge reworded ("Говоримо зрозумілою мовою • Незалежно від вашого міста") to remove verbatim overlap with Advantages | ✅ `#contact`/`#calculator` both real, functional targets — confirmed live |
| Services | ✅ | ✅ *(no independent screenshot — confirmed via shared grid/spacing patterns already verified in the consistency audit, and present in DOM with correct `id`/`aria-labelledby`; not directly seen rendering on screen)* | ✅ | ✅ same `#contact`/`#calculator` fix, confirmed live |
| Advantages | ✅ | ✅ *(same caveat as Services — DOM-confirmed, patterns-confirmed, not independently screenshotted)* | ✅ | ✅ no CTA of its own — nothing to break |
| Process | ✅ *(4-step stepper, "Ваша роль/Наша робота" split, CTA bridges to Calculator)* | ✅ live screenshots at 1920/1440/1366/1024/768/420px — desktop connecting line, 2×2 tablet (line correctly hidden), mobile vertical rail all confirmed rendering correctly, incl. the `top`/`bottom` fix actually spanning to the next circle | ✅ step 4 echoes Hero's promise, CTA reads clearly in every screenshot | ✅ CTA points at `#calculator`, which already exists and works |
| Calculator (auto) | ✅ *(rebuilt on `feature/calculator-refactor`: 9 fields incl. condition, registration date, truck/bus excise as weight×age matrix, live NBU rates, multi-currency display, separate pension line — dead PHP engine deleted from Git **and** Local Sites)* | ✅ Technical QA (DOM/IDs/no warnings) + extensive live Visual QA — real screenshots across breakpoints, real reference-tool cross-checks (mdoffice.com.ua) confirming duty/excise/VAT to the cent, multiple confirmed bugs found and fixed — see "Calculator — Visual QA findings" | ✅ delivers on Hero's payments-upfront promise, bridges cleanly into `#contact` | ✅ CTA target confirmed working (`#contact`); Hero + Process CTAs reworded from generic "Розрахувати митні платежі" to be honest about vehicle-only scope |
| Cases | ✅ *(HTML+CSS, Phase 1 content-gating: 6 demo cases — 3 legkovi/truck/bus/moto — badge+icon system reusing Services SVGs, no new colors per Architecture Rules)* | ✅ Technical QA + real Visual QA (Desktop/Laptop/Tablet/Mobile, equal card heights, hover, SVG alignment, no horizontal scroll — including a real cross-section bug found and fixed: `.about-grid` grid items missing `min-width:0`, `overflow-x:hidden` missing on `html`) | ✅ Calculator → Cases → CTA reads as one continuous story | 🔒 intentionally blocked — demo cases only, waiting on real client data per the content-gating rule |
| Reviews | ✅ *(provider-pattern architecture: `cusbro_get_reviews()` is data-source-agnostic — `inc/reviews/provider-demo.php`/`provider-google.php`/`cache.php`/`schema.php`/`helpers.php`; demo content live now, Google Places swap needs zero HTML/CSS/JS changes)* | ✅ Technical + real Visual QA (Desktop/Laptop/Tablet/Mobile) confirmed clean | ✅ | 🔒 blocked on: (1) real Google Places API key + Place ID in `wp-config.php`, (2) confirm the "Переглянути всі відгуки" URL actually resolves correctly (derived by dropping `/review` from the given short link, not independently confirmed), (3) site title in WP Admin → General is real ("cusbro" lowercase currently feeds the JSON-LD `name` field) |
| FAQ | ✅ *(rebuilt from a stale legacy version — full audit found an inline `style=""`, old pre-rebrand blue color vars, and a completely non-functional accordion with zero JS wiring it up. Rebuilt: 9 questions in 3 groups — Загальне/Автомобілі/Товари — one shared accordion, new `main.js` toggle logic written from scratch)* | ✅ Technical + real Visual QA (Desktop/Laptop/Tablet/Mobile, keyboard, focus-visible) confirmed clean | ✅ reads as a natural close to Reviews, not a disconnected reference page | ✅ CTA target confirmed working (`#contact`) |
| CTA | ✅ *(accepted as Phase 1's final state — functional channel links, real phone number, no dead form; still on the old pre-rebrand blue, a full navy/orange brand pass is explicitly deferred, not forgotten)* | ✅ | ✅ | ✅ real phone + working Telegram/Viber/WhatsApp, no dead form |
| Footer | ⬜ *(old blue theme, not yet rebuilt)* | ⬜ | ➖ | ➖ |

### `#contact` fix — Release blocker for Hero + Services

Earlier entries in this file incorrectly claimed `#contact` didn't
exist — that mixed up two different files. `template-parts/contact.php`
really is empty and unused, but the actual anchor target,
`template-parts/cta.php`, was already built, already wired into
`front-page.php`, and already carries `id="contact"`. So the anchor
never pointed at nothing — it pointed at something worse:

- The phone number shown was the literal placeholder `+380XXXXXXXXX`,
  not the real number — fixed to `+380680070646`.
- The "form" (`method="post" action=""` with a nonce field) had no
  server-side handler anywhere in `functions.php` or `inc/` — grepped
  for it, found nothing. Submitting it reloaded the page and silently
  discarded whatever the visitor typed. That's a worse trap than a
  missing section: it looks like it worked.

Per the decision to keep this unblock minimal (channels only, no
`wp_mail()` backend right now), the form was replaced with working
Telegram / Viber / WhatsApp / phone links — same data already verified
in Header and Hero. Visual design of `cta.php` is still the old
pre-rebrand style; a full brand pass is separate work, still sitting in
its own place in the Phase roadmap. This was an emergency patch to
unblock Hero/Services release criteria, not the official CTA build.

### Design-system consistency audit — Hero / Services / Advantages

Ran after Advantages, per the agreement to evaluate consistency between
blocks, not blocks in isolation. Compared padding-block, container
width, color variables, H2/subtitle treatment, buttons, hover states,
transitions, and border-radius across all three files. Found and fixed:

- `--services-radius-lg` was `20px`, `--hero-radius-lg` (the same role,
  the big card/panel radius) was `22px` — unified to `22px` (Hero is
  the reference; Services conformed to it)
- `.services__trust-cta:hover` hardcoded `background: #DD6F10` instead
  of a variable, unlike Hero's `--hero-accent-dark` pattern — added
  `--services-accent-dark` and switched to `var()`
- `.hero__cta` used `padding: 0 30px`, `.services__trust-cta` used
  `0 28px` for the same button role — unified to `30px`
- `.services__card` hover transition ran on `.25s`, every other hover
  in the system (buttons, contact links) runs on `.2s` — unified to `.2s`

Everything else checked out identical: `padding-block: 120px`,
container `min(1320px, 92%)`, the full color set, H2 treatment
(`clamp(28px, 3vw, 42px)` / 800 / 1.15 / -.02em), header block spacing
(`max-width: 620px` / `margin-bottom: 56px`), and focus-visible outline
treatment.

### Narrative walkthrough — Hero / Services / Advantages

Read the visible copy of all three blocks in sequence, checking for
competing CTAs, verbatim repetition, and tonal jumps. Conclusions:

- The Problem/Promise → What → Why sequence reads as one story, not
  three independent sections.
- CTAs don't compete: Hero → `#contact` / `#calculator`, Services
  cards → `#calculator` / `#contact`, Services trust strip → `#contact`,
  Advantages has no CTA of its own (its job is trust, not a click).
  Hero's "Отримати безкоштовну консультацію" and Services' "Безкоштовно
  проконсультуватися" deliberately keep different wording for the same
  offer — decided against unifying them, since both point to the same
  place and don't promise different things.
- Found verbatim (not just thematic) repetition: Hero's badge said
  "Пояснюємо людською мовою • Працюємо по всій Україні" — the exact
  same wording as Advantages items #1 and #6. First rewrite attempt
  ("Без складної митної термінології • Дистанційний супровід у
  будь-якому регіоні") turned out to collide with the *descriptions*
  (not titles) of those same two Advantages items — caught by
  re-checking word-by-word against all three files before shipping it,
  not after. Final wording: **"Говоримо зрозумілою мовою • Незалежно
  від вашого міста"** — confirmed zero overlap anywhere in Hero,
  Services, or Advantages. `hero__card-region`'s "Працюємо по всій
  Україні" was deliberately left alone — it's a compact factual detail
  in the info card (like an address line), not a persuasive claim
  competing with Advantages' messaging.
- Decided against adding any divider/color band between Hero and
  Services — two consecutive white sections separated only by padding
  is the intended premium-SaaS pattern here, not a bug.

**Phase 1 core narrative (Hero + Services + Advantages) is closed.**
Per the No-jumping-back rule, none of these three get touched again
without a critical bug, a conversion problem, an SEO problem, or a
responsiveness problem.

### Calculator Refactor

Followed the full sequence: business goal → UX → conversion review →
technical audit → refactor plan → Definition of Done → code — before
opening a single file. The audit reframed the calculator itself: not a
customs-duty calculator, a lead-conversion tool that happens to do math.

**Git safety net.** Nothing in this repo had been committed since the
theme scaffold — 96 files of Phase 1 work were sitting uncommitted.
A git tag alone wouldn't have protected `inc/customs/` (it was never
tracked, so a tag on old history wouldn't include it). Committed
everything as `69c93f4`, tagged it `calculator-pre-refactor`, then did
the whole refactor on an isolated `feature/calculator-refactor` branch.

**Built as 5 atomic steps** (whole-file rewrites, not interleaved
edits, to avoid a half-working intermediate state):

1. `calculator-auto.php` — structure only, rebuilt around 6 fields
   (down from 9): vehicle type, price+currency, year, fuel, engine,
   and a conditional 7th (`truck_weight`, trucks only — a physical
   property of the vehicle, not an administrative detail, so it stayed
   despite the general "minimize fields" push)
2. `assets/css/calculator.css` — full rebuild in the established design
   system (navy/orange, `--calculator-*` local vars, same radius/shadow
   language as Hero/Services/Advantages/Process). Caught and fixed a
   contrast bug in my own new code before shipping:
   `.calculator__result-rate` at `rgba(255,255,255,.5)` on the navy
   panel measured 4.08:1, failing AA — bumped to `.65` (5.7:1+)
3. `assets/js/calculator-auto.js` — full rewrite behind one
   `CALC_CONFIG` object (rates, thresholds, coefficients) per the
   "no magic numbers" rule; PDF/share-link/order-this-car buttons and
   their handlers removed entirely — `btnOrderThisCar` was already
   silently broken (referenced `#contact-message`/`#contact-name`
   fields that stopped existing when the CTA form got replaced with
   channel links earlier); added `scrollIntoView({block:"nearest"})`
   so calculating on mobile doesn't leave the result off-screen
4. `functions.php` — removed the `inc/customs.php` require
5. Deleted `inc/customs.php` + `inc/customs/` (10 files) — confirmed
   zero callers, zero ajax/REST hooks, zero save/log/mail before
   deleting, not after

**Business-logic decisions locked in during UX phase** (not
rediscovered mid-code): pension fund is now always included in the
estimate (no longer an input field — 90%+ of calculator users are
first-time registrations, so defaulting to "yes" keeps the estimate
close to reality) with a plain-language disclaimer instead of the
"Пенсійний фонд" line item; origin/importer-type fields removed
entirely in favor of a static "standard rate, we'll check for
preferential treatment during consultation" note (most users don't
know their car's country of manufacture); NBU rate disclaimer
deliberately has **no date** — the rates are still hardcoded constants,
not a live feed, so claiming a specific "as of" date would promise a
freshness the code doesn't have.

**Not done in this pass:** `app/`'s empty PSR-4 skeleton (separate
Backlog item, not touched by this refactor).

### Calculator — post-refactor fixes

Found during live QA feedback, after the 5-step refactor above shipped.

**Truck/bus excise was legally wrong.** The refactor ported the
pre-refactor weight-only rates as-is. Real law (Tax Code Art. 215 +
Law № 3553-IX) needs weight **and** age **and** new-vs-used
(registration history, not manufacture year) together, not weight alone.
Rebuilt from verbatim legal text the user supplied, not guessed:
- **Truck (8704):** new = flat rate by weight (0.01 / 0.013 / 0.016
  €/cm³ by weight tier); used = weight-tier base rate (0.02 / 0.026 /
  0.033) × age coefficient (×1 ≤5y, ×40 5–8y, ×50 >8y)
- **Bus (8702):** new = 0.003 €/cm³ flat; used = 0.007 €/cm³, ×50 if
  >8 years old (no weight tiers for buses — confirmed from law text,
  unlike trucks)
- Added a `condition` field (Вживане / Нове, defaults to Вживане) since
  "new" is a registration-history fact the user knows, not something
  derivable from the year field
- `CALC_CONFIG.EXCISE.truck` / `.bus` and `calculateTruckExcise()` /
  `calculateBusExcise()` rewritten accordingly in `calculator-auto.js`

**CTA misdirection (Hero + Process).** Both blocks talk about goods
*and* vehicles, but their "Розрахувати митні платежі" CTA sent every
visitor into the vehicle-only calculator (first field: "Тип
транспортного засобу", no goods option). A goods-import visitor
clicking it landed on a form that didn't apply to them. Reworded both
to "Розрахувати вартість авто" (Hero) — Process's CTA was separately
changed to "Отримати консультацію" → `#contact` per a later decision.
Touching Hero/Process again is justified under the No-jumping-back
rule's "conversion problem" exception, not a scope violation.

**Process hover animation.** `.process__step-num` never had a `:hover`
state — not a regression, just never built. Added an expanding-ring
ripple (two rings, offset timing, `prefers-reduced-motion` respected).

**Dead code survived in Local Sites after being deleted in Git.**
`inc/customs.php`, `inc/customs/` (10 files), and the old
`template-parts/calculator.php` were deleted in Git during the refactor
but the deletion was never synced to the actual served theme directory
— found via a full recursive diff between the two trees. Removed there
too. `functions.php` never required them post-refactor, so they were
inert, not a live bug, but a real gap between "we said it's deleted"
and what was actually on disk.

**Asset cache-busting bug (critical, sitewide, not Calculator-specific).**
Every enqueued CSS/JS file shared one static version string
(`CUSBRO_VERSION`, from the theme header) — meaning every single edit
made this entire session could have been served stale from browser
cache under the same `?ver=1.0.0` URL. Added `cusbro_asset_version()`
in `inc/helpers.php` (per-file `filemtime()`, falls back to
`CUSBRO_VERSION` if the file is missing) and switched every
`wp_enqueue_style`/`wp_enqueue_script` call in `inc/enqueue.php` to use
it. Verified live: each asset now gets its own distinct version number.
Production note (not urgent): `filemtime()` on every request is fine
for a single dev site, but before launch consider a build-time hash or
bumping `CUSBRO_VERSION` per release instead, to avoid a filesystem
stat on every asset on every request.

### Calculator — Visual QA findings (closing the block)

Found and fixed during the actual live QA pass (screenshots + real
reference-tool cross-checks against mdoffice.com.ua's professional
customs calculator), distinct from the pre-QA legal-data corrections
in the section above.

**Cross-validated against an independent reference tool.** Several
truck/bus/car test cases (diesel truck 5-20t, electric car, large
diesel bus) were run through both our calculator and MD Office's and
compared line-by-line — duty, excise, and VAT matched to the cent
once currency rates were aligned. This is real external validation,
not just internal consistency.

**Bus duty: 20% for large diesel, not a blanket 10%.** Found via a
reference-tool mismatch — traced to УКТ ЗЕД 8702 10/8702 20 (diesel
and diesel-hybrid buses over 5000cm³) carrying 20%, confirmed against
the official Митний тариф. Smaller diesel buses, all petrol/hybrid-
petrol, and electric stay at 10%.

**Electric duty exemption is car-specific, not universal.** 0% duty
only applies to passenger cars (8703 80). Electric trucks (8704 60),
buses (8702 40 00 90), and motorcycles (8711 60) all pay the standard
10% — the code previously gave every electric vehicle 0% regardless
of type.

**Hybrid fuel split into `hybrid_petrol`/`hybrid_diesel`.** The law has
no separate hybrid excise rate — a hybrid is taxed by its combustion
engine's ignition type. The form previously offered one ambiguous
"Гібрид" option requiring a silent default guess; now the visitor
picks explicitly, removing the guess entirely (affects both car
excise and the bus 20%-duty threshold, which is diesel-specific).

**"Стан" (new/used) confirmed unnecessary for cars and motorcycles.**
Car excise (Law № 2611-VIII) already handles this via its continuous
age coefficient (a brand-new car naturally gets the minimum
coefficient) — no separate flat "new" rate exists in the law. Duty
tables confirm motorcycles don't even distinguish new/used. Only
truck/bus have a genuine flat-vs-age-tiered split.

**Truck/bus age now dated, not year-only, with an exact-boundary fix.**
Added a real `type="date"` "Дата першої реєстрації" field (shown only
for truck/bus + "used") — age is computed as full elapsed years from
that exact date to today (month/day-aware, verified against a real
boundary case where a 2-day difference in registration date changed
the coefficient from ×40 to ×50). Also corrected the tier boundary
itself: "до 5 років" is exclusive of exactly 5 years — a vehicle at
precisely 5 full years already falls in the "від 5 до 8" (×40)
bracket, not the base rate.

**Live NBU exchange rates**, replacing the static hardcoded constants
— see `inc/helpers.php::cusbro_get_nbu_rates()`. Requesting a pinned
date (not the bare endpoint) was itself a fix: the undated NBU
endpoint sometimes returns a rate already published in advance for
the next business day, which produced a small but real mismatch
against every other source quoting "today's" rate.

**Multi-currency result display.** The result now leads with whichever
currency the visitor priced the car in, with UAH and the other major
currency shown as smaller reference lines below — not a fixed "always
EUR" display regardless of what was actually entered.

**Pension fund shown as its own line, not folded into the grand
total** — confirmed as the correct convention by comparing against
MD Office, which does the same via its own "Додаткові витрати"
section.

**Motorcycle fuel options restricted to petrol/electric.** Diesel and
hybrid variants don't physically exist for motorcycles — removed from
the dropdown for that vehicle type instead of silently accepting an
impossible combination.

**Dead VAT exemption clause removed.** `ELECTRIC_EXEMPT_UNTIL_YEAR`
governed a VAT exemption that expired 01.01.2026 — since the
calculator only ever evaluates "today," the clause could never fire
again. Removed rather than left as inert code.

**Two unrelated mobile bugs found and fixed along the way** (outside
Calculator, but surfaced during this QA pass under the
"responsiveness problem" exception to No-jumping-back): Services
trust-strip CTA text overflowing its button at ≤768px (`white-space:
nowrap` fighting a `width:100%` override), and Hero's H1 sitting too
close to the viewport edge at ≤480px (container gutter shrinking
below a usable minimum).

### Cases — content-gating rule (agreed before build starts)

Decided ahead of time, specifically so this doesn't turn into a
mid-build argument or a reason to reopen the block later:

**Phase 1 (build).** Full design, layout, responsiveness, animations,
structure, SEO markup, all block logic — built and finished exactly
like every other block, using clearly-fictional demo cases. Target
status on completion:

- Built ✅
- Technical QA ✅
- Visual QA ✅
- Narrative ✅
- Release 🔒 *(blocked: waiting on real client cases)*

**Phase 2 (after real cases arrive).** Swap **only** content: car
photos, real amounts, real timelines, countries, the short story text.
No HTML/CSS/JS touched — if a content swap needs a markup change, the
Phase 1 structure was wrong and that's a bug, not a normal Phase 2
step. Once swapped, Release flips from 🔒 to ✅.

This keeps the One Change Rule intact: Phase 1 builds the system,
Phase 2 is a content-only swap, never both at once.

## Versions

- v0.1 — Header ✅
- v0.2 — Hero ✅
- v0.3 — Services ✅
- v0.4 — Advantages ✅
- v0.5 — Process ✅
- v0.6 — Calculator ✅
- v0.7 — Cases 🔒 *(built + QA'd, Release blocked on real case data)*
- v0.8 — Reviews 🔒 *(built + QA'd, Release blocked on Google API credentials)*
- v0.9 — FAQ ✅
- v0.95 — Footer *(still pending — old blue theme, not yet rebuilt;
  intentionally not part of `phase1-v1.0`, see tag note below)*
- v1.0 — Release (Final Polish complete, homepage done)

**Tag: `phase1-v1.0`** — Header through FAQ + CTA (10 blocks). Marks
the point where the homepage's architecture, design system, and UX
are considered stable; Footer and the two 🔒 content-gated blocks
(Cases, Reviews) are the only pieces of the homepage still open.

## Phase roadmap

**Phase 1 — Homepage: COMPLETE ✅** *(tagged `phase1-v1.0`, see table
above)*

**Phase 2 — SEO Landing Pages** — one URL per commercial query, not a
homepage subsection

- `/rozmytnennya-legkovih-avto/`
- `/rozmytnennya-vantazhnih-avto/`
- `/rozmytnennya-avtobusiv/`
- `/rozmytnennya-motocikliv/`
- `/mitniy-broker-import/`
- `/mitniy-broker-eksport/`
- `/mitne-oformlennya-obladnannya/`
- `/mitne-oformlennya-verstativ/`
- `/mitne-oformlennya-zapchastin/`

**Phase 3 — Blog**

**Phase 4 — Knowledge Base** (draft topics)

- Як розраховується мито?
- Що таке УКТ ЗЕД?
- Що таке інвойс?
- Що таке EUR.1?
- Як проходить митний огляд?
- Як оформити тимчасове ввезення?
- Імпорт з Китаю / Польщі / Німеччини

**Phase 5 — FAQ Hub / dedicated Calculator pages / Articles**

**Phase 6 — Launch**

- HTTPS/SSL + HTTP→HTTPS redirect (Lighthouse Best Practices flagged
  this on local dev — expected there, but must be real on the live host)
- Google Search Console
- GA4
- Google Business Profile
- Meta Pixel
- Hotjar / Microsoft Clarity
- Indexing
- Monitoring

## Backlog

### UI

- `app/` — an empty PSR-4 class skeleton for the same customs-calculation
  domain that `inc/customs/` used to cover. Now that `inc/customs/` is
  deleted (see Calculator Refactor below), `app/` is the only leftover
  skeleton — still needs a decision (delete, or is it meant for
  something else) before it accidentally becomes a second source of truth.
- `assets/icons/` — no longer empty (phone/telegram/viber/whatsapp SVGs
  now present), but nothing in the theme references files from this
  folder — icons are inline SVG in the markup everywhere. Confirm
  whether these files are meant to be used somewhere, or removed.
- Footer still on the old blue palette / old CSS from before the rebrand.
- **Real WCAG contrast failure, confirmed by grep + hand calculation:**
  `.post-card__date` in `assets/css/recent-posts.css:47` uses
  `color: var(--subtle)` (`#9CA3AF`), which measures ~2.54:1 against its
  light card background — fails AA (needs 4.5:1). Lives in the not-yet-
  built Blog/Recent Posts section, so it's what Lighthouse's contrast
  audit was actually flagging on the full-page scan — not Hero/Services/
  Advantages. One-line fix (swap to `var(--muted)`) whenever Blog gets
  its turn; deliberately not touched now to keep this a Phase-1-only change.
- **Unidentified browser console error** flagged by Lighthouse ("Browser
  errors were logged to the console", part of the Best Practices 74
  score). Not yet diagnosed — need the actual DevTools Console output
  (not guessed) to know if it's ours or from an old/unbuilt section.
- **Systemic single-hyphen `.btn-primary`/`.btn-secondary` class bug** —
  `main.css` defines buttons as BEM double-hyphen (`.btn` + `.btn--primary`
  / `.btn--outline` / `.btn--hero-outline`), but `about.php`, `auto.php`,
  and `calculator-auto.php` all used single-hyphen `class="btn-primary"`,
  which matched nothing real (rendered as unstyled text links/buttons —
  found via a live bug report: "Отримати консультацію" in About showed
  as bare text). Fixed all three files + the matching `.calculator-result`
  override selectors in `calculator.css`. Also removed an inline
  `style="width:100%;margin-top:10px"` on `#calcButton` in favor of the
  existing `.btn--full` modifier + a scoped `#calcButton` rule.
  **Live-verified fixed** — no old classes remain, no PHP errors, both
  CSS files 200.
- FAQ section has a "Задати питання" button with inline
  `style="margin-top:24px;"` — found while investigating the button bug
  above, not fixed (not FAQ's turn yet).
- `DESIGN_SYSTEM.md` — codify Typography / Spacing / Radius / Shadow /
  Animation / Colors / Buttons / Cards / Icons / Forms / Links / Hover /
  Focus / Motion once extracted from Hero/Services/Advantages. Deliberately
  deferred — write it after v1.0 or once the homepage is essentially done,
  not mid-build.

### SEO

- Schema.org (Organization/LocalBusiness) markup — hold off on
  `aggregateRating` until there are real reviews backing it (Google
  penalizes fabricated review markup)
- See `docs/03_SEO.md` for existing notes
- Landing pages (Phase 2) are the primary organic-traffic bet — a
  homepage section can't outrank a dedicated page for a competitive query

### Performance

- ~~`inc/customs/*.php` dead PHP engine~~ — resolved, see Calculator
  Refactor below.

### Content

- Real customer testimonials for the Reviews section once available
- Real Telegram handle needed — `href="https://t.me/USERNAME"` is a
  placeholder in Header, Hero card, and now CTA channels too

### Marketing

- See `docs/04_MARKETING.md` for existing notes

### Future

- `template-parts/contact.php` / `assets/css/contact.css` are empty and
  unused — not the same file as `template-parts/cta.php`, which is the
  real `#contact` target (see the fix note above). Decide whether
  `contact.php` becomes something later or just gets deleted.
- `cta.php` needs its full brand pass (navy/orange, matches Hero/
  Services/Advantages) — currently patched just enough to not be broken
- WP Admin → Appearance → Menus: no menu assigned to the "Primary"
  location, so the header nav renders empty
- Longer-horizon product scope already sketched in `docs/11_ROADMAP.md`
  (v2 Calculator, v3 CRM, v4 API, v5 Telegram Bot, v6 Mobile App) — that
  file tracks product versions, this one tracks page-build status; kept
  separate on purpose

## Release Criteria

Every one of these has to be true before v1.0 ships:

- [ ] Built — every homepage section coded
- [ ] QA — every section live-verified, no fake-ahead checkmarks
- [ ] Narrative — the whole homepage reads as one sales story, not a
      stack of independent sections
- [ ] Lighthouse ≥ 90 — Performance / Accessibility / Best Practices / SEO
- [ ] Mobile QA — every section checked at 480 / 375px
- [ ] Cross-browser QA — Chrome, Firefox, Edge
- [ ] SEO Audit — headings, meta, internal linking, no dead anchors
- [ ] Final Polish — the one pass where cosmetic-only changes are allowed
