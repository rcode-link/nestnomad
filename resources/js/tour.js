import introJs from "intro.js";
import "intro.js/introjs.css";

const TOUR_STYLES = `
.introjs-tooltip {
    max-width: 420px;
    border-radius: 16px;
    padding: 0;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(55, 88, 249, 0.08);
    font-family: inherit;
    overflow: hidden;
}

.introjs-tooltip-header {
    padding: 24px 24px 0;
}

.introjs-tooltip-title {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.3;
}

.introjs-tooltiptext {
    padding: 12px 24px 20px;
    font-size: 14px;
    line-height: 1.7;
    color: #475569;
}

.introjs-tooltiptext strong {
    color: #1e293b;
    font-weight: 600;
}

.introjs-tooltiptext .tour-action-hint {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 12px;
    padding: 10px 14px;
    background: #f0f4ff;
    border-radius: 10px;
    font-size: 13px;
    color: #3758f9;
    font-weight: 500;
}

.introjs-tooltiptext .tour-action-hint svg {
    flex-shrink: 0;
    width: 18px;
    height: 18px;
}

.introjs-tooltiptext .tour-step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #3758f9;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    margin-right: 8px;
    flex-shrink: 0;
    vertical-align: middle;
}

.introjs-tooltipbuttons {
    display: flex;
    padding: 16px 24px;
    border-top: 1px solid #f1f5f9;
    background: #fafbfc;
    border-radius: 0 0 16px 16px;
}

.introjs-skipbutton {
    order: -1;
    margin-right: auto !important;
    background: none;
    border: none;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 500;
    padding: 8px 0;
    cursor: pointer;
    text-shadow: none;
}

.introjs-skipbutton:hover {
    color: #64748b;
}

.introjs-prevbutton,
.introjs-nextbutton,
.introjs-donebutton {
    border: none;
    border-radius: 10px;
    padding: 8px 20px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-shadow: none;
    transition: all 0.15s ease;
}

.introjs-prevbutton {
    background: #f1f5f9;
    color: #475569;
    margin-right: 8px;
}

.introjs-prevbutton:hover {
    background: #e2e8f0;
}

.introjs-nextbutton,
.introjs-donebutton {
    background: #3758f9;
    color: #fff;
}

.introjs-nextbutton:hover,
.introjs-donebutton:hover {
    background: #2b47d4;
}

.introjs-nextbutton:focus,
.introjs-prevbutton:focus,
.introjs-donebutton:focus,
.introjs-skipbutton:focus {
    box-shadow: none;
}

.introjs-disabled {
    opacity: 0.4;
    pointer-events: none;
}

.introjs-progressbar {
    background: #e2e8f0;
    height: 4px;
}

.introjs-progressbar > div {
    background: #3758f9;
}

.introjs-helperLayer {
    border-radius: 12px;
    box-shadow: 0 0 0 9999px rgba(15, 23, 42, 0.5), 0 0 15px rgba(55, 88, 249, 0.15);
}

.introjs-arrow {
    border-color: transparent;
}

.introjs-arrow.top {
    border-bottom-color: #fff;
}

.introjs-arrow.bottom {
    border-top-color: #fafbfc;
}

.introjs-arrow.left {
    border-right-color: #fff;
}

.introjs-arrow.right {
    border-left-color: #fff;
}

.introjs-overlay {
    background: rgba(15, 23, 42, 0.5);
}

.tour-welcome-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: linear-gradient(135deg, #3758f9 0%, #5b7cfa 100%);
    margin-bottom: 16px;
}

.tour-welcome-icon svg {
    width: 28px;
    height: 28px;
    color: #fff;
}

.tour-finish-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: linear-gradient(135deg, #13c296 0%, #34d399 100%);
    margin-bottom: 16px;
}

.tour-finish-icon svg {
    width: 28px;
    height: 28px;
    color: #fff;
}
`;

function injectStyles() {
    if (document.getElementById("tour-custom-styles")) return;
    const style = document.createElement("style");
    style.id = "tour-custom-styles";
    style.textContent = TOUR_STYLES;
    document.head.appendChild(style);
}

function findNavItem(keyword) {
    const navItems = document.querySelectorAll(".fi-sidebar-item");
    for (const item of navItems) {
        if (item.textContent.trim().toLowerCase().includes(keyword)) {
            return item;
        }
    }
    return null;
}

function actionHint(text) {
    return `<div class="tour-action-hint">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
        </svg>
        ${text}
    </div>`;
}

function stepNumber(num) {
    return `<span class="tour-step-number">${num}</span>`;
}

const WELCOME_ICON = `<div class="tour-welcome-icon">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
    </svg>
</div>`;

const FINISH_ICON = `<div class="tour-finish-icon">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
</div>`;

document.addEventListener("DOMContentLoaded", () => {
    const tourData = document.getElementById("tour-data");
    if (!tourData) return;

    const tourCompleted = tourData.dataset.tourCompleted === "1";
    const tourUrl = tourData.dataset.tourUrl;
    const csrfToken = tourData.dataset.csrfToken;

    if (tourCompleted) return;

    setTimeout(() => {
        startTour(tourUrl, csrfToken);
    }, 800);
});

function startTour(tourUrl, csrfToken) {
    injectStyles();

    const intro = introJs();
    const steps = [];

    // Interactive step indices (where user must click the element)
    const interactiveSteps = new Set();

    // Welcome
    steps.push({
        title: "Welcome to NestNomad!",
        intro: `${WELCOME_ICON}
            <p>Let's get you started with a quick walkthrough. We'll guide you through <strong>3 simple steps</strong> to set up your property management.</p>
            ${actionHint("Click Next to begin")}`,
    });

    // Sidebar
    const sidebar = document.querySelector(".fi-sidebar-nav");
    if (sidebar) {
        steps.push({
            element: sidebar,
            title: "Your Navigation",
            intro: "This is your command center. All sections of your dashboard are accessible from this sidebar.",
            position: "right",
        });
    }

    // Step 1: Properties — click to navigate
    const propertiesNav = findNavItem("propert");
    if (propertiesNav) {
        const idx = steps.length;
        interactiveSteps.add(idx);
        steps.push({
            element: propertiesNav,
            title: `${stepNumber(1)} Add Your First Property`,
            intro: `Your properties are the foundation of everything. This is where you'll manage all your rental units.
                ${actionHint("Click on Properties to continue")}`,
            position: "right",
            disableInteraction: false,
        });
    }

    // Step 2: Leases — click to navigate
    const leasesNav = findNavItem("lease");
    if (leasesNav) {
        const idx = steps.length;
        interactiveSteps.add(idx);
        steps.push({
            element: leasesNav,
            title: `${stepNumber(2)} Create a Lease`,
            intro: `Once you've added a property, create a lease to link tenants. Set the rent amount, lease period, and tenant details.
                ${actionHint("Click on Leases to continue")}`,
            position: "right",
            disableInteraction: false,
        });
    }

    // Step 3: Expenses — back to properties
    if (propertiesNav) {
        const idx = steps.length;
        interactiveSteps.add(idx);
        steps.push({
            element: propertiesNav,
            title: `${stepNumber(3)} Track Your Expenses`,
            intro: `Inside each property you'll find an <strong>Expenses</strong> tab. Log maintenance costs, repairs, and charges — then mark them as paid when settled.
                ${actionHint("Click on Properties to view expenses")}`,
            position: "right",
            disableInteraction: false,
        });
    }

    // Issues
    const issuesNav = findNavItem("issue");
    if (issuesNav) {
        steps.push({
            element: issuesNav,
            title: "Report & Track Issues",
            intro: "Use <strong>Issues</strong> to manage maintenance requests and problems. Tenants can report issues and you can track their resolution.",
            position: "right",
        });
    }

    // Dashboard
    const widgetsArea = document.querySelector(".fi-widgets");
    if (widgetsArea) {
        steps.push({
            element: widgetsArea,
            title: "Your Dashboard",
            intro: "Your dashboard shows payment summaries, occupancy rates, and key metrics. It updates automatically as you add data.",
            position: "bottom",
        });
    }

    // Finish
    steps.push({
        title: "You're Ready!",
        intro: `${FINISH_ICON}
            <p>You're all set to manage your properties. Start by <strong>adding your first property</strong> and the rest will follow.</p>
            <p style="margin-top: 8px; font-size: 13px; color: #94a3b8;">You can restart this guide anytime from the user menu.</p>`,
    });

    if (steps.length === 0) return;

    intro.setOptions({
        steps: steps,
        showProgress: true,
        showBullets: false,
        exitOnOverlayClick: false,
        doneLabel: "Get Started",
        nextLabel: "Next",
        prevLabel: "Back",
        skipLabel: "Skip",
        showStepNumbers: false,
    });

    // On interactive steps, hide Next and wait for user to click the element
    intro.onafterchange(function () {
        const currentStep = this._currentStep;
        const nextBtn = document.querySelector(".introjs-nextbutton");
        const tooltipEl = document.querySelector(".introjs-tooltip");

        if (interactiveSteps.has(currentStep)) {
            // Hide next button — user must interact
            if (nextBtn) {
                nextBtn.classList.add("introjs-disabled");
                nextBtn.style.display = "none";
            }

            // Get the highlighted element and listen for click
            const stepEl = steps[currentStep].element;
            if (stepEl) {
                const handler = (e) => {
                    stepEl.removeEventListener("click", handler);
                    // Small delay to let the page transition start
                    setTimeout(() => {
                        intro.nextStep();
                    }, 600);
                };
                stepEl.addEventListener("click", handler);
            }
        } else {
            // Ensure next button is visible on non-interactive steps
            if (nextBtn) {
                nextBtn.classList.remove("introjs-disabled");
                nextBtn.style.display = "";
            }
        }
    });

    const markComplete = () => {
        fetch(tourUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
    };

    intro.oncomplete(markComplete);
    intro.onexit(markComplete);

    intro.start();
}

// Allow restarting the tour manually
window.restartTour = () => {
    const tourData = document.getElementById("tour-data");
    if (!tourData) return;

    const tourUrl = tourData.dataset.tourUrl;
    const csrfToken = tourData.dataset.csrfToken;

    startTour(tourUrl, csrfToken);
};
