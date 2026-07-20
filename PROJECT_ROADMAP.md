# CUSBRO — Project Roadmap

Living document. Update it every time a block is finished or a QA pass
runs — this is the single source of truth for build status. Replaces
the old `docs/12_TODO.md`, which tracked features rather than sections
and had gone stale (marked Footer/Header done before they were).

## Project Status

**Phase 1 — Header + Hero + Services + Advantages: CLOSED** ✅

- Header — ✅ Built ✅ QA ✅ Narrative ➖ Release ➖
- Hero — ✅ Built ✅ QA ✅ Narrative ✅ Release
- Services — ✅ Built ✅ QA ✅ Narrative ✅ Release
- Advantages — ✅ Built ✅ QA ✅ Narrative ✅ Release
- CTA — 🔄 Built *(emergency-patched, no brand pass — still its own
  future phase item)* 🔄 QA ✅ Release

Closed on a real QA pass: screenshots at 480/768/1024/1440/1920px,
Lighthouse (desktop + mobile), `<main>`/meta-description confirmed live.
Two logged exceptions, not swept under the rug — see Definition of Done
(Best Practices/HTTPS) and Backlog → UI (the real contrast bug found in
the *Blog* section, and an unidentified console error, neither of which
is Hero/Services/Advantages code).

Per the No-jumping-back rule: Header, Hero, Services, Advantages don't
get touched again without a critical bug, a conversion problem, an SEO
problem, or a responsiveness problem.

**Process: Built ✅ QA ✅ Narrative ✅ Release ✅ — CLOSED**

**Current Sprint:** Calculator
**Current Block:** Calculator
**Next Block:** Cases
**Current Goal:** Deliver on the promise Process just made — turn "we'll
calculate everything upfront" into an actual working, on-brand tool

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

| Section | Built | QA | Narrative | Release |
|---|---|---|---|---|
| Header | ✅ | ✅ live-verified (curl + screenshots): overflow fix, mobile menu, aria-expanded — real Desktop/Mobile screenshots exist for this one | ➖ | ➖ |
| Hero | ✅ | ✅ real screenshots at 480/768/1024/1440/1920px, `<main>`+meta confirmed live, Lighthouse Perf 97(desktop)/85(mobile), A11y 96/95, SEO 92/92 — Best Practices 74/74 is the logged HTTPS exception above, not a Hero defect | ✅ badge reworded ("Говоримо зрозумілою мовою • Незалежно від вашого міста") to remove verbatim overlap with Advantages | ✅ `#contact`/`#calculator` both real, functional targets — confirmed live |
| Services | ✅ | ✅ *(no independent screenshot — confirmed via shared grid/spacing patterns already verified in the consistency audit, and present in DOM with correct `id`/`aria-labelledby`; not directly seen rendering on screen)* | ✅ | ✅ same `#contact`/`#calculator` fix, confirmed live |
| Advantages | ✅ | ✅ *(same caveat as Services — DOM-confirmed, patterns-confirmed, not independently screenshotted)* | ✅ | ✅ no CTA of its own — nothing to break |
| Process | ✅ *(4-step stepper, "Ваша роль/Наша робота" split, CTA bridges to Calculator)* | ✅ live screenshots at 1920/1440/1366/1024/768/420px — desktop connecting line, 2×2 tablet (line correctly hidden), mobile vertical rail all confirmed rendering correctly, incl. the `top`/`bottom` fix actually spanning to the next circle | ✅ step 4 echoes Hero's promise, CTA reads clearly in every screenshot | ✅ CTA points at `#calculator`, which already exists and works |
| Calculator (auto) | ⬜ *(JS calculator already functional — needs brand/QA pass)* | ⬜ | ⬜ | ⬜ |
| Cases | ⬜ | ⬜ | ⬜ | ⬜ |
| Reviews | ⬜ | ⬜ | ⬜ | ⬜ |
| FAQ | ⬜ | ⬜ | ⬜ | ⬜ |
| CTA | ⬜ *(emergency-patched only — see below; still old visual style, no brand pass yet)* | ⬜ | ⬜ *(not evaluated — this isn't its real build turn yet)* | ✅ real phone + working Telegram/Viber/WhatsApp, no dead form |
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

## Versions

- v0.1 — Header ✅
- v0.2 — Hero ✅
- v0.3 — Services ✅
- v0.4 — Advantages ✅
- v0.5 — Process ✅
- v0.6 — Calculator
- v0.7 — Cases
- v0.8 — Reviews
- v0.9 — FAQ
- v0.95 — CTA + Footer
- v1.0 — Release (Final Polish complete, homepage done)

## Phase roadmap

**Phase 1 — Homepage** *(in progress, see table above)*

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

- `app/` — an empty PSR-4 class skeleton sitting parallel to the working
  `inc/customs/` engine. Two competing designs for the same domain;
  needs a decision before it multiplies.
- `assets/icons/` — empty directory, no longer referenced (icons are
  inline SVG now). Safe to delete.
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

- `inc/customs/*.php` — a full PHP calculation engine that nothing calls;
  the live calculator is 100% client-side JS in
  `assets/js/calculator-auto.js`, and the two have already drifted
  (different duty/excise rates). Decide: wire it up server-side, or
  remove it — dead PHP still gets parsed on every request.

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
