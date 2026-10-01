<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>


    <meta charset="utf-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >


    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >


    <title>{{ config('app.name', 'NEXORA') }}</title>


    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >


    <link
        href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap"
        rel="stylesheet"
    >


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    <style>

        :root {
            --nexora-bg: #080B10;
            --nexora-surface: rgba(18, 21, 26, 0.72);
            --nexora-surface-strong: rgba(16, 20, 27, 0.88);
            --nexora-border: rgba(115, 124, 145, 0.18);
            --nexora-border-strong: rgba(139, 124, 255, 0.22);
            --nexora-purple: #8B7CFF;
            --nexora-text: #F5F5F2;
            --nexora-muted: #8B919A;

            --nx-sidebar-open: 246px;
            --nx-sidebar-closed: 82px;
        }


        html {
            background: var(--nexora-bg);
            color-scheme: dark;
        }


        /* ============================================================
           PAGE TRANSITIONS
        ============================================================ */

        @view-transition {
            navigation: auto;
        }


        /*
         * Keep the NEXORA shell visually stable while the page changes.
         * Laravel still performs a normal navigation.
         */
        .nexora-sidebar {
            view-transition-name: nexora-sidebar;
        }


        .nexora-topbar {
            view-transition-name: nexora-topbar;
        }


        .nexora-main {
            view-transition-name: nexora-content;
        }


        /*
         * Sidebar and navbar should not visibly animate between pages.
         * Only the content area should transition.
         */
        ::view-transition-old(nexora-sidebar),
        ::view-transition-new(nexora-sidebar),
        ::view-transition-old(nexora-topbar),
        ::view-transition-new(nexora-topbar) {
            animation: none;
        }


        @keyframes nexora-content-out {

            from {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

            to {
                opacity: .985;
                transform: translate3d(0, -2px, 0);
            }

        }


        @keyframes nexora-content-in {

            from {
                opacity: .985;
                transform: translate3d(0, 2px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }

        }


        ::view-transition-old(nexora-content) {
            animation:
                nexora-content-out
                170ms
                cubic-bezier(.22, 1, .36, 1)
                both;
        }


        ::view-transition-new(nexora-content) {
            animation:
                nexora-content-in
                210ms
                cubic-bezier(.22, 1, .36, 1)
                both;
        }


        ::view-transition-group(nexora-content) {
            animation-duration: 210ms;
        }


        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation-duration: 190ms;
            animation-timing-function: ease;
        }


        ::view-transition-old(root) {
            animation-name: nexora-root-out;
        }


        ::view-transition-new(root) {
            animation-name: nexora-root-in;
        }


        @keyframes nexora-root-out {

            from {
                opacity: 1;
            }

            to {
                opacity: .995;
            }

        }


        @keyframes nexora-root-in {

            from {
                opacity: .995;
            }

            to {
                opacity: 1;
            }

        }


        /*
         * Prevent double clicking during a navigation.
         * This does NOT replace the page or interfere with Laravel.
         */
        html.nexora-is-navigating body {
            pointer-events: none;
        }


        /* ============================================================
           SPATIAL BACKGROUND
        ============================================================ */

        body.nexora-spatial {
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(
                    circle at 88% 4%,
                    rgba(139, 124, 255, 0.13),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 16% 88%,
                    rgba(59, 96, 255, 0.08),
                    transparent 34%
                ),
                radial-gradient(
                    circle at 52% 40%,
                    rgba(255, 255, 255, 0.018),
                    transparent 38%
                ),
                var(--nexora-bg);
        }


        body.nexora-spatial::before {
            content: '';
            position: fixed;
            inset: -18vh -12vw auto auto;
            width: 48vw;
            height: 48vw;
            pointer-events: none;
            border-radius: 999px;
            background:
                radial-gradient(
                    circle,
                    rgba(139, 124, 255, 0.10),
                    transparent 66%
                );
            filter: blur(42px);
            opacity: 0.9;
            z-index: 0;
        }


        body.nexora-spatial::after {
            content: '';
            position: fixed;
            left: -18vw;
            bottom: -24vh;
            width: 46vw;
            height: 46vw;
            pointer-events: none;
            border-radius: 999px;
            background:
                radial-gradient(
                    circle,
                    rgba(44, 93, 214, 0.08),
                    transparent 68%
                );
            filter: blur(52px);
            z-index: 0;
        }


        /* ============================================================
           SIDEBAR
        ============================================================ */

        .nexora-sidebar {
            width: var(--nx-sidebar-open) !important;
            overflow: hidden;

            background:
                linear-gradient(
                    180deg,
                    rgba(12, 16, 22, 0.94),
                    rgba(7, 10, 15, 0.98)
                );

            border-right-color:
                rgba(120, 128, 148, 0.13) !important;

            box-shadow:
                22px 0 60px rgba(0, 0, 0, 0.22);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            transition:
                width 280ms cubic-bezier(.22,1,.36,1),
                box-shadow 220ms ease;
        }


        .nexora-sidebar.is-collapsed,
        html.nexora-sidebar-collapsed .nexora-sidebar {
            width: var(--nx-sidebar-closed) !important;
        }


        /*
         * Sidebar header and topbar are exactly 72px.
         * This keeps their horizontal divider perfectly aligned.
         */
        .nexora-sidebar > div:first-child {
            height: 72px !important;
            min-height: 72px !important;

            border-bottom:
                1px solid
                rgba(120, 128, 148, 0.14) !important;

            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.015),
                    transparent
                );

            padding-right: 58px !important;

            transition:
                padding 280ms cubic-bezier(.22,1,.36,1);
        }


        /*
         * CLOSED SIDEBAR:
         *
         * Logo gets its own 40px centered area.
         * This means the logo's center is exactly aligned with
         * the center of the navigation icons below it.
         */
        .nexora-sidebar.is-collapsed > div:first-child,
        html.nexora-sidebar-collapsed .nexora-sidebar > div:first-child {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }


        .nexora-sidebar.is-collapsed > div:first-child > div:first-child,
        html.nexora-sidebar-collapsed
        .nexora-sidebar > div:first-child > div:first-child {
            width: 40px !important;
            min-width: 40px !important;

            justify-content: center !important;

            gap: 0 !important;

            margin-left: auto !important;
            margin-right: auto !important;
        }


        /*
         * Hide company name smoothly when collapsed.
         */
        .nexora-sidebar.is-collapsed
        > div:first-child
        > div:first-child
        > div:nth-child(2),

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        > div:first-child
        > div:first-child
        > div:nth-child(2) {
            width: 0 !important;
            max-width: 0 !important;

            margin: 0 !important;

            opacity: 0;

            transform: translateX(-6px);

            overflow: hidden;
            pointer-events: none;

            transition:
                opacity 150ms ease,
                transform 220ms ease,
                width 220ms ease;
        }


        /* ============================================================
           SIDEBAR TOGGLE
        ============================================================ */

        .nexora-sidebar-toggle {
            position: absolute;
            top: 20px;
            right: 12px;

            z-index: 5;

            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid
                rgba(115,124,145,.20);

            border-radius: 10px;

            background:
                rgba(15,20,27,.78);

            color: #747D8A;

            cursor: pointer;

            box-shadow:
                inset 0 1px rgba(255,255,255,.025),
                0 8px 20px rgba(0,0,0,.16);

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            transition:
                color 180ms ease,
                border-color 180ms ease,
                background 180ms ease,
                transform 280ms cubic-bezier(.22,1,.36,1);
        }


        .nexora-sidebar-toggle:hover {
            color: #DCDDE2;

            border-color:
                rgba(139,124,255,.34);

            background:
                rgba(29,34,45,.92);
        }


        .nexora-sidebar-toggle svg {
            width: 16px;
            height: 16px;

            transition:
                transform
                280ms
                cubic-bezier(.22,1,.36,1);
        }


        /*
         * When collapsed there is NO BOX attached to the logo.
         * Only a small invisible-edge control remains.
         */
        .nexora-sidebar.is-collapsed .nexora-sidebar-toggle,
        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-toggle {
            right: 0 !important;

            width: 20px !important;
            height: 28px !important;

            border: 0 !important;

            border-radius:
                8px 0 0 8px !important;

            background: transparent !important;

            box-shadow: none !important;

            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;

            color: #68717F;
        }


        .nexora-sidebar.is-collapsed
        .nexora-sidebar-toggle:hover,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-toggle:hover {
            color: #B9B2FF;

            background:
                rgba(139,124,255,.055) !important;
        }


        .nexora-sidebar.is-collapsed
        .nexora-sidebar-toggle svg,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-toggle svg {
            transform: rotate(180deg);
        }


        /* ============================================================
           SIDEBAR NAVIGATION
        ============================================================ */

        .nexora-sidebar nav {
            scrollbar-width: thin;

            scrollbar-color:
                rgba(139, 124, 255, 0.24)
                transparent;

            transition:
                padding 280ms cubic-bezier(.22,1,.36,1);
        }


        .nexora-sidebar nav::-webkit-scrollbar {
            width: 6px;
        }


        .nexora-sidebar nav::-webkit-scrollbar-thumb {
            border-radius: 999px;

            background:
                rgba(139, 124, 255, 0.22);
        }


        .nexora-sidebar nav > p {
            transition:
                opacity 160ms ease,
                height 220ms ease,
                margin 220ms ease,
                padding 220ms ease;

            white-space: nowrap;
        }


        .nexora-sidebar.is-collapsed nav,
        html.nexora-sidebar-collapsed .nexora-sidebar nav {
            padding-left: 13px !important;
            padding-right: 13px !important;
        }


        .nexora-sidebar.is-collapsed nav > p,
        html.nexora-sidebar-collapsed
        .nexora-sidebar nav > p {
            height: 0;

            margin-top: 0 !important;
            margin-bottom: 0 !important;

            padding-top: 0 !important;
            padding-bottom: 0 !important;

            opacity: 0;

            overflow: hidden;
        }


        .nexora-sidebar a {
            position: relative;

            border-color: transparent;

            transition:
                transform 180ms ease,
                background 180ms ease,
                border-color 180ms ease,
                box-shadow 180ms ease;
        }


        .nexora-sidebar nav a {
            min-height: 44px;

            transition:
                transform 180ms ease,
                background 180ms ease,
                border-color 180ms ease,
                box-shadow 180ms ease;
        }


        .nexora-sidebar a:hover {
            transform: translateX(2px);
        }


        .nexora-sidebar nav a:hover {
            transform: translateX(2px);
        }


        .nexora-sidebar a[class*="bg-[#25204D]"] {
            background:
                linear-gradient(
                    135deg,
                    rgba(139, 124, 255, 0.25),
                    rgba(72, 58, 156, 0.16) 52%,
                    rgba(20, 25, 36, 0.42)
                ) !important;

            border-color:
                rgba(139, 124, 255, 0.34) !important;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.04),
                0 10px 26px rgba(57, 44, 128, 0.16);
        }


        .nexora-sidebar a[class*="bg-[#25204D]"]::before {
            content: '';

            position: absolute;

            left: 0;
            top: 9px;
            bottom: 9px;

            width: 2px;

            border-radius: 999px;

            background:
                linear-gradient(
                    180deg,
                    rgba(174, 164, 255, 0.95),
                    rgba(139, 124, 255, 0.3)
                );

            box-shadow:
                0 0 16px rgba(139, 124, 255, 0.55);
        }


        .nexora-sidebar.is-collapsed nav a,
        html.nexora-sidebar-collapsed
        .nexora-sidebar nav a {
            justify-content: center;

            padding-left: 0 !important;
            padding-right: 0 !important;
        }


        .nexora-nav-label {
            display: inline-block;

            white-space: nowrap;

            transition:
                opacity 150ms ease,
                transform 220ms ease,
                width 220ms ease;
        }


        .nexora-sidebar.is-collapsed
        nav a
        .nexora-nav-label,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        nav a
        .nexora-nav-label {
            width: 0 !important;

            margin: 0 !important;

            opacity: 0;

            overflow: hidden;

            transform: translateX(-5px);

            pointer-events: none;
        }


        /*
         * Tooltip for collapsed navigation.
         */
        .nexora-sidebar.is-collapsed nav a::after,
        html.nexora-sidebar-collapsed
        .nexora-sidebar nav a::after {
            content: attr(data-nx-label);

            position: absolute;

            left: calc(100% + 12px);
            top: 50%;

            z-index: 100;

            padding: 8px 11px;

            border:
                1px solid
                #303743;

            border-radius: 9px;

            background: #11161E;

            color: #E6E8EC;

            font-size: 11px;
            font-weight: 500;

            line-height: 1;

            box-shadow:
                0 15px 35px rgba(0,0,0,.35);

            opacity: 0;

            pointer-events: none;

            transform:
                translateY(-50%)
                translateX(-4px);

            transition:
                opacity 150ms ease,
                transform 150ms ease;
        }


        .nexora-sidebar.is-collapsed nav a:hover::after,
        html.nexora-sidebar-collapsed
        .nexora-sidebar nav a:hover::after {
            opacity: 1;

            transform:
                translateY(-50%)
                translateX(0);
        }


        .nexora-sidebar nav a:nth-of-type(1) {
            --nx-label: 'Dashboard';
        }


        .nexora-sidebar nav a:nth-of-type(2) {
            --nx-label: 'Sales';
        }


        /* ============================================================
           SIDEBAR USER / LOGOUT
        ============================================================ */

        .nexora-sidebar .nexora-sidebar-logout {
            position: relative;

            min-height: 40px;

            border:
                1px solid
                transparent;
        }


        .nexora-sidebar .nexora-sidebar-logout:hover {
            border-color:
                rgba(168,82,82,.15);

            background:
                rgba(117,45,45,.09);

            color: #E7C0C0;
        }


        .nexora-logout-icon {
            display: flex;

            width: 20px;
            height: 20px;

            flex-shrink: 0;

            align-items: center;
            justify-content: center;
        }


        .nexora-logout-icon svg {
            width: 17px;
            height: 17px;
        }


        .nexora-sidebar.is-collapsed
        > div:last-child
        > div:first-child
        > div:nth-child(2),

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        > div:last-child
        > div:first-child
        > div:nth-child(2) {
            width: 0;

            max-width: 0;

            margin: 0;

            opacity: 0;

            overflow: hidden;

            transform: translateX(-5px);

            pointer-events: none;

            transition:
                opacity 150ms ease,
                transform 220ms ease,
                width 220ms ease;
        }


        .nexora-sidebar.is-collapsed
        .nexora-sidebar-logout,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-logout {
            justify-content: center;

            gap: 0;

            padding-left: 0 !important;
            padding-right: 0 !important;
        }


        .nexora-sidebar.is-collapsed
        .nexora-logout-label,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-logout-label {
            width: 0;

            opacity: 0;

            overflow: hidden;

            pointer-events: none;
        }


        .nexora-sidebar.is-collapsed
        .nexora-sidebar-logout::after,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-logout::after {
            content: 'Logout';

            position: absolute;

            left: calc(100% + 12px);
            top: 50%;

            z-index: 100;

            padding: 8px 11px;

            border:
                1px solid
                #303743;

            border-radius: 9px;

            background: #11161E;

            color: #E6E8EC;

            font-size: 11px;
            line-height: 1;

            box-shadow:
                0 15px 35px rgba(0,0,0,.35);

            opacity: 0;

            pointer-events: none;

            transform:
                translateY(-50%)
                translateX(-4px);

            transition:
                opacity 150ms ease,
                transform 150ms ease;
        }


        .nexora-sidebar.is-collapsed
        .nexora-sidebar-logout:hover::after,

        html.nexora-sidebar-collapsed
        .nexora-sidebar
        .nexora-sidebar-logout:hover::after {
            opacity: 1;

            transform:
                translateY(-50%)
                translateX(0);
        }


        /* ============================================================
           MAIN SHELL
        ============================================================ */

        .nexora-main-shell {
            margin-left: var(--nx-sidebar-open) !important;

            transition:
                margin-left
                280ms
                cubic-bezier(.22,1,.36,1);
        }


        .nexora-main-shell.is-sidebar-collapsed {
            margin-left:
                var(--nx-sidebar-closed) !important;
        }


        html.nexora-sidebar-collapsed
        .nexora-main-shell {
            margin-left:
                var(--nx-sidebar-closed) !important;
        }


        /* ============================================================
           TOPBAR
        ============================================================ */

        .nexora-topbar {
            height: 72px !important;
            min-height: 72px !important;

            padding-left: 30px !important;
            padding-right: 30px !important;

            background:
                linear-gradient(
                    180deg,
                    rgba(8, 12, 18, 0.82),
                    rgba(8, 11, 16, 0.72)
                ) !important;

            border-bottom-color:
                rgba(120, 128, 148, 0.14) !important;

            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);

            box-shadow:
                0 12px 40px rgba(0, 0, 0, 0.16);
        }


        /*
         * IMPORTANT:
         * No extra ::after line.
         *
         * Sidebar and navbar now use exactly one identical
         * border-bottom instead of having an additional decorative line.
         */
        .nexora-topbar::after {
            display: none !important;
        }


        /* ============================================================
           GLOBAL SEARCH
        ============================================================ */

        #globalSearchWrapper {
            width: min(525px, 48vw) !important;
        }


        #globalSearchBox {
            height: 44px;

            border-color:
                rgba(122, 131, 151, 0.20) !important;

            border-radius: 14px !important;

            background:
                linear-gradient(
                    135deg,
                    rgba(22, 27, 36, 0.76),
                    rgba(12, 16, 22, 0.72)
                ) !important;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.035),
                0 12px 30px rgba(0, 0, 0, 0.16);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }


        #globalSearchBox:focus-within {
            border-color:
                rgba(139, 124, 255, 0.55) !important;

            box-shadow:
                0 0 0 1px rgba(139, 124, 255, 0.12),
                0 12px 32px rgba(0, 0, 0, 0.22),
                0 0 30px rgba(139, 124, 255, 0.08);
        }


        #globalSearchBox > span:first-child {
            display: flex;

            align-items: center;
            justify-content: center;
        }


        #globalSearchInput {
            font-size: 12px !important;
        }


        #globalSearchShortcut {
            border:
                1px solid
                rgba(139, 124, 255, 0.08);

            border-radius: 7px !important;

            background:
                rgba(139, 124, 255, 0.08) !important;

            color: #777F8C !important;
        }


        #globalSearchShortcut:hover {
            color: #B9B2FF !important;

            background:
                rgba(139,124,255,.12) !important;
        }


        #globalSearchResults,
        #userMenu {
            border-color:
                rgba(122, 131, 151, 0.18) !important;

            background:
                linear-gradient(
                    145deg,
                    rgba(18, 23, 31, 0.94),
                    rgba(10, 14, 20, 0.94)
                ) !important;

            box-shadow:
                0 30px 90px rgba(0, 0, 0, 0.46),
                inset 0 1px 0 rgba(255, 255, 255, 0.035);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }


        /* ============================================================
           TOPBAR RIGHT
        ============================================================ */

        .nexora-topbar > div:last-child {
            gap: 12px !important;
        }


        .nexora-topbar > div:last-child
        > a[aria-label="Notifications"] {
            width: 40px;
            height: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                transparent;

            border-radius: 12px;

            font-size: 0;

            color: #7D8693;

            transition:
                color 180ms ease,
                background 180ms ease,
                border-color 180ms ease,
                transform 180ms ease;
        }


        .nexora-topbar > div:last-child
        > a[aria-label="Notifications"]:hover {
            color: #E7E8EC;

            border-color:
                rgba(115,124,145,.18);

            background:
                rgba(18,24,32,.82);

            transform:
                translateY(-1px);
        }


        .nexora-topbar > div:last-child
        > a[aria-label="Notifications"]
        > span {
            box-shadow:
                0 0 12px rgba(139,124,255,.35);
        }


        #userMenuButton {
            min-height: 46px;

            padding:
                4px 7px 4px 5px !important;

            border:
                1px solid
                transparent;

            border-radius: 13px !important;

            transition:
                background 180ms ease,
                border-color 180ms ease,
                box-shadow 180ms ease;
        }


        #userMenuButton:hover {
            border-color:
                rgba(115,124,145,.18);

            background:
                rgba(17,22,30,.84) !important;

            box-shadow:
                inset 0 1px rgba(255,255,255,.02);
        }


        #userMenuButton > div:first-child {
            border:
                1px solid
                rgba(139,124,255,.20);

            box-shadow:
                0 7px 20px rgba(0,0,0,.22);
        }


        #userMenuButton > div:nth-child(2) p:first-child {
            letter-spacing: -.01em;
        }


        #userMenuButton > span:last-child {
            display: flex;

            align-items: center;
        }


        #userMenu {
            margin-top: 3px;
        }


        /* ============================================================
           MAIN CONTENT
        ============================================================ */

        .nexora-main {
            position: relative;

            isolation: isolate;

            background:
                transparent !important;
        }


        .nexora-main::before {
            content: '';

            position: fixed;

            right: 0;
            top: 72px;

            width: 46vw;
            height: 58vh;

            pointer-events: none;

            background:
                radial-gradient(
                    circle at 75% 15%,
                    rgba(139, 124, 255, 0.055),
                    transparent 54%
                );

            filter: blur(30px);

            z-index: -1;
        }


        .nexora-main
        [class*="rounded-2xl"]
        [class*="bg-[#12151A]"] {
            border-color:
                var(--nexora-border) !important;

            background:
                linear-gradient(
                    145deg,
                    rgba(21, 26, 34, 0.82),
                    rgba(12, 16, 22, 0.72)
                ) !important;

            box-shadow:
                0 22px 55px rgba(0, 0, 0, 0.20),
                inset 0 1px 0 rgba(255, 255, 255, 0.026);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            transition:
                transform 180ms ease,
                border-color 180ms ease,
                box-shadow 180ms ease;
        }


        .nexora-main
        [class*="rounded-2xl"][class*="bg-[#12151A]"]:hover {
            border-color:
                rgba(139, 124, 255, 0.18) !important;

            box-shadow:
                0 26px 70px rgba(0, 0, 0, 0.24),
                0 0 34px rgba(139, 124, 255, 0.035),
                inset 0 1px 0 rgba(255, 255, 255, 0.028);
        }


        .nexora-main [class*="border-[#242830]"] {
            border-color:
                var(--nexora-border) !important;
        }


        .nexora-main [class*="bg-[#0B0D10]"] {
            background:
                linear-gradient(
                    145deg,
                    rgba(10, 14, 19, 0.92),
                    rgba(7, 10, 15, 0.82)
                ) !important;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.018);
        }


        .nexora-main [class*="bg-[#151A21]"],
        .nexora-main [class*="bg-[#171C23]"],
        .nexora-main [class*="bg-[#0E1116]"] {
            background-color:
                rgba(17, 22, 30, 0.76) !important;
        }


        .nexora-main a,
        .nexora-main button {
            transition-property:
                transform,
                background-color,
                border-color,
                box-shadow,
                color,
                opacity;

            transition-duration: 180ms;
        }


        .nexora-main a[class*="bg-[#F5F5F2]"],
        .nexora-main button[class*="bg-[#F5F5F2]"] {
            box-shadow:
                0 10px 24px rgba(0, 0, 0, 0.18),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }


        .nexora-main a[class*="bg-[#F5F5F2]"]:hover,
        .nexora-main button[class*="bg-[#F5F5F2]"]:hover {
            transform: translateY(-1px);

            box-shadow:
                0 15px 30px rgba(0, 0, 0, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }


        .nexora-main input,
        .nexora-main select,
        .nexora-main textarea {
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.016);
        }


        .nexora-main [class*="ring-[#8B7CFF]"] {
            box-shadow:
                0 0 0 1px rgba(139, 124, 255, 0.12),
                0 0 22px rgba(139, 124, 255, 0.045) !important;
        }


        /* ============================================================
           RESPONSIVE
        ============================================================ */

        @media (max-width: 1024px) {

            .nexora-sidebar {
                width:
                    var(--nx-sidebar-closed) !important;
            }


            .nexora-sidebar > div:first-child {
                justify-content: center;

                padding-left: 0 !important;
                padding-right: 0 !important;
            }


            .nexora-sidebar > div:first-child
            > div:first-child {
                width: 40px !important;
                min-width: 40px !important;

                justify-content: center;

                margin-left: auto;
                margin-right: auto;
            }


            .nexora-sidebar
            > div:first-child
            > div:first-child
            > div:nth-child(2),

            .nexora-sidebar nav > p,
            .nexora-sidebar .nexora-nav-label,
            .nexora-sidebar .nexora-logout-label,
            .nexora-sidebar .min-w-0 {
                width: 0 !important;
                max-width: 0 !important;

                opacity: 0 !important;

                overflow: hidden !important;
            }


            .nexora-sidebar nav a {
                justify-content: center;

                padding-left: 0 !important;
                padding-right: 0 !important;
            }


            .nexora-sidebar .nexora-sidebar-logout {
                justify-content: center;

                padding-left: 0 !important;
                padding-right: 0 !important;
            }


            .nexora-main-shell {
                margin-left:
                    var(--nx-sidebar-closed) !important;
            }


            .nexora-main::before {
                width: 72vw;
            }

        }


        @media (max-width: 700px) {

            .nexora-topbar {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }


            #globalSearchWrapper {
                width:
                    min(100%, 380px) !important;
            }


            #globalSearchWrapper + * {
                flex-shrink: 0;
            }


            .nexora-topbar
            > div:last-child
            > a[aria-label="Notifications"] {
                display: none;
            }


            #userMenuButton > div:nth-child(2),
            #userMenuButton > span:last-child {
                display: none;
            }


            .nexora-main {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

        }


        @media (prefers-reduced-motion: reduce) {

            .nexora-sidebar,
            .nexora-sidebar a,
            .nexora-main
            [class*="rounded-2xl"][class*="bg-[#12151A]"],
            .nexora-main a,
            .nexora-main button {
                transition: none !important;
            }


            ::view-transition-old(nexora-content),
            ::view-transition-new(nexora-content),
            ::view-transition-old(root),
            ::view-transition-new(root) {
                animation: none !important;
            }

        }

    </style>


    <script>

        /*
         * Read the sidebar state BEFORE the page paints.
         *
         * This prevents:
         *
         * OPEN SIDEBAR
         *      ↓
         * page loads
         *      ↓
         * CLOSED SIDEBAR
         *
         * which would create a visible jump between pages.
         */
        (function () {

            try {

                if (
                    localStorage.getItem(
                        'nexora.sidebar.collapsed'
                    ) === '1'
                ) {

                    document.documentElement.classList.add(
                        'nexora-sidebar-collapsed'
                    );

                }

            } catch (e) {}

        })();

    </script>


</head>


<body
    class="nexora-spatial bg-[#080B10] font-sans text-[#F5F5F2] antialiased"
>


@php

    $currentCompany = Auth::user()->companies()->first();

@endphp


<div class="flex min-h-screen">


    {{-- ============================================================ --}}
    {{-- SIDEBAR --}}
    {{-- ============================================================ --}}


    <aside
        class="nexora-sidebar fixed inset-y-0 left-0 z-40 flex w-[246px] flex-col border-r border-[#202630] bg-[#090C11]"
    >


        {{-- ======================================================== --}}
        {{-- COMPANY BRAND --}}
        {{-- ======================================================== --}}


        <div
            class="flex h-[72px] items-center border-b border-[#202630] px-8"
        >


            <div class="flex min-w-0 items-center gap-3">


                {{-- Company Logo --}}
                @if ($currentCompany?->logo)

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-[#2A3039] bg-[#11151B]"
                    >

                        <img
                            src="{{ asset('storage/' . $currentCompany->logo) }}"
                            alt="{{ $currentCompany->name }}"
                            class="h-full w-full object-contain"
                        >

                    </div>

                @else

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#11151B] text-sm font-semibold tracking-[0.12em] text-[#A99FFF]"
                    >
                        N
                    </div>

                @endif


                {{-- Company Name --}}
                <div class="min-w-0">

                    <p
                        class="truncate text-[14px] font-semibold leading-tight text-[#F5F5F2]"
                    >
                        {{ $currentCompany?->name ?? 'NEXORA Corporation' }}
                    </p>


                    <p
                        class="mt-1 truncate text-[9px] uppercase leading-tight tracking-[0.18em] text-[#727985]"
                    >
                        Business OS
                    </p>

                </div>


            </div>


        </div>


        {{-- ======================================================== --}}
        {{-- SIDEBAR COLLAPSE --}}
        {{-- ======================================================== --}}


        <button
            id="nexoraSidebarToggle"
            type="button"
            class="nexora-sidebar-toggle"
            aria-label="Collapse sidebar"
            title="Collapse sidebar"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                aria-hidden="true"
            >
                <path
                    d="m14 6-6 6 6 6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </button>


        {{-- ======================================================== --}}
        {{-- NAVIGATION --}}
        {{-- ======================================================== --}}


        <nav class="flex-1 overflow-y-auto px-4 py-7">


            {{-- ==================================================== --}}
            {{-- WORKSPACE --}}
            {{-- ==================================================== --}}


            <p
                class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
            >
                Workspace
            </p>


            {{-- Dashboard --}}
            @if (Auth::user()->hasPermission('View Dashboard'))

                <a
                    href="{{ route('dashboard') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('dashboard')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('dashboard') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M4.5 10.5 12 4l7.5 6.5V19a1.5 1.5 0 0 1-1.5 1.5H6A1.5 1.5 0 0 1 4.5 19v-8.5Z"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M9.5 20.5v-5h5v5"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Dashboard
                    </span>

                </a>

            @endif


            {{-- Sales --}}
            @if (Auth::user()->hasPermission('Manage Sales'))

                <a
                    href="{{ route('orders.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('orders.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('orders.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 4 19 12l-7 8-7-8 7-8Z"
                                stroke-linejoin="round"
                            />
                            <circle
                                cx="12"
                                cy="12"
                                r="1.5"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Sales
                    </span>

                </a>

            @endif


            {{-- Customers --}}
            @if (Auth::user()->hasPermission('Manage Customers'))

                <a
                    href="{{ route('customers.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('customers.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('customers.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3"
                            />

                            <path
                                d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Customers
                    </span>

                </a>

            @endif


            {{-- Products --}}
            @if (Auth::user()->hasPermission('Manage Products'))

                <a
                    href="{{ route('products.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('products.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('products.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M5 7.5 12 4l7 3.5v9L12 20l-7-3.5v-9Z"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M5 7.5 12 11l7-3.5M12 11v9"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Products
                    </span>

                </a>

            @endif


            {{-- Inventory --}}
            @if (Auth::user()->hasPermission('Manage Inventory'))

                <a
                    href="{{ route('inventory.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('inventory.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('inventory.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M4.5 7.5 12 4l7.5 3.5v9L12 20l-7.5-3.5v-9Z"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M8 9.5h8M8 13h8M8 16.5h4"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Inventory
                    </span>

                </a>


                {{-- Warehouses --}}
                <a
                    href="{{ route('warehouses.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('warehouses.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('warehouses.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M4 7h16l-2 10H6L4 7Z"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M8 7V5.5h8V7"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Warehouses
                    </span>

                </a>


                {{-- Stock Movements --}}
                <a
                    href="{{ route('stock-movements.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('stock-movements.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('stock-movements.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M8 5v14M5 8l3-3 3 3M16 19V5m-3 11 3 3 3-3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Stock Movements
                    </span>

                </a>

            @endif


            {{-- ==================================================== --}}
            {{-- MANAGEMENT --}}
            {{-- ==================================================== --}}


            <p
                class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
            >
                Management
            </p>


            {{-- Purchasing --}}
            @if (Auth::user()->hasPermission('Manage Purchasing'))

                <a
                    href="{{ route('purchasing.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('purchasing.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('purchasing.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="m12 4 6 8-6 8-6-8 6-8Z"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M12 8v8"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Purchasing
                    </span>

                </a>

            @endif


            {{-- Finance --}}
            @if (Auth::user()->hasPermission('Manage Finance'))

                <a
                    href="{{ route('finance.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('finance.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('finance.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <rect
                                x="4.5"
                                y="5"
                                width="15"
                                height="14"
                                rx="2"
                            />

                            <path
                                d="M8 9h8M8 13h3M15 13h1M8 16h5M15 16h1"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Finance
                    </span>

                </a>

            @endif


            {{-- Analytics --}}
            @if (Auth::user()->hasPermission('View Analytics'))

                <a
                    href="{{ route('analytics.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('analytics.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('analytics.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M5 19V9M12 19V5M19 19v-7"
                                stroke-linecap="round"
                            />

                            <path
                                d="M3.5 19.5h17"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Analytics
                    </span>

                </a>

            @endif


            {{-- Team --}}
            @if (Auth::user()->hasPermission('Manage Team'))

                <a
                    href="{{ route('team.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('team.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('team.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3"
                            />

                            <path
                                d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Team
                    </span>

                </a>

            @endif


            {{-- ==================================================== --}}
            {{-- SECURITY --}}
            {{-- ==================================================== --}}


            @if (Auth::user()->hasPermission('Manage Settings'))

                <p
                    class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
                >
                    Security
                </p>


                {{-- Audit Log --}}
                <a
                    href="{{ route('audit-logs.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('audit-logs.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('audit-logs.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 4 19 12l-7 8-7-8 7-8Z"
                                stroke-linejoin="round"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="1.5"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Audit Log
                    </span>

                </a>

            @endif


            {{-- ==================================================== --}}
            {{-- CONFIGURATION --}}
            {{-- ==================================================== --}}


            @if (Auth::user()->hasPermission('Manage Settings'))

                <p
                    class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
                >
                    Configuration
                </p>


                {{-- Settings --}}
                <a
                    href="{{ route('settings.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('settings.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('settings.*') ? 'text-[#9C91FF]' : '' }}"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.55"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            />

                            <path
                                d="M19 12a7.2 7.2 0 0 0-.08-1l1.55-1.2-1.8-3.1-1.82.7a7.4 7.4 0 0 0-1.73-1L14.9 4h-3.8l-.22 2.4a7.4 7.4 0 0 0-1.73 1l-1.82-.7-1.8 3.1L7.08 11a7.2 7.2 0 0 0 0 2l-1.55 1.2 1.8 3.1 1.82-.7a7.4 7.4 0 0 0 1.73 1l.22 2.4h3.8l.22-2.4a7.4 7.4 0 0 0 1.73-1l1.82.7 1.8-3.1-1.55-1.2c.05-.33.08-.66.08-1Z"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-nav-label">
                        Settings
                    </span>

                </a>

            @endif


        </nav>


        {{-- ======================================================== --}}
        {{-- SIDEBAR USER --}}
        {{-- ======================================================== --}}


        <div class="border-t border-[#202630] px-5 py-5">


            <div class="flex items-center gap-3">


                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#5148A8] text-sm font-medium"
                >

                    @if (Auth::user()->avatar)

                        <img
                            src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            alt="{{ Auth::user()->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    @endif

                </div>


                <div class="min-w-0">

                    <p
                        class="truncate text-xs font-medium text-white"
                    >
                        {{ Auth::user()->name }}
                    </p>


                    <p
                        class="truncate text-[11px] text-[#747B87]"
                    >
                        {{ Auth::user()->email }}
                    </p>

                </div>


            </div>


            {{-- Logout --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="mt-4"
            >

                @csrf

                <button
                    type="submit"
                    class="nexora-sidebar-logout flex w-full items-center gap-3 rounded-lg px-2 py-2 text-sm text-[#8D949F] transition hover:bg-[#141820] hover:text-white"
                >

                    <span class="nexora-logout-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.65"
                            aria-hidden="true"
                        >
                            <path
                                d="M10 5H6.5A1.5 1.5 0 0 0 5 6.5v11A1.5 1.5 0 0 0 6.5 19H10"
                                stroke-linecap="round"
                            />

                            <path
                                d="m14 8 4 4-4 4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M18 12H9"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <span class="nexora-logout-label">
                        Logout
                    </span>

                </button>

            </form>


        </div>


    </aside>


    {{-- ============================================================ --}}
    {{-- MAIN --}}
    {{-- ============================================================ --}}


    <div
        id="nexoraMainShell"
        class="nexora-main-shell ml-[246px] flex min-h-screen min-w-0 flex-1 flex-col"
    >


        {{-- ======================================================== --}}
        {{-- TOPBAR --}}
        {{-- ======================================================== --}}


        <header
            class="nexora-topbar relative z-50 flex h-[72px] shrink-0 items-center justify-between border-b border-[#202630] bg-[#090C11] px-8"
        >


            {{-- ==================================================== --}}
            {{-- GLOBAL SEARCH --}}
            {{-- ==================================================== --}}


            <div
                id="globalSearchWrapper"
                class="relative w-[465px]"
            >

                <div
                    id="globalSearchBox"
                    class="flex h-10 w-full items-center rounded-lg border border-[#29303B] bg-[#11161E] px-4 transition"
                >

                    <span
                        class="mr-3 flex shrink-0 items-center text-[#727985]"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.65"
                            class="h-[17px] w-[17px]"
                            aria-hidden="true"
                        >
                            <circle
                                cx="10.8"
                                cy="10.8"
                                r="5.8"
                            />

                            <path
                                d="m15.2 15.2 4.8 4.8"
                                stroke-linecap="round"
                            />
                        </svg>

                    </span>


                    <input
                        id="globalSearchInput"
                        type="text"
                        autocomplete="off"
                        spellcheck="false"
                        placeholder="Search anything..."
                        class="w-full border-0 bg-transparent text-sm text-white outline-none placeholder:text-[#666D78]"
                    >


                    <button
                        id="globalSearchShortcut"
                        type="button"
                        class="shrink-0 rounded bg-[#1D2430] px-2 py-1 text-[10px] text-[#777F8C] transition hover:text-[#A0A6B0]"
                    >
                        ⌘ K
                    </button>

                </div>


                {{-- Search Results --}}
                <div
                    id="globalSearchResults"
                    class="absolute left-0 right-0 top-[52px] hidden overflow-hidden rounded-2xl border border-[#292F39] bg-[#11151B] shadow-[0_25px_70px_rgba(0,0,0,0.45)]"
                >

                    <div
                        id="globalSearchContent"
                        class="max-h-[520px] overflow-y-auto"
                    >

                        {{-- Dynamic content --}}

                    </div>

                </div>

            </div>


            {{-- ==================================================== --}}
            {{-- TOPBAR RIGHT --}}
            {{-- ==================================================== --}}


            <div class="flex items-center gap-6">


                {{-- Notifications --}}
                <a
                    href="{{ route('notifications.index') }}"
                    class="relative text-xl text-[#A0A6B0] transition hover:text-white"
                    aria-label="Notifications"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.55"
                        class="h-[18px] w-[18px]"
                        aria-hidden="true"
                    >
                        <path
                            d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Z"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M10 21h4"
                            stroke-linecap="round"
                        />
                    </svg>


                    @php

                        $unreadNotifications = Auth::user()
                            ->unreadNotifications()
                            ->count();

                    @endphp


                    @if ($unreadNotifications > 0)

                        <span
                            class="absolute -right-1 -top-1 flex min-h-[16px] min-w-[16px] items-center justify-center rounded-full bg-[#8B7CFF] px-1 text-[8px] font-semibold text-white"
                        >
                            {{ $unreadNotifications > 9 ? '9+' : $unreadNotifications }}
                        </span>

                    @endif

                </a>


                {{-- User Menu --}}
                <div class="relative">


                    <button
                        type="button"
                        id="userMenuButton"
                        class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-[#11161E]"
                    >

                        <div
                            class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-[#303749] text-sm font-medium text-white"
                        >

                            @if (Auth::user()->avatar)

                                <img
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            @endif

                        </div>


                        <div class="hidden text-left sm:block">

                            <p class="text-xs font-medium text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-[11px] text-[#747B87]">
                                {{ Auth::user()->roles()->first()?->name ?? 'User' }}
                            </p>

                        </div>


                        <span class="ml-1 text-[#7B828D]">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                class="h-3.5 w-3.5"
                                aria-hidden="true"
                            >
                                <path
                                    d="m7 10 5 5 5-5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        </span>

                    </button>


                    {{-- User Dropdown --}}
                    <div
                        id="userMenu"
                        class="absolute right-0 top-[52px] hidden w-[230px] overflow-hidden rounded-2xl border border-[#292F39] bg-[#11151B] shadow-[0_25px_70px_rgba(0,0,0,0.45)]"
                    >

                        <div class="border-b border-[#242830] px-5 py-4">

                            <p
                                class="truncate text-sm font-medium text-[#F5F5F2]"
                            >
                                {{ Auth::user()->name }}
                            </p>

                            <p
                                class="mt-1 truncate text-xs text-[#727985]"
                            >
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        <div class="p-2">


                            {{-- Profile --}}
                            <a
                                href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                            >

                                <span class="text-[#8B7CFF]">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.55"
                                        class="h-4 w-4"
                                        aria-hidden="true"
                                    >
                                        <circle
                                            cx="12"
                                            cy="8"
                                            r="3"
                                        />

                                        <path
                                            d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                            stroke-linecap="round"
                                        />
                                    </svg>

                                </span>


                                Profile

                            </a>


                            {{-- Settings --}}
                            @if (Auth::user()->hasPermission('Manage Settings'))

                                <a
                                    href="{{ route('settings.index') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span class="text-[#8B7CFF]">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.55"
                                            class="h-4 w-4"
                                            aria-hidden="true"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="3"
                                            />

                                            <path
                                                d="M19 12a7.2 7.2 0 0 0-.08-1l1.55-1.2-1.8-3.1-1.82.7a7.4 7.4 0 0 0-1.73-1L14.9 4h-3.8l-.22 2.4a7.4 7.4 0 0 0-1.73 1l-1.82-.7-1.8 3.1L7.08 11a7.2 7.2 0 0 0 0 2l-1.55 1.2 1.8 3.1 1.82-.7a7.4 7.4 0 0 0 1.73 1l.22 2.4h3.8l.22-2.4a7.4 7.4 0 0 0 1.73-1l1.82.7 1.8-3.1-1.55-1.2c.05-.33.08-.66.08-1Z"
                                                stroke-linejoin="round"
                                            />
                                        </svg>

                                    </span>


                                    Settings

                                </a>

                            @endif


                            {{-- Audit Log --}}
                            @if (Auth::user()->hasPermission('Manage Settings'))

                                <a
                                    href="{{ route('audit-logs.index') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span class="text-[#8B7CFF]">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.55"
                                            class="h-4 w-4"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M12 4 19 7.5 12 11 5 7.5 12 4Z"
                                                stroke-linejoin="round"
                                            />

                                            <path
                                                d="m5 12 7 3.5 7-3.5M5 16.5 12 20l7-3.5"
                                                stroke-linejoin="round"
                                            />
                                        </svg>

                                    </span>


                                    Audit Log

                                </a>

                            @endif


                        </div>


                        {{-- Logout --}}
                        <div class="border-t border-[#242830] p-2">

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span class="text-[#8B7CFF]">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.55"
                                            class="h-4 w-4"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M10 5H6.5A1.5 1.5 0 0 0 5 6.5v11A1.5 1.5 0 0 0 6.5 19H10"
                                                stroke-linecap="round"
                                            />

                                            <path
                                                d="m14 8 4 4-4 4"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />

                                            <path
                                                d="M18 12H9"
                                                stroke-linecap="round"
                                            />
                                        </svg>

                                    </span>


                                    Logout

                                </button>

                            </form>

                        </div>


                    </div>

                </div>

            </div>

        </header>


        {{-- ======================================================== --}}
        {{-- CONTENT --}}
        {{-- ======================================================== --}}


        <main
            class="nexora-main min-w-0 flex-1 px-8 pt-5 pb-8"
        >

            <div
                class="mx-auto w-full max-w-[1500px]"
            >

                {{ $slot }}

            </div>

        </main>


    </div>

</div>


{{-- ================================================================ --}}
{{-- GLOBAL SEARCH JAVASCRIPT --}}
{{-- ================================================================ --}}


<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar =
        document.querySelector('.nexora-sidebar');

    const mainShell =
        document.getElementById('nexoraMainShell');

    const toggle =
        document.getElementById('nexoraSidebarToggle');


    if (!sidebar || !mainShell || !toggle) {
        return;
    }


    const storageKey =
        'nexora.sidebar.collapsed';


    function setSidebarState(
        collapsed,
        persist = true
    ) {

        sidebar.classList.toggle(
            'is-collapsed',
            collapsed
        );


        mainShell.classList.toggle(
            'is-sidebar-collapsed',
            collapsed
        );


        document.documentElement.classList.toggle(
            'nexora-sidebar-collapsed',
            collapsed
        );


        toggle.setAttribute(
            'aria-label',
            collapsed
                ? 'Expand sidebar'
                : 'Collapse sidebar'
        );


        toggle.setAttribute(
            'title',
            collapsed
                ? 'Expand sidebar'
                : 'Collapse sidebar'
        );


        if (persist) {

            localStorage.setItem(
                storageKey,
                collapsed ? '1' : '0'
            );

        }

    }


    function syncLabels() {

        sidebar
            .querySelectorAll('.nexora-nav-label')
            .forEach(function (label) {

                const link =
                    label.closest('a');

                if (link) {

                    link.setAttribute(
                        'data-nx-label',
                        label.textContent.trim()
                    );

                }

            });

    }


    syncLabels();


    if (window.innerWidth <= 1024) {

        setSidebarState(
            true,
            false
        );

    } else {

        setSidebarState(
            localStorage.getItem(storageKey) === '1',
            false
        );

    }


    toggle.addEventListener(
        'click',
        function () {

            setSidebarState(
                !sidebar.classList.contains(
                    'is-collapsed'
                ),
                true
            );

        }
    );


    window.addEventListener(
        'resize',
        function () {

            if (window.innerWidth <= 1024) {

                setSidebarState(
                    true,
                    false
                );

            } else {

                setSidebarState(
                    localStorage.getItem(storageKey) === '1',
                    false
                );

            }

        }
    );

});


</script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    const searchWrapper =
        document.getElementById(
            'globalSearchWrapper'
        );


    const searchBox =
        document.getElementById(
            'globalSearchBox'
        );


    const searchInput =
        document.getElementById(
            'globalSearchInput'
        );


    const searchShortcut =
        document.getElementById(
            'globalSearchShortcut'
        );


    const searchResults =
        document.getElementById(
            'globalSearchResults'
        );


    const searchContent =
        document.getElementById(
            'globalSearchContent'
        );


    const userMenuButton =
        document.getElementById(
            'userMenuButton'
        );


    const userMenu =
        document.getElementById(
            'userMenu'
        );


    let searchTimeout = null;


    /*
    |--------------------------------------------------------------------------
    | Search Helpers
    |--------------------------------------------------------------------------
    */


    function openSearchResults() {

        searchResults.classList.remove(
            'hidden'
        );

    }


    function closeSearchResults() {

        searchResults.classList.add(
            'hidden'
        );

    }


    function setSearchLoading() {

        searchContent.innerHTML = `

            <div class="px-6 py-7">

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10]"
                    >

                        <svg
                            class="h-4 w-4 animate-spin text-[#8B7CFF]"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="3"
                            ></circle>


                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            ></path>

                        </svg>

                    </div>


                    <div>

                        <p
                            class="text-sm font-medium text-[#F5F5F2]"
                        >
                            Searching NEXORA
                        </p>


                        <p
                            class="mt-1 text-xs text-[#666C75]"
                        >
                            Looking across your business data...
                        </p>

                    </div>

                </div>

            </div>

        `;

    }


    function setSearchEmpty(query) {

        searchContent.innerHTML = `

            <div class="px-6 py-8 text-center">

                <div
                    class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] text-[#666C75]"
                >
                    ⌕
                </div>


                <p
                    class="mt-4 text-sm font-medium text-[#F5F5F2]"
                >
                    No results found
                </p>


                <p
                    class="mt-1 text-xs text-[#666C75]"
                >
                    No matching records for "${escapeHtml(query)}".
                </p>

            </div>

        `;

    }


    function setSearchError() {

        searchContent.innerHTML = `

            <div class="px-6 py-8 text-center">

                <div
                    class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-400"
                >
                    !
                </div>


                <p
                    class="mt-4 text-sm font-medium text-[#F5F5F2]"
                >
                    Search unavailable
                </p>


                <p
                    class="mt-1 text-xs text-[#666C75]"
                >
                    Something went wrong while searching.
                </p>

            </div>

        `;

    }


    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }


    function renderResults(results) {

        if (!results.length) {

            setSearchEmpty(
                searchInput.value.trim()
            );

            return;

        }


        searchContent.innerHTML = `

            <div
                class="border-b border-[#242830] px-5 py-4"
            >

                <div
                    class="flex items-center justify-between"
                >

                    <div>

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#666C75]"
                        >
                            Search Results
                        </p>


                        <p
                            class="mt-1 text-xs text-[#8B919A]"
                        >

                            ${results.length}

                            ${results.length === 1
                                ? 'result'
                                : 'results'}

                            found

                        </p>

                    </div>


                    <span
                        class="rounded-lg bg-[#1A2029] px-2 py-1 text-[9px] text-[#666C75]"
                    >
                        ENTER
                    </span>

                </div>

            </div>


            <div class="p-2">

                ${results.map(
                    (result, index) => `

                    <a
                        href="${escapeHtml(result.url)}"
                        class="global-search-result group flex items-center gap-4 rounded-xl px-4 py-3 transition hover:bg-[#181D25]"
                        data-index="${index}"
                    >

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] text-sm text-[#A99FFF] transition group-hover:border-[#8B7CFF]/40 group-hover:bg-[#8B7CFF]/10"
                        >

                            ${escapeHtml(
                                result.icon || '◈'
                            )}

                        </div>


                        <div
                            class="min-w-0 flex-1"
                        >

                            <div
                                class="flex items-center gap-2"
                            >

                                <p
                                    class="truncate text-sm font-medium text-[#F5F5F2]"
                                >
                                    ${escapeHtml(
                                        result.title
                                    )}
                                </p>

                            </div>


                            <p
                                class="mt-1 truncate text-xs text-[#747B87]"
                            >
                                ${escapeHtml(
                                    result.subtitle || ''
                                )}
                            </p>

                        </div>


                        <div
                            class="shrink-0 text-right"
                        >

                            <span
                                class="rounded-md border border-[#242830] bg-[#0D1116] px-2 py-1 text-[9px] uppercase tracking-[0.12em] text-[#666C75]"
                            >
                                ${escapeHtml(
                                    result.type
                                )}
                            </span>

                        </div>


                        <span
                            class="text-sm text-[#4D535D] transition group-hover:translate-x-0.5 group-hover:text-[#A99FFF]"
                        >
                            →
                        </span>


                    </a>

                `
                ).join('')}

            </div>

        `;

    }


    async function performSearch(query) {

        if (query.length < 2) {

            searchContent.innerHTML = '';

            closeSearchResults();

            return;

        }


        openSearchResults();

        setSearchLoading();


        try {

            const url = new URL(
                @json(route('global.search')),
                window.location.origin
            );


            url.searchParams.set(
                'q',
                query
            );


            const response = await fetch(
                url,
                {
                    method: 'GET',

                    headers: {
                        'Accept':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest',
                    },
                }
            );


            if (!response.ok) {

                throw new Error(
                    'Search request failed.'
                );

            }


            const data =
                await response.json();


            renderResults(
                data.results || []
            );


        } catch (error) {

            console.error(error);

            setSearchError();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Search Input
    |--------------------------------------------------------------------------
    */


    searchInput.addEventListener(
        'focus',
        function () {

            searchBox.classList.add(
                'border-[#8B7CFF]/70'
            );


            const query =
                searchInput.value.trim();


            if (query.length >= 2) {

                openSearchResults();

            }

        }
    );


    searchInput.addEventListener(
        'blur',
        function () {

            searchBox.classList.remove(
                'border-[#8B7CFF]/70'
            );

        }
    );


    searchInput.addEventListener(
        'input',
        function () {

            const query =
                searchInput.value.trim();


            clearTimeout(
                searchTimeout
            );


            if (query.length < 2) {

                closeSearchResults();

                searchContent.innerHTML = '';

                return;

            }


            openSearchResults();

            setSearchLoading();


            searchTimeout = setTimeout(
                function () {

                    performSearch(
                        query
                    );

                },
                250
            );

        }
    );


    searchInput.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeSearchResults();

                searchInput.blur();

                return;

            }


            if (event.key === 'Enter') {

                const firstResult =
                    searchContent.querySelector(
                        '.global-search-result'
                    );


                if (firstResult) {

                    firstResult.click();

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Shortcut Ctrl + K / Cmd + K
    |--------------------------------------------------------------------------
    */


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                (event.ctrlKey || event.metaKey)
                &&
                event.key.toLowerCase() === 'k'
            ) {

                event.preventDefault();

                searchInput.focus();

                searchInput.select();

            }

        }
    );


    searchShortcut.addEventListener(
        'click',
        function () {

            searchInput.focus();

            searchInput.select();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Close Search When Clicking Outside
    |--------------------------------------------------------------------------
    */


    document.addEventListener(
        'click',
        function (event) {

            if (
                !searchWrapper.contains(
                    event.target
                )
            ) {

                closeSearchResults();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | User Dropdown
    |--------------------------------------------------------------------------
    */


    userMenuButton.addEventListener(
        'click',
        function (event) {

            event.stopPropagation();

            userMenu.classList.toggle(
                'hidden'
            );

        }
    );


    document.addEventListener(
        'click',
        function (event) {

            if (
                !userMenu.contains(
                    event.target
                )
                &&
                !userMenuButton.contains(
                    event.target
                )
            ) {

                userMenu.classList.add(
                    'hidden'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Smooth Internal Page Navigation
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    |
    | We DO NOT use fetch() to replace <main>.
    |
    | Laravel performs the normal page navigation.
    |
    | This means:
    |
    | 1. request()->routeIs(...) changes correctly.
    | 2. Sidebar highlight changes correctly.
    | 3. Dashboard charts load normally.
    | 4. Dashboard donut charts load normally.
    | 5. Dashboard tables load normally.
    | 6. Page-specific JavaScript runs normally.
    | 7. Blade permissions remain correct.
    |
    | Chrome's native View Transition API handles the visual
    | transition between the old and new document.
    |
    |--------------------------------------------------------------------------
    */


    function isNavigableInternalLink(link) {

        if (!link) {
            return false;
        }


        if (
            link.target === '_blank'
            ||
            link.hasAttribute('download')
            ||
            link.hasAttribute(
                'data-no-nexora-transition'
            )
        ) {

            return false;

        }


        const href =
            link.getAttribute('href');


        if (
            !href
            ||
            href.startsWith('#')
            ||
            href.startsWith('javascript:')
        ) {

            return false;

        }


        let url;


        try {

            url = new URL(
                href,
                window.location.href
            );

        } catch (error) {

            return false;

        }


        return (
            url.origin === window.location.origin
            &&
            url.protocol === window.location.protocol
        );

    }


    /*
     * We intentionally DO NOT call preventDefault().
     *
     * Laravel receives the request normally.
     *
     * Therefore:
     *
     * request()->routeIs(...)
     *
     * gets evaluated again on the destination page.
     */
    document.addEventListener(
        'click',
        function (event) {

            const link =
                event.target.closest(
                    'a[href]'
                );


            if (
                !isNavigableInternalLink(
                    link
                )
            ) {

                return;

            }


            if (
                event.defaultPrevented
                ||
                event.button !== 0
                ||
                event.metaKey
                ||
                event.ctrlKey
                ||
                event.shiftKey
                ||
                event.altKey
            ) {

                return;

            }


            const url =
                new URL(
                    link.href,
                    window.location.href
                );


            /*
             * Same page + hash:
             * allow normal anchor behavior.
             */
            if (
                url.pathname ===
                    window.location.pathname
                &&
                url.search ===
                    window.location.search
                &&
                url.hash
            ) {

                return;

            }


            /*
             * Tell the current document that a real navigation
             * is beginning.
             *
             * We do not block the browser navigation.
             */
            document.documentElement.classList.add(
                'nexora-is-navigating'
            );

        }
    );


    /*
     * Remove the navigation state when the new Laravel document
     * finishes loading or when browser Back / Forward is used.
     */
    window.addEventListener(
        'pageshow',
        function () {

            document.documentElement.classList.remove(
                'nexora-is-navigating'
            );

        }
    );


});


</script>


</body>


</html>