document.addEventListener("DOMContentLoaded", () => {

    // ── Header scroll state ────────────────────────────────
    const header = document.getElementById("site-header");
    if (header) {
        const onScroll = () => {
            header.classList.toggle("is-scrolled", window.scrollY > 10);
        };
        window.addEventListener("scroll", onScroll, { passive: true });
        onScroll();
    }

    // ── Mobile menu ────────────────────────────────────────
    const burgerBtn  = document.getElementById("burger-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay    = document.getElementById("mobile-overlay");

    const openMenu = () => {
        mobileMenu.classList.add("is-open");
        overlay.classList.add("is-open");
        burgerBtn.setAttribute("aria-expanded", "true");
        mobileMenu.removeAttribute("aria-hidden");
        document.body.style.overflow = "hidden";
    };

    const closeMenu = () => {
        mobileMenu.classList.remove("is-open");
        overlay.classList.remove("is-open");
        burgerBtn.setAttribute("aria-expanded", "false");
        mobileMenu.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };

    if (burgerBtn && mobileMenu) {
        burgerBtn.addEventListener("click", () => {
            const isOpen = burgerBtn.getAttribute("aria-expanded") === "true";
            isOpen ? closeMenu() : openMenu();
        });

        overlay?.addEventListener("click", closeMenu);

        // Close on Escape
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeMenu();
        });

        // Close on mobile menu link click
        mobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", closeMenu);
        });
    }

    // ── FAQ accordion ──────────────────────────────────────
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {
        const btn    = item.querySelector(".faq-item__question");
        const answer = item.querySelector(".faq-item__answer");
        if (!btn || !answer) return;

        btn.addEventListener("click", () => {
            const isOpen = item.classList.contains("is-open");

            // Close all
            faqItems.forEach(other => {
                other.classList.remove("is-open");
                const otherBtn    = other.querySelector(".faq-item__question");
                const otherAnswer = other.querySelector(".faq-item__answer");
                if (otherBtn) otherBtn.setAttribute("aria-expanded", "false");
                if (otherAnswer) otherAnswer.hidden = true;
            });

            // Open clicked (if was closed)
            if (!isOpen) {
                item.classList.add("is-open");
                btn.setAttribute("aria-expanded", "true");
                answer.hidden = false;
            }
        });
    });

    // ── Smooth scroll for anchor links ────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener("click", (e) => {
            const target = document.querySelector(link.getAttribute("href"));
            if (!target) return;
            e.preventDefault();
            const top = target.getBoundingClientRect().top + window.scrollY - 88;
            window.scrollTo({ top, behavior: "smooth" });
        });
    });

    // ── Service tabs ───────────────────────────────────────
    const tabBtns   = document.querySelectorAll(".tab-btn");
    const tabPanels = document.querySelectorAll(".tab-panel");

    tabBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.tab;

            tabBtns.forEach(b => {
                b.classList.remove("is-active");
                b.setAttribute("aria-selected", "false");
            });
            tabPanels.forEach(p => {
                p.classList.remove("is-active");
                p.hidden = true;
            });

            btn.classList.add("is-active");
            btn.setAttribute("aria-selected", "true");

            const panel = document.getElementById("tab-panel-" + id);
            if (panel) {
                panel.classList.add("is-active");
                panel.hidden = false;
            }
        });
    });

    // ── Intersection Observer for fade-in ─────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll(".scenario-card, .advantage-card, .case-card, .tool-card, .step").forEach(el => {
        el.classList.add("fade-in");
        observer.observe(el);
    });

});
