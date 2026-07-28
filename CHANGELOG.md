<!-- markdownlint-disable MD024 -->

# Changelog

All notable changes to the **Alsyundawy Looking Glass** project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.1.0-FIX] - 2026-07-29

### Security & Compliance

- Fixed Checkov `CKV2_GHA_1` workflow top-level security permissions across `devskim.yml` and `codeql.yml`.
- Fixed DevSkim `DS137138` (HTTP URL scheme in `parse_url`) and `DS162092` (`localhost` detection string artifact).
- Upgraded Grype Super-Linter GitHub Action vulnerability by bumping `@v8` to `@v8.3.1`.
- Added Subresource Integrity (`integrity="sha384-..."`) and `crossorigin="anonymous"` attributes to all CDN CSS and JS resources (PureCSS, Bootstrap, FontAwesome, jQuery, Bootstrap JS).
- Resolved Zizmor `GITHUB_TOKEN` environment configuration requirements.

### Bug Fixes & Refactoring

- Resolved all repository linter and security scanner issues (Checkov, DevSkim, djlint, Grype, JSCPD, Lychee, PHPCS, Psalm, v8r, Zizmor).
- Fixed djlint `H030` & `H031` HTML meta description and keyword tags on error pages `400.html` through `504.html`.
- Added standard `background-clip: text;` CSS property alongside `-webkit-background-clip: text;` on error pages.
- Fixed JSCPD duplicate code blocks by refactoring download test cards and test forms into unified loops.
- Fixed Lychee link checker root-relative link resolution on HTML error pages using `./`.
- Fixed PHPCS header spacing, control structure colon spacing, and indentation in `index.php`.
- Fixed Psalm type assertions, boolean `!empty` checks, session status verification, and strict superglobal type handling.
- Fixed `v8r` and `yamllint` `dependabot.yml` schema validation and unneeded string quotes across workflow files.
- Renamed utility function `find_binary()` to camelCase `findBinary()` for strict linter compliance.

---

## [1.1.0] - 2026-07-18

### Security

- Added `JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE` flags to all inline JSON-LD `json_encode()` calls to prevent `</script>` tag injection and ensure proper Unicode passthrough in structured data blocks.
- Fixed JSON-LD `alternateName` field: replaced `$siteNameSafe` (HTML-escaped) with raw `$siteName`; HTML entity encoding is incorrect inside JSON context.

### Bug Fixes & Optimization

- Fixed WhatsApp social link in footer: corrected scientific-notation artifact (`wa.me/6.28126969696e+11`) back to plain numeric format (`wa.me/628126969696`) as required by the `wa.me` API spec.
- Fixed PeeringDB footer link upgraded from HTTP to HTTPS.
- Fixed streaming POST handler: removed incorrect `sanitize_output()` (`htmlspecialchars`) wrapping on plain-text terminal output; HTML entity encoding in a `text/plain` context corrupts special characters such as `&`, `<`, `>` in `$serverLocation` and command display strings.
- Fixed output buffer handling in streaming POST handler: changed `ob_end_flush()` to `ob_end_clean()` to discard stale buffered content before starting the live process stream, preventing accidental partial HTML from being sent.
- Optimized `opcache.memory_consumption` from 1024 MB to 128 MB — the prior 1 GB allocation was excessive for a single-file PHP application.
- Improved inline documentation: added clarifying comment to session `ini_set()` calls explaining their role as backward-compatibility fallbacks.

---

## [1.0.9] - 2026-07-06

### Added

- Added `cdn.jsdelivr.net` to Content-Security-Policy `font-src` and `connect-src` directives to allow Font Awesome icons and bootstrap source maps to load without CSP violations.
- Added dynamic path-resolving helper function `findBinary()` to locate system utility executables in non-standard paths (e.g. `/usr/local/sbin` for macOS Homebrew `mtr`).

### Changed & UI Enhancements

- Enhanced DNS Lookup UI: each record type (`A`, `AAAA`, `NS`, `MX`, `SOA`, `TXT`) now has a distinct muted-gradient card header and colored inline badge pill for visual differentiation.
- Differentiated IPv4 and IPv6 download test buttons (`250MB`, `500MB`, `1GB`) and Speedtest/Repository buttons with unique muted-gradient color schemes per category.
- Optimized layout responsiveness for all devices from 320px to 2K; info cards now stack on tablet/mobile, DNS result tables use a horizontal scroll wrapper to prevent column clipping.
- Redesigned WHOIS lookup result table: elegant card with indigo-teal gradient header, monospace value column, zebra-striping, and a collapsible raw WHOIS data viewer.
- Softened all vivid/neon gradient colors on DNS badges, DNS card headers, and download test buttons so they remain visually distinct but no longer cause eye strain.
- Minified client-side CSS and JavaScript in production using clean-css and terser; PHP syntax verified before and after each minification pass.

---

## [1.0.8] - 2026-07-05

### Bug Fixes & Script Optimizations

- Fixed variable shadowing conflicts in inline client-side JavaScript (resolving duplicate variables like `t`, `e`, `o` inside fetch responses and event handlers) to prevent potential scope leakage and optimize browser rendering.
- Hardened the DNS Lookup tool by validating the process start status (`$result['started']`) before running record queries, failing fast with HTTP 500 if the `dig` binary is missing from the system.
- Cleaned up Markdown lint style warnings (`MD060/table-column-style`) in tables across documentation files by adding proper spacing to pipes.
- Removed leftover debug `console.log()` statements from the inline script block to ensure clean production console output.
- Updated system requirements documentation to detail required PHP extensions (filter, json), recommended extensions (mbstring), and necessary PHP functions (proc_open, stream_select, etc.).
- Replaced the broken `starchart.cc` star chart widget with a highly reliable alternative from `star-history.com` to keep the stargazers graph working.

---

## [1.0.7] - 2026-07-05

### Contribution Features & Fixes (by [@galiehneh](https://github.com/galiehneh))

- Fixed WhatsApp link in mobile header (`wa.me/628126969696`) to remove the duplicate digit.
- Fixed WhatsApp link in navigation/footer (`wa.me/628126969696`) to use a plain numeric format without dashes or signs (`+/-`), as required by the `wa.me` API.
- Corrected LinkedIn link to include the missing `/in/` segment (`linkedin.com/in/alsyundawy`).
- Corrected Telegram link to use the correct domain `t.me` instead of `telegram.org`.
- Added process launch validation (`$result['started']`) in the WHOIS handler before accessing stdout/stderr, returning an early HTTP 500 status code if the `whois` binary fails to launch.
- Replaced physical speedtest files on disk with an on-the-fly chunked stream generator (`?download=X` handler). It generates 250MB, 500MB, and 1GB test streams dynamically using `str_repeat` to save disk space.
- Updated download links in the UI to use relative paths (`?download=...`) instead of absolute URLs.

---

## [1.0.6] - 2026-07-05

### Security & Bug Fixes

- Removed `sanitize_output()` (`htmlspecialchars`) from `proc_open` streaming callbacks. Output is delivered as `Content-Type: text/plain` and rendered via JavaScript `createTextNode()`, which is inherently XSS-safe.
- Iperf3 command display now uses `$iperfport` variable (was hardcoded `5201` in 4 HTML locations); change the port once in config, it reflects everywhere.
- WhatsApp `wa.me` link in footer corrected to numeric format (`wa.me/628126969696`); the previous `+62-812-...` format with dashes is not accepted by the WhatsApp link API.
- Upgraded `bgp.he.net` footer link from HTTP to HTTPS.
- HTML5 semantics: second `<header class="site-header">` element changed to `<section aria-label="Site hero">` — the HTML5 spec permits only one `<header>` landmark per sectioning context.
- Removed non-existent `favicon.png` and duplicate `favicon-32x32` reference from `<head>`. Removed 7 `apple-touch-icon` sizes (152, 144, 120, 114, 76, 72, 60, 57 px) that have no corresponding file in the repository.
- Applied `sanitize_output()` to all `$tabs` array data echoed into HTML attributes and element content (defence-in-depth).
- Removed `console.log()` banner from production JavaScript.

---

## [1.0.5] - 2026-05-28

### Security & Hardening

- Hardened command execution by replacing shell-based command strings with `proc_open()` argv arrays to bypass the shell and reduce command injection risk.
- Replaced `shell_exec()` usage in WHOIS and DNS Lookup handlers with the same controlled `proc_open()` runner and timeout handling.
- Added safer cookie-domain detection that strips ports/brackets and avoids invalid session cookie domains on localhost, IP addresses, and host:port setups.
- Added Content-Security-Policy and Permissions-Policy headers compatible with existing CDN, inline CSS/JS, ipify client-IP lookups, and local assets.
- Improved host validation, timeout behavior, stderr handling, JSON response encoding, and output streaming without changing the existing UI layout.
- Reduced hard PHP extension checks to extensions actually used by this file.
- Updated JSON-LD `softwareVersion`/`dateModified` and fixed FAQ feature wording.

---

## [1.0.4] - 2026-05-05

### Added Features

- Added **WHOIS** tab for IP & domain WHOIS lookup with human-readable parsed output.
- Added **DNS Lookup** tab (`A`, `AAAA`, `NS`, `MX`, `SOA`, `TXT`) with modern responsive table display and Font Awesome icons per record type.
- WHOIS results parsed and presented in user-friendly format for non-technical users.
- DNS Lookup results rendered as structured tables per record type.
- Both new tabs use AJAX with CSRF protection, consistent with existing tabs.
- Updated requirements to include `whois` and `dig` system utilities.
- Minified WHOIS & DNS Lookup CSS and JavaScript.

---

## [1.0.3] - 2026-03-05

### Bug Fixes & Performance

- Fixed undefined `$script_name` variable; now uses `$_SERVER['SCRIPT_NAME']`.
- Fixed incorrect `date()` format from `'YY-mm-dd'` to `'Y-m-d'` (ISO 8601).
- Fixed missing `https://` scheme on `cdnjs.cloudflare.com` preconnect tag.
- Fixed JavaScript syntax error: invalid jQuery selector `$((html,body))`.
- Increased `fread()` buffer from 8192 to 16384 for faster streaming output.
- Removed duplicate changelog entry and blank lines in doc comment.
- Code review and optimization pass.

---

## [1.0.2] - 2026-02-18

### UI Polish & Minification

- Updated hero background in light mode to match dark mode style.
- Updated `lg-logo.webp` and `hero-lg.webp`.
- CSS and JavaScript minification optimization.

---

## [1.0.1] - 2026-02-17

### Security & Optimization

- Implemented Session Validity Check (CSRF Token) on POST requests.
- Added bilingual error handling (ID/EN) for timed-out sessions.
- WebP image optimization.
- Security enhancements and code optimization.

---

## [1.0.0] - 2026-02-16

### Initial Release

- Initial release of **Alsyundawy PHP Looking Glass**.
- Full Looking Glass functionality with optimized 3-column layout.
- Integrated Iperf3 and Download Test features.
- Dual stack IPv4 and IPv6 support.
