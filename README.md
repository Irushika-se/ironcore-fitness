# IronCore Fitness

A professional, responsive gym website built with WordPress and the free Astra theme. All custom work is in one small plugin: no page builder and no third-party plugins. The business details are edited from the WordPress admin, so no code changes are needed to go live.

> The classes, prices, coaches, timetable and "About" text are sample content. Replace them with the real business details before launch (see "Before going live").

## Screenshots
Add images to `docs/screenshots/` and link them here, for example `![Home](docs/screenshots/home.png)`.

## Features
- 8 pages created automatically: Home, About, Classes, Pricing, Schedule, Trainers, Contact, Privacy Policy
- Settings page (Settings > IronCore Fitness): business name, phone, WhatsApp, email, address, Google Map, opening hours, social links, member reviews
- Membership pricing cards with automatic "Save Rs. X" amounts, weekly class timetable, FAQ, trainer cards
- Free-trial booking form: nonce check, honeypot spam trap, rate limit (5 per hour per visitor), consent checkbox, server-side validation, sanitised input
- Trial Bookings inbox in the admin with Class, Date, Contact and Status (New / Confirmed / Completed / Cancelled)
- Email to the owner (Reply-To set to the member) and an automatic confirmation email to the member
- Floating WhatsApp button, click-to-call phone link, lazy-loaded map
- SEO: meta description, Open Graph tags and `HealthClub` JSON-LD schema (skipped automatically when Yoast, Rank Math or AIOSEO is active)
- Accessible: focus outlines, labelled form fields, ARIA roles on messages, reduced-motion support
- Responsive for desktop, tablet and phone

## Tech
WordPress, Astra (free), PHP (plugin, shortcodes, custom post type, settings API, meta boxes, activation hook), CSS, WAMP (local server).

## What is in this repo
| Path | Content |
| --- | --- |
| `plugin/ironcore-fitness-setup/ironcore-fitness-setup.php` | The plugin |
| `plugin/ironcore-fitness-setup/css/ironcore-fitness.css` | Charcoal and orange styling |
| `plugin/ironcore-fitness-setup/images/` | Photos: `hero`, `strength`, `cardio`, `mind`, `cta`, optional `combat` |
| `docs/screenshots/` | Screenshots of the finished site |

## Run it locally
1. Install WordPress with WAMP (for example `C:\wamp64\www\gym`, database `gym_db`).
2. Install and activate the Astra theme.
3. Zip the folder `plugin/ironcore-fitness-setup`, then Plugins > Add New > Upload Plugin, and activate it.
4. Settings > Permalinks > Post name > Save.
5. Settings > IronCore Fitness: enter the real business details.

## Before going live
- Replace sample classes, prices, plans, timetable, trainers and FAQ in the lists at the top of the plugin file (`ic_classes`, `ic_plans`, `ic_schedule`, `ic_trainer_list`, `ic_faqs`).
- Edit the About and Privacy Policy text to match the business. The privacy text is a simple template: have it reviewed if the site is used commercially.
- Fill in the Settings page, including the Google Maps embed (Google Maps > Share > Embed a map).
- Add real member reviews in Settings (the section stays hidden while empty).
- Install an SMTP plugin (for example WP Mail SMTP) so booking emails are reliably delivered.
- Use HTTPS, keep WordPress, Astra and plugins updated, and take regular backups.
- Add a `combat.jpg` boxing photo to `images/` (optional). Deactivate and reactivate the plugin, or visit any admin page, to refresh the image styles.

## Shortcodes
`[ic_booking]`, `[ic_trainers]`, `[ic_pricing]`, `[ic_schedule]`, `[ic_faq]`, `[ic_hours]`, `[ic_contact_info]`, `[ic_map]`, `[ic_social]`, `[ic_testimonials]`, `[ic_name]`

## Credits
Photos from Unsplash (free to use under the Unsplash License):
- Dumbbells (strength): Anastase Maragos
- Treadmill (cardio): Sour Moha
- Barbell (call-to-action): Tyler Raye
- Gym interior (hero): Jinish Shah
- Yoga (mind & body): Alex Shaw
