# Nawasena CRM Design System

## Overview
This document defines the visual design system for Nawasena CRM.
Creative North Star: "Clean, Professional, and Flat."
The aesthetic relies on solid colors, precise corners (exactly 4px radius), and zero gradients to ensure a highly readable, functional, and professional interface for CRM data entry and management.

## Colors
- **Primary:** Clean, solid professional tones (e.g., Solid Deep Blue or Slate).
- **Backgrounds:** Flat white or very light neutral gray (`#F9FAFB` or similar).
- **Borders & Dividers:** Subtle, solid neutral grays.
- **Rule:** **Never use gradients.** All colors must be flat and solid to maintain the clean CRM look.

## Typography
- **Font Family:** Clean, legible sans-serif (e.g., Inter, Roboto, or system UI fonts).
- **Hierarchy:** Clear, distinct sizing for section headers, form labels, and body text. Focus on readability for data-heavy tables.

## Elevation
- **Rule:** Flat by default.
- **Shadows:** Avoid decorative shadows. Use subtle shadows *only* to indicate interactivity or depth for floating elements (e.g., modals, dropdowns, or hover states on cards).
- **Separation:** Prefer 1px solid borders over shadows to distinguish layout sections.

## Components
- **Border Radius:** All interactive components (buttons, input fields, cards, dialogs) **MUST use exactly 4px border-radius** (e.g., `rounded` or `rounded-sm` in Tailwind, or `border-radius: 4px;` in CSS).
- **Forms:** Inputs should be clean with solid borders. No pill-shaped inputs.
- **Buttons:** Solid fill colors, flat design, 4px radius. No gradients or glassmorphism.

## Do's and Don'ts
- **DO** use exactly `4px` border radius for all UI elements.
- **DO** use solid, clean colors.
- **DO** maintain high contrast for text readability.
- **DON'T** use any gradients in backgrounds, buttons, text, or borders.
- **DON'T** use excessive drop shadows; keep the UI flat and functional.
- **DON'T** use large, exaggerated rounded corners (e.g., `rounded-xl` or `rounded-full`) except for avatars.
