<?php
/**
 * ========================================================================
 * ========================================================================
 * ALSYUNDAWY - LOOKING GLASS NETWORK DIAGNOSTIC TOOLS
 * ========================================================================
 * 
 * @package     : Alsyundawy Looking Glass
 * @version     : 1.1.0
 * @author      : Harry Dertin Sutisna Alsyundawy <alsyundawy@gmail.com>
 * @copyright   : Copyleft 2026 Alsyundawy IT Solution
 * @license     : MIT License
 * @link        : https://alsyundawy.com
 * @phone       : +62 856-8-515-212 / +62 812-9898-6464
 * @link        : https://github.com/alsyundawy/php-looking-glass
 * @created     : February 16, 2026
 * @modified    : July 18, 2026
 * 
 * CREATED BY:
 * Name        : Harry Dertin Sutisna Alsyundawy
 * Email       : alsyundawy@gmail.com
 * Phone       : +62 856-8-515-212 / +62 812-9898-6464
 * Website     : https://alsyundawy.com
 * @author     : ALSYUNDAWY IT SOLUTION
 * @copyright  : 2022-2026 ALSYUNDAWY IT SOLUTION
 * @license    : MIT License
 * 
 * DESCRIPTION:
 * A professional, lightweight, single-file PHP Looking Glass tool designed for 
 * network diagnostics. Fully compatible with IPv4 and IPv6, featuring a modern, 
 * responsive UI (Dark/Light mode) and utilizing standard system utilities.
 * 
 * FEATURES:
 * [1] Network Diagnostics:
 *     - Ping (ICMP)
 *     - Traceroute (Path Analysis)
 *     - MTR (My Traceroute - Real-time packet loss analysis)
 *     - Host (DNS Lookup / A & AAAA Records)
 *     - WHOIS (IP & Domain WHOIS Lookup with human-readable output)
 *     - DNS Lookup (A, AAAA, NS, MX, SOA, TXT record checker)
 * 
 * [2] Performance Testing:
 *     - Iperf3 Integration (TCP/UDP, Reverse Mode)
 *     - File Download Tests (Customizable sizes)
 *     - Speedtest & Repository Links
 * 
 * [3] Interface & Usability:
 *     - 100% Responsive Design (Mobile to 4K support)
 *     - Dark/Light Theme Toggle
 *     - Real-time Client IP Detection
 *     - Server Information Display
 * 
 * [4] Security & Deployment:
 *     - Single PHP File ( No Database Required )
 *     - Input Sanitization (Prevents Command Injection)
 *     - Easy Configuration via top-of-script variables
 * 
 * REQUIREMENTS:
 * - PHP 8.1.0 or higher
 * - Web Server (Nginx, Apache, Caddy, etc.)
 * - PHP Extensions: filter, json
 * - Enabled PHP Functions: proc_open, proc_get_status, proc_close, proc_terminate,
 *   stream_get_contents, stream_select, fread, fclose (not disabled in disable_functions)
 * - System Utilities: ping, traceroute, mtr, iperf3, host, whois, dig
 *   (Ensure these binaries are installed and executable by the web server user)
 *
 * Catatan Perubahan (Changelog):
 * v1.0.0 - 2026-02-16
 *   - Initial Release.
 *   - Full Looking Glass functionality with optimized 3-column layout.
 *   - Integrated Iperf3 and Download Test features.
 * 
 * v1.0.1 - 2026-02-17
 *   - Implemented Session Validity Check (CSRF Token) on POST requests.
 *   - Added bilingual error handling (ID/EN) for timed-out sessions.
 *   - Enhancements and optimization image webp 
 *   - Security enhancements and optimization.
 * 
 * v1.0.2 - 2026-02-18
 *   - Updated hero background in light mode to match dark mode style.
 *   - Updated lg-log.webp & hero-lg.webp.
 *   - Optimize CSS & JS Minify.
 * 
 * v1.0.3 - 2026-03-05
 *   - Fixed undefined $script_name variable; now uses $_SERVER['SCRIPT_NAME'].
 *   - Fixed incorrect date() format from 'YY-mm-dd' to 'Y-m-d' (ISO 8601).
 *   - Fixed missing https:// scheme on cdnjs.cloudflare.com preconnect tag.
 *   - Fixed JavaScript syntax error: invalid jQuery selector $((html,body)).
 *   - Increased fread() buffer from 8192 to 16384 for faster streaming output.
 *   - Removed duplicate changelog entry and blank lines in doc comment.
 *   - Code review and optimization pass.
 * 
 * v1.0.4 - 2026-05-05
 *   - Added WHOIS tab for IP & domain WHOIS lookup with human-readable output.
 *   - Added DNS Lookup tab (A, AAAA, NS, MX, SOA, TXT) with modern responsive
 *     table display and Font Awesome icons per record type.
 *   - WHOIS results parsed and presented in user-friendly format for non-technical users.
 *   - DNS Lookup results rendered as structured tables per record type.
 *   - Both new tabs use AJAX with CSRF protection, consistent with existing tabs.
 *   - Updated requirements to include whois and dig system utilities.
 *   - Minified WHOIS & DNS Lookup CSS and JavaScript.
 * 
 * v1.0.5 - 2026-05-28
 *   - Hardened command execution by replacing shell-based command strings with
 *     proc_open() argv arrays to bypass the shell and reduce command injection risk.
 *   - Replaced shell_exec() usage in WHOIS and DNS Lookup handlers with the same
 *     controlled proc_open() runner and timeout handling.
 *   - Added safer cookie-domain detection that strips ports/brackets and avoids
 *     invalid session cookie domains on localhost, IP addresses, and host:port setups.
 *   - Added Content-Security-Policy and Permissions-Policy headers compatible with
 *     the existing CDN, inline CSS/JS, ipify client-IP lookups, and local assets.
 *   - Improved host validation, timeout behavior, stderr handling, JSON response
 *     encoding, and output streaming without changing the existing UI layout.
 *   - Reduced hard PHP extension checks to extensions actually used by this file.
 *   - Updated JSON-LD softwareVersion/dateModified and fixed FAQ feature wording.
 * 
 * v1.0.6 - 2026-07-05
 *   - Fixed double-escaping bug in streaming terminal output: removed
 *     sanitize_output() from proc_open stdout/stderr callbacks; JS already
 *     uses createTextNode() which is XSS-safe without HTML entities.
 *   - Fixed iperf command display hardcoded port '5201' now uses $iperfport
 *     variable consistently across IPv4 and IPv6 sections.
 *   - Fixed wa.me WhatsApp link format in footer (removed +/- characters;
 *     wa.me requires plain numeric format: wa.me/628126969696).
 *   - Fixed bgp.he.net link from HTTP to HTTPS in footer.
 *   - Fixed HTML semantics: second <header> (site-header) changed to <section>
 *     to comply with HTML5 spec (only one <header> landmark per section).
 *   - Fixed non-existent favicon.png and duplicate favicon-32x32 in <head>.
 *   - Fixed apple-touch-icon references for non-standard sizes that do not
 *     exist in the repository (kept only the existing apple-touch-icon.png).
 *   - Applied sanitize_output() to all $tabs data echoed into HTML for
 *     defence-in-depth XSS protection.
 *   - Removed console.log() from production JavaScript to prevent info leakage.
 * 
 * v1.0.7 - 2026-07-05 (Credit: @galiehneh)
 *   - Fixed WhatsApp link formats in mobile header and navigation/footer:
 *     removed duplicate digit and corrected footer to numeric-only format to
 *     comply with the wa.me API constraints.
 *   - Fixed LinkedIn social link by adding the missing "/in/" path segment.
 *   - Fixed Telegram social link by correcting the domain to t.me.
 *   - Hardened WHOIS lookup tool by verifying process start status ($result['started'])
 *     before accessing stdout, returning an early HTTP 500 status on launch failure.
 *   - Replaced physical speedtest files on disk with an on-the-fly chunked stream
 *     generator using str_repeat, serving 250MB, 500MB, and 1GB tests dynamically.
 *   - Updated front-end download links from absolute URLs to relative query path (?download=).
 * 
 * v1.0.8 - 2026-07-05
 *   - Fixed variable shadowing conflicts in inline client-side JavaScript to prevent scope leakage and browser parsing issues.
 *   - Hardened DNS Lookup tool by validating process start status ($result['started']) before running queries, failing fast with HTTP 500 if dig binary is missing.
 *   - Updated system requirements block comments to detail required PHP extensions (filter, json) and enabled functions (proc_open, stream_select, etc.).
 *   - Fixed table markdown formatting (MD060 lint style warnings) in README and README-ID.
 *   - Removed leftover console.log debug statements from production code.
 *   - Replaced broken starchart.cc stargazer widget with star-history.com API in documentation.
 *
 * v1.0.9 - 2026-07-06
 *   - Added cdn.jsdelivr.net to Content-Security-Policy font-src and connect-src directives to allow Font Awesome icons and bootstrap source maps to load without CSP violations.
 *   - Added dynamic path-resolving helper function find_binary() to locate system utility executables in non-standard paths (e.g. /usr/local/sbin for macOS Homebrew mtr).
 *   - Enhanced DNS Lookup UI: each record type (A, AAAA, NS, MX, SOA, TXT) now has a distinct muted-gradient card header and colored inline badge pill for visual differentiation.
 *   - Differentiated IPv4 and IPv6 download test buttons (250MB, 500MB, 1GB) and Speedtest/Repository buttons with unique muted-gradient color schemes per category.
 *   - Optimized layout responsiveness for all devices from 320px to 2K; info cards now stack on tablet/mobile, DNS result tables use a horizontal scroll wrapper to prevent column clipping.
 *   - Redesigned WHOIS lookup result table: elegant card with indigo-teal gradient header, monospace value column, zebra-striping, and a collapsible raw WHOIS data viewer.
 *   - Softened all vivid/neon gradient colors on DNS badges, DNS card headers, and download test buttons so they remain visually distinct but no longer cause eye strain.
 *   - Minified client-side CSS and JavaScript in production using clean-css and terser; PHP syntax verified before and after each minification pass.
 * 
 * v1.1.0 - 2026-07-18
 *   - Fixed WhatsApp social link in footer: corrected scientific-notation artifact
 *     (wa.me/6.28126969696e+11) back to plain numeric format (wa.me/628126969696)
 *     as required by the wa.me API spec.
 *   - Fixed PeeringDB footer link upgraded from HTTP to HTTPS.
 *   - Fixed streaming POST handler banner: removed incorrect sanitize_output()
 *     (htmlspecialchars) wrapping on plain-text terminal output; HTML entity
 *     encoding in a text/plain context corrupts special characters such as
 *     '&', '<', '>' in $serverLocation and command display strings.
 *   - Fixed output buffer handling in streaming POST handler: changed ob_end_flush()
 *     to ob_end_clean() to discard any stale buffered content before starting the
 *     live process stream, preventing accidental partial HTML from being sent.
 *   - Security: added JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE flags
 *     to all inline JSON-LD json_encode() calls to prevent </script> tag injection
 *     and ensure proper Unicode passthrough in structured data blocks.
 *   - Fixed JSON-LD alternateName field: replaced $siteNameSafe (HTML-escaped) with
 *     raw $siteName; HTML entity encoding is incorrect inside JSON context.
 *   - Optimized opcache.memory_consumption from 1024 MB to 128 MB — the prior 1 GB
 *     allocation was excessive for a single-file PHP application and could starve
 *     other PHP processes on shared or containerized hosts.
 *   - Improved inline documentation: added clarifying comment to session ini_set()
 *     calls explaining their role as backward-compatibility fallbacks.
 * 
 * ========================================================================
 */

declare(strict_types=1);

const APP_VERSION = '1.1.0';
const APP_UPDATED = '2026-07-18';

function error_die(string $title, string $message): never
{
    http_response_code(500);

    if (PHP_SAPI === 'cli') {
        die($title . PHP_EOL . $message . PHP_EOL);
    }

    $html = '<div style="font-family: sans-serif; padding: 20px; border: 2px solid red; margin: 20px;">' .
        '<strong>' . sanitize_output($title) . '</strong><br>' .
        sanitize_output($message) . '</div>';

    die($html);
}

function sanitize_output(mixed $output): string
{
    return htmlspecialchars((string) $output, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}

/**
 * Checks if the current request is sent over HTTPS.
 */
function is_https_request(): bool
{
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }

    if (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443') {
        return true;
    }

    $forwarded_proto = strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));
    return $forwarded_proto === 'https';
}

/**
 * Generates a safe cookie domain from request hosts.
 */
function safe_cookie_domain(): string
{
    $raw_host = (string) ($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '');
    $parsed_host = parse_url('http://' . $raw_host, PHP_URL_HOST);

    if (!is_string($parsed_host) || $parsed_host === '') {
        return '';
    }

    $host = strtolower(trim($parsed_host, "[] \t\n\r\0\x0B."));
    if (
        $host === '' ||
        $host === 'localhost' ||
        filter_var($host, FILTER_VALIDATE_IP) !== false ||
        strpos($host, '.') === false ||
        !preg_match('/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,63}$/i', $host)
    ) {
        return '';
    }

    return '.' . $host;
}

function normalize_host_input(string $host): string
{
    $host = trim($host);

    if (str_starts_with($host, '[') && str_ends_with($host, ']')) {
        $host = substr($host, 1, -1);
    }

    return rtrim($host, '.');
}

function utf8_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

/**
 * Validates domain name or IP addresses for diagnostics.
 */
function validate_host(string $host): bool
{
    $host = normalize_host_input($host);

    if ($host === '' || utf8_length($host) > 253) {
        return false;
    }

    if (preg_match('/[\x00-\x20\x7f]/', $host)) {
        return false;
    }

    if (filter_var($host, FILTER_VALIDATE_IP) !== false) {
        return true;
    }

    if (str_contains($host, ':') || str_contains($host, '..')) {
        return false;
    }

    $labels = explode('.', $host);
    if (count($labels) < 2) {
        return false;
    }

    foreach ($labels as $label) {
        $length = utf8_length($label);
        if ($label === '' || $length > 63) {
            return false;
        }

        if (str_starts_with($label, '-') || str_ends_with($label, '-')) {
            return false;
        }

        if (!preg_match('/^[a-z0-9\pL\pM-]+$/iu', $label)) {
            return false;
        }
    }

    $tld = end($labels);
    return is_string($tld) && !preg_match('/^\d+$/', $tld) && utf8_length($tld) >= 2;
}

function json_response(array $payload, int $status_code = 200): never
{
    http_response_code($status_code);
    header('Content-Type: application/json; charset=utf-8');

    $json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
    if ($json === false) {
        http_response_code(500);
        echo '{"error":"Failed to encode JSON response."}';
        exit;
    }

    echo $json;
    exit;
}

function shell_display_arg(string $argument): string
{
    if (preg_match('/^[A-Za-z0-9_+.,:\/=@%-]+$/', $argument)) {
        return $argument;
    }

    return "'" . str_replace("'", "'\\''", $argument) . "'";
}

function command_to_display(array $command): string
{
    return implode(' ', array_map(
        static fn(mixed $argument): string => shell_display_arg((string) $argument),
        $command
    ));
}

function find_binary(string $binary): string
{
    $locations = [
        '/usr/local/sbin/' . $binary,
        '/usr/local/bin/' . $binary,
        '/usr/sbin/' . $binary,
        '/usr/bin/' . $binary,
        '/sbin/' . $binary,
        '/bin/' . $binary,
    ];
    foreach ($locations as $path) {
        if (is_executable($path)) {
            return $path;
        }
    }
    return $binary;
}

/**
 * Execute a system utility using argv-array proc_open().
 *
 * Passing an array command to proc_open() avoids shell interpolation and keeps
 * user input as a single process argument. All output is still escaped before
 * it is sent to the browser.
 *
 * @param array<int, string> $command
 * @return array{stdout:string, stderr:string, exit_code:int|null, timed_out:bool, started:bool}
 */
function run_process(array $command, int $timeout = 30, ?callable $stdout_callback = null, ?callable $stderr_callback = null): array
{
    $descriptor_spec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $pipes = [];
    $process = @proc_open($command, $descriptor_spec, $pipes);

    if (!is_resource($process)) {
        return [
            'stdout' => '',
            'stderr' => 'Failed to start process: ' . command_to_display($command),
            'exit_code' => null,
            'timed_out' => false,
            'started' => false,
        ];
    }

    fclose($pipes[0]);
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);

    $stdout = '';
    $stderr = '';
    $timed_out = false;
    $started_at = microtime(true);

    while (true) {
        $read = [];

        if (is_resource($pipes[1]) && !feof($pipes[1])) {
            $read[] = $pipes[1];
        }

        if (is_resource($pipes[2]) && !feof($pipes[2])) {
            $read[] = $pipes[2];
        }

        if ($read !== []) {
            $write = null;
            $except = null;
            $selected = @stream_select($read, $write, $except, 1);

            if ($selected !== false && $selected > 0) {
                foreach ($read as $pipe) {
                    $chunk = fread($pipe, 16384);

                    if ($chunk === false || $chunk === '') {
                        continue;
                    }

                    if ($pipe === $pipes[1]) {
                        $stdout .= $chunk;
                        if ($stdout_callback !== null) {
                            $stdout_callback($chunk);
                        }
                    } else {
                        $stderr .= $chunk;
                        if ($stderr_callback !== null) {
                            $stderr_callback($chunk);
                        }
                    }
                }
            }
        } else {
            usleep(100000);
        }

        $status = proc_get_status($process);
        if (!$status['running']) {
            break;
        }

        if ((microtime(true) - $started_at) > $timeout) {
            $timed_out = true;
            proc_terminate($process, 15);
            usleep(200000);

            $status = proc_get_status($process);
            if ($status['running']) {
                proc_terminate($process, 9);
            }

            break;
        }
    }

    foreach ([1, 2] as $index) {
        if (isset($pipes[$index]) && is_resource($pipes[$index])) {
            $remaining = stream_get_contents($pipes[$index]);
            if ($remaining !== false && $remaining !== '') {
                if ($index === 1) {
                    $stdout .= $remaining;
                    if ($stdout_callback !== null) {
                        $stdout_callback($remaining);
                    }
                } else {
                    $stderr .= $remaining;
                    if ($stderr_callback !== null) {
                        $stderr_callback($remaining);
                    }
                }
            }

            fclose($pipes[$index]);
        }
    }

    $exit_code = proc_close($process);

    return [
        'stdout' => $stdout,
        'stderr' => $stderr,
        'exit_code' => is_int($exit_code) ? $exit_code : null,
        'timed_out' => $timed_out,
        'started' => true,
    ];
}

function emit_security_headers(): void
{
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 0');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header("Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()");
    header("Content-Security-Policy: default-src 'self'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'; object-src 'none'; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net data:; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; connect-src 'self' https://api.ipify.org https://api6.ipify.org https://cdn.jsdelivr.net");

    if (is_https_request()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    error_die(
        'Error: PHP Version Mismatch.',
        'This script requires PHP 8.1.0 or newer. You are using ' . PHP_VERSION . '.'
    );
}

$required_extensions = ['filter', 'json'];
$missing_extensions = array_filter($required_extensions, static fn(string $ext): bool => !extension_loaded($ext));

if (!empty($missing_extensions)) {
    error_die(
        'Error: Required PHP Extensions Missing.',
        'The following extensions must be enabled: ' . implode(', ', $missing_extensions) . '.'
    );
}

$required_functions = [
    'proc_open',
    'proc_get_status',
    'proc_close',
    'proc_terminate',
    'stream_get_contents',
    'stream_select',
    'fread',
    'fclose',
];

$disabled_functions = array_filter(array_map('trim', explode(',', (string) ini_get('disable_functions'))));
$missing_functions = array_filter(
    $required_functions,
    static fn(string $func): bool => !function_exists($func) || in_array($func, $disabled_functions, true)
);

if (!empty($missing_functions)) {
    error_die(
        'Error: Required PHP Functions Disabled.',
        'The following functions are required and currently disabled or missing: ' . implode(', ', $missing_functions) . '.'
    );
}

// PHP optimization hint for high-resource single-file deployment.
@ini_set('realpath_cache_size', '8192k');          // 8 MB path cache.
@ini_set('realpath_cache_ttl', '1200');            // 20 minutes.
@ini_set('opcache.enable', '1');
@ini_set('opcache.memory_consumption', '128');     // 128 MB for compiled code (sufficient for single-file app).
@ini_set('opcache.max_accelerated_files', '30000');
@ini_set('opcache.interned_strings_buffer', '32');
@ini_set('opcache.validate_timestamps', '0');      // Production mode; reload PHP-FPM after deployment.
@ini_set('opcache.revalidate_freq', '60');

// Set session ini directives as a fallback for PHP environments that ignore
// session_set_cookie_params() cookie options array (pre-7.3 compatible).
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', 'Strict');

session_name('LG_SID');

$session_cookie_params = [
    'lifetime' => 3600,
    'path' => '/',
    'secure' => is_https_request(),
    'httponly' => true,
    'samesite' => 'Strict',
];

$cookie_domain = safe_cookie_domain();
if ($cookie_domain !== '') {
    $session_cookie_params['domain'] = $cookie_domain;
}

session_set_cookie_params($session_cookie_params);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf']) || !is_string($_SESSION['csrf'])) {
    try {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    } catch (Throwable $e) {
        http_response_code(500);
        error_log('Failed to generate CSRF token: ' . $e->getMessage());
        die('Internal server error: Failed to create security token.');
    }
}

$csrf_token = $_SESSION['csrf'];

emit_security_headers();

// Hardcoded Looking Glass Tools Configuration
$ipv4 = 'lg.yourdomain.com';
$ipv6 = 'lg.yourdomain.com';
$siteName = 'LOOKING GLASS NETWORK TOOLS';
$siteUrl = 'https://lg.yourdomain.com';
$siteUrlv4 = 'https://lg.yourdomain.com';
$siteUrlv6 = 'https://lg.yourdomain.com';
$serverLocation = 'JAKARTA - INDONESIA';

// Tool disable flags. Keep false/empty to enable the existing UI tabs.
$ping = false;
$traceroute = false;
$mtr = false;
$host_cmd = false;

// Iperf Port
$iperfport = '5201';

// Test files
$testFiles = ['250MB', '500MB', '1GB'];

// --- Download Test Handler (PHP stream generator, no physical files needed) ---
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET' && isset($_GET['download'])) {
    $sizeMap = ['250MB' => 250, '500MB' => 500, '1GB' => 1024];
    $requested = $_GET['download'];
    $sizeMB = $sizeMap[$requested] ?? 0;
    if ($sizeMB === 0) {
        http_response_code(404);
        die('File not found');
    }

    session_write_close();
    ignore_user_abort(false);

    while (ob_get_level() > 0) {
        @ob_end_clean();
    }

    ob_implicit_flush(true);

    @apache_setenv('no-gzip', '1');
    @ini_set('zlib.output_compression', '0');

    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . ($sizeMB * 1024 * 1024));
    header('Content-Disposition: attachment; filename="' . $requested . '.bin"');
    header('Content-Encoding: none');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    header('X-Accel-Buffering: no');

    $chunkSize = 262144;
    $total = $sizeMB * 1024 * 1024;
    $buf = str_repeat("a", $chunkSize);
    $sent = 0;
    while ($sent < $total) {
        if (connection_aborted()) {
            break;
        }
        $chunk = min($chunkSize, $total - $sent);
        echo $chunk === $chunkSize ? $buf : substr($buf, 0, $chunk);
        $sent += $chunk;
        if ($sent % (10 * 1024 * 1024) === 0 || connection_aborted()) {
            flush();
            if (connection_aborted()) {
                break;
            }
        }
    }
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    header('Content-Type: text/plain; charset=utf-8');
    header('X-Accel-Buffering: no');
    header('Content-Encoding: none');

    $host = normalize_host_input((string) ($_POST['host'] ?? ''));
    $cmd = trim((string) ($_POST['cmd'] ?? ''));
    $csrf = (string) ($_POST['csrf'] ?? '');

    if ($csrf === '' || !hash_equals($_SESSION['csrf'], $csrf)) {
        http_response_code(403);
        echo "Session Invalid. Please reload the page & Try again.\nSesi Tidak Valid. Silahkan muat ulang halaman dan mencoba kembali.";
        exit;
    }

    if ($host === '' || !validate_host($host)) {
        http_response_code(400);
        echo "Error: Invalid host or IP address.\nValid examples: 8.8.8.8, 2001:4860:4860::8888, or google.com";
        exit;
    }

    // --- WHOIS Handler ---
    if ($cmd === 'whois') {
        $result = run_process([find_binary('whois'), $host], 30);
        if (!$result['started']) {
            json_response(['error' => 'WHOIS lookup failed: ' . $result['stderr']], 500);
        }

        $raw = trim($result['stdout'] . ($result['stderr'] !== '' ? "\n" . $result['stderr'] : ''));

        if ($raw === '') {
            json_response(['error' => 'WHOIS lookup failed or returned empty result.'], 500);
        }

        $parsed = [];
        $labels = [
            'domain name' => ['label' => 'Nama Domain', 'icon' => 'fa-globe', 'info' => 'Nama domain yang terdaftar'],
            'registrar' => ['label' => 'Registrar', 'icon' => 'fa-building', 'info' => 'Perusahaan tempat domain didaftarkan'],
            'registrar url' => ['label' => 'URL Registrar', 'icon' => 'fa-link', 'info' => 'Website resmi registrar'],
            'registrar whois server' => ['label' => 'Server WHOIS Registrar', 'icon' => 'fa-server', 'info' => 'Server WHOIS dari registrar'],
            'creation date' => ['label' => 'Tanggal Dibuat', 'icon' => 'fa-calendar-plus', 'info' => 'Kapan domain pertama kali didaftarkan'],
            'updated date' => ['label' => 'Tanggal Diperbarui', 'icon' => 'fa-calendar-check', 'info' => 'Kapan terakhir data domain diubah'],
            'registry expiry date' => ['label' => 'Tanggal Kedaluwarsa', 'icon' => 'fa-calendar-xmark', 'info' => 'Kapan domain akan berakhir masa berlakunya'],
            'expiration date' => ['label' => 'Tanggal Kedaluwarsa', 'icon' => 'fa-calendar-xmark', 'info' => 'Kapan domain akan berakhir masa berlakunya'],
            'name server' => ['label' => 'Name Server (DNS)', 'icon' => 'fa-network-wired', 'info' => 'Server DNS yang mengelola domain ini'],
            'domain status' => ['label' => 'Status Domain', 'icon' => 'fa-shield-halved', 'info' => 'Status keamanan dan penguncian domain'],
            'dnssec' => ['label' => 'DNSSEC', 'icon' => 'fa-lock', 'info' => 'Keamanan DNS (Domain Name System Security Extensions)'],
            'registrant name' => ['label' => 'Nama Pemilik', 'icon' => 'fa-user', 'info' => 'Nama pemilik domain'],
            'registrant organization' => ['label' => 'Organisasi Pemilik', 'icon' => 'fa-building-columns', 'info' => 'Organisasi pemilik domain'],
            'registrant country' => ['label' => 'Negara Pemilik', 'icon' => 'fa-flag', 'info' => 'Negara tempat pemilik domain terdaftar'],
            'registrant state/province' => ['label' => 'Provinsi Pemilik', 'icon' => 'fa-map', 'info' => 'Provinsi/wilayah pemilik domain'],
            'registrant email' => ['label' => 'Email Pemilik', 'icon' => 'fa-envelope', 'info' => 'Alamat email kontak pemilik domain'],
            'admin email' => ['label' => 'Email Admin', 'icon' => 'fa-envelope-open-text', 'info' => 'Email untuk urusan administrasi domain'],
            'tech email' => ['label' => 'Email Teknis', 'icon' => 'fa-at', 'info' => 'Email untuk urusan teknis domain'],
            'abuse contact email' => ['label' => 'Email Pelaporan Abuse', 'icon' => 'fa-triangle-exclamation', 'info' => 'Email untuk melaporkan penyalahgunaan'],
            'abuse contact phone' => ['label' => 'Telepon Pelaporan Abuse', 'icon' => 'fa-phone', 'info' => 'Telepon untuk melaporkan penyalahgunaan'],
            'netname' => ['label' => 'Nama Jaringan', 'icon' => 'fa-network-wired', 'info' => 'Nama blok jaringan IP ini'],
            'netrange' => ['label' => 'Rentang IP', 'icon' => 'fa-arrows-left-right', 'info' => 'Rentang alamat IP dalam blok ini'],
            'cidr' => ['label' => 'CIDR', 'icon' => 'fa-diagram-project', 'info' => 'Notasi CIDR dari blok IP'],
            'inetnum' => ['label' => 'Rentang IP', 'icon' => 'fa-arrows-left-right', 'info' => 'Rentang alamat IP'],
            'inet6num' => ['label' => 'Rentang IPv6', 'icon' => 'fa-arrows-left-right', 'info' => 'Rentang alamat IPv6'],
            'orgname' => ['label' => 'Nama Organisasi', 'icon' => 'fa-building', 'info' => 'Organisasi pengelola IP ini'],
            'organization' => ['label' => 'Organisasi', 'icon' => 'fa-building-columns', 'info' => 'Organisasi pemilik'],
            'org-name' => ['label' => 'Nama Organisasi', 'icon' => 'fa-building', 'info' => 'Organisasi pengelola IP ini'],
            'descr' => ['label' => 'Deskripsi', 'icon' => 'fa-align-left', 'info' => 'Deskripsi jaringan'],
            'country' => ['label' => 'Negara', 'icon' => 'fa-flag', 'info' => 'Negara registrasi'],
            'origin' => ['label' => 'ASN (Origin)', 'icon' => 'fa-sitemap', 'info' => 'Autonomous System Number asal'],
            'originas' => ['label' => 'ASN (Origin)', 'icon' => 'fa-sitemap', 'info' => 'Autonomous System Number asal'],
            'route' => ['label' => 'Route', 'icon' => 'fa-route', 'info' => 'Prefix routing BGP'],
            'mnt-by' => ['label' => 'Dikelola Oleh', 'icon' => 'fa-wrench', 'info' => 'Maintainer jaringan ini'],
            'source' => ['label' => 'Sumber Data', 'icon' => 'fa-database', 'info' => 'Database WHOIS sumber informasi'],
            'status' => ['label' => 'Status', 'icon' => 'fa-circle-info', 'info' => 'Status alokasi IP'],
        ];

        $seen_keys = [];
        foreach (explode("\n", $raw) as $line) {
            $line = trim($line);

            if ($line === '' || $line[0] === '%' || $line[0] === '#') {
                continue;
            }

            if (!str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);
            $key = strtolower(trim($key));
            $value = trim($value);

            if ($value === '' || !isset($labels[$key])) {
                continue;
            }

            $map_key = $key;
            if (in_array($key, ['name server', 'domain status', 'descr'], true)) {
                $seen_keys[$map_key] = ($seen_keys[$map_key] ?? 0) + 1;
                $parsed[] = [
                    'key' => $labels[$map_key]['label'] . ($seen_keys[$map_key] > 1 ? ' (' . $seen_keys[$map_key] . ')' : ''),
                    'value' => $value,
                    'icon' => $labels[$map_key]['icon'],
                    'info' => $labels[$map_key]['info'],
                ];
                continue;
            }

            if (isset($seen_keys[$map_key])) {
                continue;
            }

            $seen_keys[$map_key] = 1;
            $parsed[] = [
                'key' => $labels[$map_key]['label'],
                'value' => $value,
                'icon' => $labels[$map_key]['icon'],
                'info' => $labels[$map_key]['info'],
            ];
        }

        json_response([
            'parsed' => $parsed,
            'raw' => $raw,
            'host' => $host,
            'timed_out' => $result['timed_out'],
        ]);
    }

    // --- DNS Lookup Handler ---
    if ($cmd === 'dnslookup') {
        $record_types = ['A', 'AAAA', 'NS', 'MX', 'SOA', 'TXT'];
        $results = [];
        $errors = [];

        foreach ($record_types as $type) {
            $result = run_process([find_binary('dig'), '+time=3', '+tries=1', '+noall', '+answer', '+nocmd', $host, $type], 12);
            if (!$result['started']) {
                json_response(['error' => 'DNS Lookup failed: ' . $result['stderr']], 500);
            }
            $output = trim($result['stdout']);
            $records = [];

            if ($output !== '') {
                foreach (explode("\n", $output) as $line) {
                    $line = trim($line);

                    if ($line === '' || $line[0] === ';') {
                        continue;
                    }

                    $parts = preg_split('/\s+/', $line, 5);
                    if ($parts !== false && count($parts) >= 5) {
                        $records[] = [
                            'name' => $parts[0],
                            'ttl' => $parts[1],
                            'class' => $parts[2],
                            'type' => $parts[3],
                            'value' => $parts[4],
                        ];
                    } elseif ($parts !== false && count($parts) >= 4) {
                        $records[] = [
                            'name' => $parts[0],
                            'ttl' => $parts[1],
                            'class' => $parts[2],
                            'type' => $parts[3],
                            'value' => '',
                        ];
                    }
                }
            }

            if ($result['stderr'] !== '' || $result['timed_out']) {
                $errors[$type] = trim($result['stderr'] . ($result['timed_out'] ? "\nDNS query timed out." : ''));
            }

            $results[$type] = $records;
        }

        json_response([
            'records' => $results,
            'errors' => $errors,
            'host' => $host,
        ]);
    }

    $command_map = [
        'host' => empty($host_cmd) ? [find_binary('host'), '-W', '1', $host] : null,
        'mtr' => empty($mtr) ? [find_binary('mtr'), '-4', '-c', '10', '-w', '-b', $host] : null,
        'mtr6' => empty($mtr) ? [find_binary('mtr'), '-6', '-c', '10', '-w', '-b', $host] : null,
        'ping' => empty($ping) ? [find_binary('ping'), '-4', '-c', '20', '-w', '25', $host] : null,
        'ping6' => empty($ping) ? [find_binary('ping'), '-6', '-c', '20', '-w', '25', $host] : null,
        'traceroute' => empty($traceroute) ? [find_binary('traceroute'), '-4', '-w', '1', '-q', '1', '-m', '30', $host] : null,
        'traceroute6' => empty($traceroute) ? [find_binary('traceroute'), '-6', '-w', '1', '-q', '1', '-m', '30', $host] : null,
    ];

    if (!array_key_exists($cmd, $command_map) || $command_map[$cmd] === null) {
        http_response_code(400);
        echo 'Error: Command not recognized or disabled.';
        exit;
    }

    $command = $command_map[$cmd];

    echo "=======================================================================\n";
    echo '|| Menjalankan: ' . command_to_display($command) . "\n";
    echo '|| Dari Server: ' . $serverLocation;
    echo "\n=======================================================================\n\n";

    while (ob_get_level() > 0) {
        @ob_end_clean();
    }

    flush();

    $result = run_process(
        $command,
        30,
        // NOTE: Output is sent as Content-Type: text/plain and consumed by
        // JavaScript via createTextNode(), which is inherently XSS-safe.
        // Do NOT add sanitize_output() here — it would double-encode entities
        // (e.g. '<' becomes '&amp;lt;') and corrupt terminal output display.
        static function (string $chunk): void {
            echo $chunk;
            flush();
        }
    );

    if (!$result['started']) {
        http_response_code(500);
        echo 'Error: Gagal mengeksekusi perintah pada server.';
        if ($result['stderr'] !== '') {
            echo "\n" . $result['stderr'];
        }
        exit;
    }

    if ($result['stderr'] !== '') {
        echo "\n--- [STDERR] ---\n" . $result['stderr'];
    }

    if ($result['timed_out']) {
        echo "\n\n=======================================================================\n";
        echo "|| Error: Proses melampaui batas waktu (30 detik) dan telah dihentikan.\n";
        echo "=======================================================================\n";
    }

    exit;
}

$theme = 'dark';
if (isset($_COOKIE['theme']) && in_array($_COOKIE['theme'], ['light', 'dark'], true)) {
    $theme = $_COOKIE['theme'];
}
?><!DOCTYPE html>
<html lang="id" data-theme="<?php echo $theme; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	// --- Basic vars (assume already defined earlier)
	$appVersion = APP_VERSION;
	$dateModified = date('Y-m-d'); // automatic (ISO 8601: YYYY-MM-DD)
	$siteNameSafe = sanitize_output($siteName);
	$siteUrlBase = rtrim((string) $siteUrl, '/');
	$siteUrlSafe = sanitize_output($siteUrlBase);
	$scriptPath = (string) ($_SERVER['SCRIPT_NAME'] ?? '/');
	$scriptPathSafe = sanitize_output($scriptPath);

	// Meta description (keep ~150 chars)
	$metaDescription = sprintf(
		'Enterprise Looking Glass network diagnostics — Ping, Traceroute, Host, MTR. Hosted in %s. IPv4/IPv6 support. Akurat dan real-time!',
		sanitize_output($serverLocation ?: 'multiple locations')
	);

	// Keywords array (manageable)
	$keywords = [
		'looking glass', 'network diagnostics', 'ping', 'traceroute', 'mtr', 'host',
		'ipv6', 'ipv4', 'network tools', 'alsyundawy',
	];
	$metaKeywords = implode(', ', $keywords);

	// Canonical URL
	$canonical = $siteUrlBase . $scriptPath;

	// Terms & Privacy (assumed path; adjust if different)
	$termsUrl = $siteUrlBase . '/terms';
	$privacyUrl = $siteUrlBase . '/privacy';

	// Hreflang alternatives (add more if you host more locales)
	$hreflangs = [
		['href' => $siteUrlBase . $scriptPath, 'lang' => 'en'],
		['href' => $siteUrlBase . '/id' . $scriptPath, 'lang' => 'id']
	];
	?>
	<title><?= $siteNameSafe ?> — Looking Glass | Advanced Network Diagnostics</title>

	<meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>">
	<meta name="keywords" content="<?= htmlspecialchars($metaKeywords, ENT_QUOTES, 'UTF-8') ?>">
	<meta name="author" content="ALSYUNDAWY IT SOLUTION - AS696969">
	<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
	<meta name="referrer" content="no-referrer-when-downgrade">

	<!-- Open Graph -->
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?= $siteNameSafe ?> — Looking Glass | Network Diagnostics" />
	<meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>" />
	<meta property="og:url" content="<?= sanitize_output($canonical) ?>" />
	<meta property="og:site_name" content="<?= $siteNameSafe ?> Network Tools" />
	<meta property="og:image" content="<?= $siteUrlSafe ?>/social-share-image.png" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />

	<!-- Twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= $siteNameSafe ?> — Looking Glass">
	<meta name="twitter:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>">
	<meta name="twitter:image" content="<?= $siteUrlSafe ?>/social-share-image.png">

	<!-- Favicons -->
	<link rel="icon" type="image/svg+xml" href="/favicon.svg">
	<link rel="icon" type="image/x-icon" href="/favicon.ico">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="192x192" href="android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="512x512" href="android-chrome-512x512.png">
	<link rel="manifest" href="/site.webmanifest">

	<link rel="canonical" href="<?= sanitize_output($canonical) ?>" />

	<!-- Hreflang alternates -->
	<?php foreach ($hreflangs as $hf): ?>
	<link rel="alternate" href="<?= sanitize_output($hf['href']) ?>" hreflang="<?= sanitize_output($hf['lang']) ?>">
	<?php endforeach; ?>

	<!-- Prefetch / Preconnect -->
	<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
	<link rel="dns-prefetch" href="https://fonts.googleapis.com">
	<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
	<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<!-- Styles (CDN) - keep integrity attributes if you add them -->
	<link href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700;900&family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<?php
		/* ---------------------------
		   JSON-LD via json_encode()
		   Updated for ALSYUNDAWY IT SOLUTION (2026-02-13)
		   --------------------------- */

		$appSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'SoftwareApplication',
			'name' => 'Alsyundawy Looking Glass',
			'alternateName' => ['Looking Glass ' . $siteName, 'LG Alsyundawy'],
			'applicationCategory' => 'NetworkApplication',
			'operatingSystem' => ['Web Browser', 'Platform Independent'],
			'url' => $canonical,
			'description' => $metaDescription,
			'softwareVersion' => $appVersion,
			'datePublished' => '2026-02-13',
			'dateModified' => $dateModified,
			'inLanguage' => ['en', 'id'],
			'offers' => [
				'@type' => 'Offer',
				'price' => 0,
				'priceCurrency' => 'USD',
				'availability' => 'https://schema.org/InStock',
				'description' => 'Free to use and modify'
			],
			'author' => [
				'@type' => 'Organization',
				'name' => 'ALSYUNDAWY IT SOLUTION',
				'url' => 'https://alsyundawy.com',
				'telephone' => '+62-812-6969-6969',
				'email' => 'noc@alsyundawy.com',
				'sameAs' => [
					'https://alsyundawy.com',
					'https://www.peeringdb.com/asn/696969'
				],
				'contactPoint' => [
					[
						'@type' => 'ContactPoint',
						'email' => 'noc@alsyundawy.com',
						'telephone' => '+62-812-6969-6969',
						'contactType' => 'Network Operations',
						'availableLanguage' => ['English', 'Indonesian']
					],
					[
						'@type' => 'ContactPoint',
						'email' => 'abuse@alsyundawy.com',
						'telephone' => '+62-812-6969-6969',
						'contactType' => 'Abuse',
						'availableLanguage' => ['English', 'Indonesian']
					]
				]
			],
			'creator' => [
				'@type' => 'Organization',
				'name' => 'ALSYUNDAWY IT SOLUTION',
				'url' => 'https://alsyundawy.com',
				'contactPoint' => [
					'@type' => 'ContactPoint',
					'email' => 'noc@alsyundawy.com',
					'contactType' => 'Technical Support',
					'availableLanguage' => ['English', 'Indonesian']
				]
			],
			'termsOfService' => $termsUrl,
			'privacyPolicy' => $privacyUrl,
			'license' => 'https://opensource.org/licenses/MIT',
			'featureList' => [
				'Ping', 'Traceroute', 'MTR', 'Host', 'WHOIS', 'DNS Lookup'
			],
			'keywords' => $keywords,
			'screenshot' => $siteUrlSafe . '/screenshot.png'
		];

		$websiteSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'WebSite',
			'name' => 'Alsyundawy Looking Glass',
			'url' => $siteUrlSafe,
			'description' => $metaDescription,
			'inLanguage' => ['en', 'id'],
			'publisher' => [
				'@type' => 'Organization',
				'name' => 'ALSYUNDAWY IT SOLUTION',
				'url' => 'https://alsyundawy.com',
				'logo' => [
					'@type' => 'ImageObject',
					'url' => 'https://alsyundawy.com/logo.png',
					'width' => 200,
					'height' => 200
				],
				'contactPoint' => [
					'@type' => 'ContactPoint',
					'telephone' => '+62-812-6969-6969',
					'email' => 'noc@alsyundawy.com',
					'contactType' => 'Customer Support'
				]
			],
			'potentialAction' => [
				'@type' => 'SearchAction',
				'target' => $siteUrlSafe . '/?q={search_term_string}',
				'query-input' => 'required name=search_term_string'
			],
			'termsOfService' => $termsUrl,
			'privacyPolicy' => $privacyUrl
		];

		$breadcrumbSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'BreadcrumbList',
			'itemListElement' => [
				['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteUrlSafe],
				['@type' => 'ListItem', 'position' => 2, 'name' => 'Network Tools', 'item' => $siteUrlSafe . '#tools']
			]
		];

		$orgSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'Organization',
			'name' => 'ALSYUNDAWY IT SOLUTION',
			'url' => 'https://alsyundawy.com',
			'logo' => 'https://alsyundawy.com/logo.png',
			'sameAs' => [
				'https://alsyundawy.com',
				'https://www.peeringdb.com/asn/696969',
				'https://bgp.tools/as/696969'
			],
			'identifier' => [
				'@type' => 'PropertyValue',
				'propertyID' => 'AS',
				'value' => 'AS696969'
			],
			'contactPoint' => [
				[
					'@type' => 'ContactPoint',
					'telephone' => '+62-812-6969-6969',
					'email' => 'noc@alsyundawy.com',
					'contactType' => 'NOC',
					'availableLanguage' => ['English', 'Indonesian']
				],
				[
					'@type' => 'ContactPoint',
					'telephone' => '+62-812-6969-6969',
					'email' => 'abuse@alsyundawy.com',
					'contactType' => 'Abuse',
					'availableLanguage' => ['English', 'Indonesian']
				]
			],
			'address' => [
				'@type' => 'PostalAddress',
				'streetAddress' => 'Jalan Kuningan Barat No. 8, Gedung Cyber Lantai 1, Kuningan Barat, Mampang Prapatan',
				'addressLocality' => 'Jakarta Selatan',
				'postalCode' => '12710',
				'addressCountry' => 'ID'
			]
		];

		$faqSchema = [
			'@context' => 'https://schema.org',
			'@type' => 'FAQPage',
			'mainEntity' => [
				['@type' => 'Question', 'name' => 'What is Looking Glass network tool?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'A professional toolkit for network diagnostics including ping, traceroute, MTR, DNS lookup, WHOIS, and host resolution.']],
				['@type' => 'Question', 'name' => 'Does it support IPv6?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, IPv4 and IPv6 are fully supported.']]
			]
		];
	?>

	<!-- JSON-LD structured data -->
	<script type="application/ld+json">
	<?= json_encode($appSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
	</script>

	<script type="application/ld+json">
	<?= json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
	</script>

	<script type="application/ld+json">
	<?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
	</script>

	<script type="application/ld+json">
	<?= json_encode($orgSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
	</script>

	<script type="application/ld+json">
	<?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP) ?>
	</script>

	<style>
	:root{--font-main:"Inter",-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;--font-mono:"Fira Code","SF Mono","Monaco",monospace;--color-primary:#049;--color-primary-dark:#037;--color-success:#28a745;--color-danger:#e74c3c;--color-white:#fff;--bg-light:#fafbfc;--bg-dark:#0d1117;--text-primary:#1a1a1a;--text-secondary:#6c757d;--card-bg:#fff;--border-radius:8px;--shadow-card:0 4px 12px rgba(0, 0, 0, .15);--transition:all .15s ease;--border-color:#d1d5db;--footer-bg:#0f172a;--footer-text:#f8fafc;--footer-link:#60a5fa;--footer-hover:#93c5fd;--header-bg:#0f172a;--header-text:#f8fafc;--header-link:#60a5fa}html[data-theme=dark]{--bg-light:#0d1117;--bg-dark:#010409;--text-primary:#f0f6fc;--text-secondary:#8b949e;--card-bg:#161b22;--shadow-card:0 8px 24px rgba(0, 0, 0, .5);--border-color:#30363d;--footer-bg:#020617;--header-bg:#020617}*{box-sizing:border-box;margin:0;padding:0}html{scroll-behavior:smooth}body{background-color:var(--bg-light);color:var(--text-primary);font-family:var(--font-main);font-size:12px;font-weight:400;line-height:1.5}.wrapper{display:flex;flex-direction:column;min-height:100vh}.header{background:var(--header-bg);color:var(--header-text);padding:.6rem 0;position:relative;z-index:1001}html[data-theme=dark] .header{border-bottom:1px solid var(--border-color)}.header .container{max-width:1400px}.header img{height:36px;width:auto}.header__title{color:var(--header-text);font-size:.95rem;font-weight:700;text-shadow:2px 2px 4px rgba(0,0,0,.6);white-space:nowrap}.header__title .highlight2{color:var(--header-link)}.contact-info{align-items:center;color:#fff;display:flex;font-size:.75rem;font-weight:700;gap:.8rem;text-shadow:1px 1px 2px rgba(0,0,0,.4)}.contact-info span{white-space:nowrap}.contact-info i{color:#fff;margin-right:.2rem}.contact-info a{color:#fff;font-weight:700;text-decoration:none;text-shadow:1px 1px 2px rgba(0,0,0,.4)}.contact-info-mobile{display:none}.contact-info-mobile i{color:#fff}.main-content{flex:1;padding:15px}.site-header{background:linear-gradient(135deg,rgba(0,0,0,.7),rgba(0,68,153,.7)),url(hero-lg.webp) 50%/cover no-repeat;border-radius:0 0 var(--border-radius) var(--border-radius);box-shadow:var(--shadow-card);color:var(--color-white);padding:20px 15px;position:relative;text-align:center}.site-header h1{color:var(--color-white);font-size:1.5rem;font-weight:700;margin:0;text-shadow:2px 2px 8px rgba(0,0,0,.8)}.site-header p{color:var(--color-white);font-size:.85rem;font-weight:600;margin:8px 0 0;text-shadow:1px 1px 6px rgba(0,0,0,.8)}.site-header img{filter:drop-shadow(2px 2px 4px rgba(0, 0, 0, .5))}@media(max-width:768px){.site-header{background:linear-gradient(135deg,rgba(0,0,0,.7),rgba(0,68,153,.7)),url(hero-lg.webp) 50%/cover no-repeat;padding:15px 10px}.site-header h1{font-size:1.2rem}.site-header p{font-size:.75rem}}html[data-theme=dark] .site-header{background:linear-gradient(135deg,rgba(0,0,0,.7),rgba(0,68,153,.7)),url(hero-lg.webp) 50%/cover no-repeat}.theme-switcher-top{align-items:center;background:hsla(0,0%,100%,.12);border:1px solid hsla(0,0%,100%,.3);border-radius:50%;bottom:10px;color:var(--color-white);cursor:pointer;display:flex;font-size:1.3rem;height:42px;justify-content:center;position:absolute;right:10px;transition:var(--transition);width:42px;z-index:1002}.theme-switcher-top:hover{background:hsla(0,0%,100%,.2);transform:translateY(-1px)}html[data-theme=dark] .theme-switcher-top{background:rgba(0,0,0,.4);border-color:hsla(0,0%,100%,.25)}.main-nav{backdrop-filter:blur(10px);background:hsla(0,0%,100%,.98);border-bottom:1px solid rgba(0,0,0,.12);box-shadow:0 2px 4px rgba(0,0,0,.1);padding:.4rem 0;position:sticky;top:0;z-index:1000}html[data-theme=dark] .main-nav{background:rgba(22,27,34,.98);border-bottom-color:hsla(0,0%,100%,.125)}.nav-menu{display:flex;flex-wrap:wrap;gap:.4rem;justify-content:center;list-style:none;margin:0;padding:0}.nav-item{align-items:center;display:flex}.nav-item a{align-items:center;border-radius:5px;color:var(--text-primary);display:inline-flex;font-size:.75rem;font-weight:600;gap:.3rem;padding:.3rem .6rem;text-decoration:none;transition:var(--transition)}.nav-item a:hover{background:rgba(0,68,153,.1)}.nav-item a i,.nav-item a:hover{color:var(--color-primary)}html[data-theme=dark] .nav-item a i{color:#fff}.nav-item-theme{margin-left:auto;margin-right:0}.nav-item-theme button{align-items:center;background:0 0;border:none;border-radius:50%;color:var(--text-primary);cursor:pointer;display:inline-flex;font-size:.9rem;height:30px;justify-content:center;transition:var(--transition);width:30px}.nav-item-theme button:hover{background:rgba(0,68,153,.12);color:var(--color-primary)}html[data-theme=dark] .nav-item-theme button{color:#facc15}.info-card{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:var(--shadow-card);margin-bottom:1.2rem}.info-card-body{padding:1.2rem}.info-card-title{align-items:center;display:flex;font-size:.95rem;font-weight:700;gap:.4rem;margin-bottom:.8rem}.info-card-title i{color:var(--color-primary)}.data-table{border-collapse:collapse;width:100%}.data-table td{border:none;padding:5px 6px;vertical-align:top}.data-table td:first-child{color:var(--text-primary);font-size:.75rem;font-weight:600;white-space:nowrap}.data-table td:nth-child(2){color:var(--text-secondary);padding-left:0;padding-right:6px;text-align:left;white-space:nowrap}.data-table td:nth-child(3){color:var(--text-primary);font-size:.75rem;font-weight:700;word-break:break-all}.data-table td i{color:var(--color-primary);margin-right:.2rem}.iperf-cmd-box{background:#e9ecef;border-radius:4px;color:#049;font-family:var(--font-mono);font-size:.7rem;font-weight:700;margin:.4rem 0;padding:6px}html[data-theme=dark] .iperf-cmd-box{background:#21262d;color:#60a5fa}.download-section-title{font-size:.85rem;font-weight:700;margin-bottom:.6rem;margin-top:1.5rem;text-align:center}.network-test-container{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:var(--shadow-card);margin:1.2rem 0}.network-test-title{background:linear-gradient(45deg,var(--color-primary),var(--color-primary-dark));border-bottom:1px solid var(--border-color);border-radius:var(--border-radius) var(--border-radius) 0 0;color:#fff;font-size:.8rem;font-weight:700;margin:0;padding:.4rem 1.2rem;text-align:center;text-transform:uppercase}html[data-theme=dark] .network-test-title{background:linear-gradient(45deg,#f1585c,#e04448)}.test-tabs .nav-tabs{background:0 0;border-bottom:2px solid var(--border-color);display:flex;flex-wrap:wrap;gap:.4rem;justify-content:flex-start;margin-bottom:1rem;padding:.5rem .5rem 0}.test-tabs .nav-tabs .nav-link{background:0 0;border:1px solid var(--border-color);border-radius:4px 4px 0 0;color:var(--color-primary);font-size:.68rem;font-weight:600;padding:.35rem .6rem;transition:var(--transition);white-space:nowrap}html[data-theme=dark] .test-tabs .nav-tabs .nav-link{color:#c8d9e8}.test-tabs .nav-tabs .nav-link:hover{background:rgba(0,68,153,.1);color:var(--color-primary)}.test-tabs .nav-tabs .nav-link.active{background:#049;border:1px solid #037;color:#fff}.test-tabs .nav-tabs .nav-link i{font-size:.7rem;margin-right:.3rem}.test-tabs .tab-content{padding:1.2rem}.test-form{align-items:flex-end;display:flex;flex-wrap:wrap;gap:.8rem}.test-form .form-group{flex:1;min-width:160px}.test-form label{display:block;font-size:.8rem;font-weight:600;margin-bottom:.4rem}.passgen-form .form-group>div:first-child{color:var(--text-primary);font-size:.85rem;font-weight:700;margin-bottom:.7rem}.test-form input,.test-form select{background:var(--bg-light);border:1px solid var(--border-color);border-radius:5px;color:var(--text-primary);font-size:.8rem;padding:.6rem;width:100%}html[data-theme=dark] .test-form input,html[data-theme=dark] .test-form select{background:var(--bg-dark)}.test-form input:focus,.test-form select:focus{border-color:var(--color-primary);box-shadow:0 0 0 2px rgba(0,68,153,.15);outline:0}.form-actions{display:flex;gap:.8rem;margin-top:.8rem}.action-btn{align-items:center;border:none;border-radius:5px;cursor:pointer;display:inline-flex;font-weight:700;gap:.4rem;min-height:40px;padding:.55rem 1.1rem;transition:var(--transition)}.action-btn,.action-btn i{font-size:.75rem}.action-btn-primary{background:linear-gradient(45deg,var(--color-primary),var(--color-primary-dark));box-shadow:0 3px 10px rgba(0,68,153,.3);color:var(--color-white)}.action-btn-primary:hover{transform:translateY(-1px)}.action-btn-reset{background:#f1585c;box-shadow:0 3px 10px rgba(241,88,92,.3);color:var(--color-white)}.action-btn-reset:hover{background:#e04448;transform:translateY(-1px)}.output-section{display:none;margin-top:1.2rem}.output-section.show{display:block}.output-box{background:#0d1117;border-radius:var(--border-radius);color:#e6edf3;font-family:var(--font-mono);font-size:.75rem;max-height:550px;overflow-y:auto;padding:1.2rem;white-space:pre-wrap;word-wrap:break-word}.minify-container{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:var(--shadow-card);padding:1.2rem}html[data-theme=dark] .minify-container{border-color:hsla(0,0%,100%,.125)}.netplan-form{align-items:end;display:grid;gap:.8rem;grid-template-columns:repeat(12,1fr)}@media(min-width:768px){.site-header h1{font-size:2.5rem}}@media(max-width:767px){.test-tabs .nav-tabs{gap:.2rem;justify-content:center}.test-tabs .nav-tabs .nav-link{align-items:center;display:flex;flex:1 1 auto;font-size:.75rem;justify-content:center;min-width:80px;padding:.5rem .2rem;text-align:center}.test-tabs .nav-tabs .nav-link i{margin-right:.2rem}}.tab-section-header{border-bottom:none;margin-bottom:.8rem;padding-bottom:.4rem;text-align:left}.tab-section-header h4{color:var(--color-primary);font-size:1.2rem;font-weight:700;margin-bottom:.3rem}html[data-theme=dark] .tab-section-header h4{color:#60a5fa}.tab-section-header p{color:var(--text-secondary);font-size:.9rem;margin:0}.netplan-form .np-col-2{grid-column:span 2}.netplan-form .np-col-3{grid-column:span 3}.netplan-form .np-col-4{grid-column:span 4}.netplan-form .np-col-6{grid-column:span 6}.netplan-form .np-col-8{grid-column:span 8}.netplan-form .np-col-12{grid-column:span 12}.np-check{background:var(--bg-light);border:1px solid var(--border-color);border-radius:5px;gap:.45rem;min-height:40px;padding:.55rem .65rem}.np-check,.np-check label{align-items:center;display:flex}.np-check label{font-size:.75rem;font-weight:700;gap:.35rem;margin:0;white-space:nowrap}.np-check i{color:var(--color-primary)}html[data-theme=dark] .np-check{background:var(--bg-dark)}.np-check input{accent-color:var(--color-primary);height:1.1rem;width:1.1rem}.np-help{align-self:center;color:var(--text-secondary);font-size:.7rem;font-weight:700;padding:.35rem 0}.np-ipv6-section{background:rgba(0,68,153,.05);border-left:4px solid var(--color-primary);border-radius:4px;display:none;gap:.8rem;grid-template-columns:repeat(12,1fr);margin-top:.2rem;padding:.8rem}.np-yaml-card{border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:0 2px 6px rgba(0,0,0,.1);margin-top:.8rem;overflow:hidden}.np-yaml-head{background:var(--bg-dark);color:#fff;font-size:.75rem;font-weight:700;padding:.55rem .7rem;position:relative}html[data-theme=dark] .np-yaml-head{background:#161b22}.np-copy-btn{background:var(--color-primary);border:none;border-radius:4px;color:#fff;cursor:pointer;font-size:.68rem;font-weight:700;padding:.25rem .5rem;position:absolute;right:.6rem;top:.45rem}.np-copy-btn:hover{background:var(--color-primary-dark)}@keyframes tabFadeIn{0%{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}.tab-pane.active.show{animation:tabFadeIn .3s ease-out}@media(max-width:992px){.netplan-form{grid-template-columns:repeat(8,1fr)}.netplan-form .np-col-8{grid-column:span 8}}@media(max-width:768px){.netplan-form{grid-template-columns:repeat(6,1fr)}.netplan-form .np-col-4,.netplan-form .np-col-6,.netplan-form .np-col-8{grid-column:span 6}.netplan-form .np-col-2,.netplan-form .np-col-3{grid-column:span 3}}@media(max-width:576px){.netplan-form{grid-template-columns:repeat(4,1fr)}.netplan-form .np-col-2,.netplan-form .np-col-3,.netplan-form .np-col-4,.netplan-form .np-col-6,.netplan-form .np-col-8,.np-help{grid-column:span 4}}.dns-server-box{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:0 2px 6px rgba(0,0,0,.1);margin-bottom:.8rem;padding:.8rem}.dns-server-title{align-items:center;color:var(--color-primary);display:flex;font-size:.85rem;font-weight:700;gap:.4rem;margin-bottom:.6rem}.dns-server-title i{font-size:.8rem}.result-table{border-collapse:collapse;margin-top:.4rem;width:100%}.result-table thead{background:var(--color-primary);color:var(--color-white)}.result-table td,.result-table th{border:1px solid var(--border-color);font-size:.75rem;padding:.5rem .6rem;text-align:left;word-break:break-word}.result-table tbody tr:nth-child(2n){background:rgba(0,68,153,.05)}.result-table tbody tr:hover{background:rgba(0,68,153,.1)}.trustcheck-info{background:rgba(0,68,153,.05);border-left:4px solid var(--color-primary);border-radius:4px;font-size:.75rem;margin:.8rem 0;padding:.8rem}.trustcheck-badge{background:var(--color-primary);border-radius:3px;color:#fff;display:inline-block;font-size:.7rem;font-weight:700;margin:.2rem;padding:.2rem .5rem}.trustcheck-pagination{align-items:center;display:flex;flex-wrap:wrap;gap:.5rem;justify-content:center;margin:1.2rem 0}.trustcheck-pagination .page-btn{background:var(--color-primary);border:none;border-radius:4px;color:#fff;cursor:pointer;font-size:.7rem;font-weight:600;padding:.4rem .7rem;transition:var(--transition)}.trustcheck-pagination .page-btn:hover:not(:disabled){background:var(--color-primary-dark);transform:translateY(-1px)}.trustcheck-pagination .page-btn.active{background:var(--color-success)}.trustcheck-pagination .page-btn:disabled{background:#ccc;cursor:not-allowed;opacity:.6}.trustcheck-pagination .page-dots{color:var(--text-secondary);font-weight:700;padding:0 .3rem}.trustcheck-pagination .jump-form{align-items:center;display:flex;gap:.3rem}.trustcheck-pagination .jump-form input{background:var(--bg-light);border:1px solid var(--border-color);border-radius:4px;color:var(--text-primary);font-size:.7rem;padding:.35rem .5rem;text-align:center;width:70px}html[data-theme=dark] .trustcheck-pagination .jump-form input{background:var(--bg-dark)}.trustcheck-pagination .jump-form button{background:var(--color-primary);border:none;border-radius:4px;color:#fff;cursor:pointer;font-size:.7rem;padding:.35rem .6rem}.alert-msg{border-radius:5px;font-size:.8rem;font-weight:600;margin:.8rem 0;padding:.8rem}.alert-error{background:#f8d7da;border:1px solid #f5c2c7;color:#842029}.alert-success{background:#d1e7dd;border:1px solid #badbcc;color:#0f5132}.alert-warning{background:#fff3cd;border:1px solid #ffecb5;color:#664d03}.site-footer{background:var(--footer-bg);border-top:1px solid var(--border-color);color:var(--footer-text);margin-top:auto;padding:1.5rem 0}.site-footer h5{font-size:.9rem;font-weight:700;margin-bottom:.8rem}.site-footer h5 .highlight{color:var(--footer-link)}.site-footer p{font-size:.75rem;font-weight:700;line-height:1.5;margin-bottom:.6rem}.site-footer a{color:var(--footer-link);font-weight:700;text-decoration:none}.site-footer a.footer-brand,.site-footer a.footer-brand:hover{color:inherit;text-decoration:none}.site-footer a:hover{color:var(--footer-hover);text-decoration:underline}.social-links a{align-items:center;background:hsla(0,0%,100%,.1);border-radius:50%;color:var(--footer-text);display:inline-flex;font-size:.75rem;height:1.8rem;justify-content:center;margin-right:.4rem;transition:var(--transition);width:1.8rem}.social-links a:hover{background:var(--footer-link);color:var(--footer-bg);transform:translateY(-1px)}.scroll-top-btn{background:var(--color-primary);border:none;border-radius:50%;bottom:75px;box-shadow:0 3px 10px rgba(0,0,0,.3);color:var(--color-white);cursor:pointer;display:none;height:40px;position:fixed;right:20px;width:40px;z-index:1010}.scroll-top-btn i{font-size:1.35rem;line-height:1}.progress-spinner-overlay{align-items:center;background:rgba(0,0,0,.7);display:flex;height:100%;justify-content:center;left:0;opacity:0;position:fixed;top:0;transition:opacity .2s;visibility:hidden;width:100%;z-index:9999}.progress-spinner-overlay.active{opacity:1;visibility:visible}.spinner-element{animation:spin 1s linear infinite;border-radius:50%;border-right:4px solid transparent;border-top:4px solid #ff3d00;height:45px;width:45px}@keyframes spin{to{transform:rotate(1turn)}}@media(max-width:992px){.result-table{display:block;font-size:.68rem;overflow-x:auto}.result-table td,.result-table th{padding:.4rem .5rem}}@media(max-width:768px){body{font-size:10px}.contact-info{display:none}.contact-info-mobile{display:flex;gap:.8rem}.contact-info-mobile a{color:var(--header-link);font-size:.9rem}.header{padding:.5rem 0}.header img{height:22px}.header__title{font-size:.65rem}.site-header{padding:15px 10px}.site-header h1{font-size:1.2rem}.site-header p{font-size:.75rem}.nav-item-theme{margin-left:0}.nav-item a{font-size:.65rem;padding:.25rem .5rem}.nav-item a span{display:none}.info-card-body{padding:1.4rem}.info-card-title{font-size:.85rem}.data-table td{padding:4px 5px}.data-table td:first-child,.data-table td:nth-child(3){font-size:.65rem}.test-tabs .nav-tabs{gap:.3rem;justify-content:center;padding:.15rem .3rem}.test-tabs .nav-tabs .nav-link{font-size:.6rem;min-height:38px;padding:.3rem .5rem}.test-tabs .tab-content{padding:1.4rem}.test-form{flex-direction:column}.test-form .form-group{min-width:100%}.test-form label{font-size:.7rem}.test-form input,.test-form select{font-size:.75rem;padding:.6rem}.form-actions{flex-direction:column;width:100%}.action-btn{font-size:.7rem;padding:.6rem .9rem;width:100%}.result-table{font-size:.65rem}.result-table td,.result-table th{padding:.35rem .4rem}.dns-server-box{padding:.6rem}.dns-server-title{font-size:.75rem}.trustcheck-info{font-size:.7rem;padding:.6rem}.trustcheck-badge{font-size:.65rem;padding:.15rem .4rem}.trustcheck-pagination{gap:.3rem;margin:1rem 0}.trustcheck-pagination .page-btn{font-size:.65rem;padding:.3rem .5rem}.trustcheck-pagination .jump-form input{font-size:.65rem;padding:.3rem .4rem;width:60px}.trustcheck-pagination .jump-form button{font-size:.65rem;padding:.3rem .5rem}.site-footer{font-size:.7rem;padding:1.2rem 0}.site-footer h5{font-size:.8rem}.site-footer p{font-size:.65rem}.social-links a{font-size:.7rem;height:1.6rem;width:1.6rem}.scroll-top-btn{height:36px;width:36px}}@media(max-width:576px){.data-table td:nth-child(3),.result-table{font-size:.6rem}.result-table td,.result-table th{padding:.3rem .35rem}}@media(max-width:480px){.header{padding:.45rem 0}.header img{height:20px}.header__title{font-size:.6rem}.test-tabs .nav-tabs .nav-link{font-size:.55rem;padding:.28rem .45rem}}@media(max-width:375px){.header img{height:24px}.header__title{font-size:.55rem}.contact-info-mobile a{font-size:.8rem}}@media(max-width:320px){.header img{height:22px}.header__title{font-size:.55rem}.contact-info-mobile a{font-size:.75rem}}@media(min-width:1920px){.container{max-width:1600px}}@media(min-width:2560px){.container{max-width:2200px}}.speedtest-container{margin:0 auto;max-width:100%;width:100%}.speedtest-header{background:linear-gradient(135deg,var(--color-primary),var(--color-primary-dark,#037));border-radius:var(--border-radius);color:#fff;margin-bottom:1.5rem;padding:1rem;text-align:center}.speedtest-header h4{font-size:1.1rem;font-weight:600;margin:0}.speedtest-header p{font-size:.8rem;margin:.5rem 0 0;opacity:.9}.speedtest-cards{display:grid;gap:1rem;grid-template-columns:repeat(2,1fr);margin-bottom:1.5rem}@media(max-width:992px){.speedtest-cards{grid-template-columns:repeat(2,1fr)}}@media(max-width:576px){.speedtest-cards{gap:.8rem;grid-template-columns:repeat(2,1fr)}.speedtest-card{padding:1rem .5rem}.speedtest-icon{font-size:1rem;height:36px;margin-bottom:.5rem;width:36px}.speedtest-value{font-size:1.3rem;margin-bottom:.2rem}.speedtest-value.jitter{font-size:1.1rem!important}.speedtest-label{font-size:.65rem;margin-bottom:.3rem}.speedtest-unit{font-size:.65rem}}.speedtest-card{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:var(--shadow-card);padding:1.5rem 1rem;text-align:center;transition:var(--transition)}.speedtest-card.active{border-color:var(--color-primary);box-shadow:0 0 0 2px rgba(0,68,153,.2)}.speedtest-card:hover{transform:translateY(-2px)}.speedtest-icon{align-items:center;border-radius:50%;color:#fff;display:flex;font-size:1.25rem;height:50px;justify-content:center;margin:0 auto .75rem;width:50px}.speedtest-icon.dl{background:linear-gradient(135deg,#06c,#049)}.speedtest-icon.ul{background:linear-gradient(135deg,#28a745,#1e7e34)}.speedtest-icon.ping{background:linear-gradient(135deg,#e74c3c,#c82333)}.speedtest-icon.jitter{background:linear-gradient(135deg,#e67e22,#e0a800)}.speedtest-label{color:var(--text-secondary);font-size:.75rem;font-weight:600;letter-spacing:.05em;margin-bottom:.5rem;text-transform:uppercase}.speedtest-value{font-size:2rem;font-variant-numeric:tabular-nums;font-weight:700;line-height:1.2;margin-bottom:.25rem}.speedtest-value.dl{color:#06c}html[data-theme=dark] .speedtest-value.dl{color:#09f}.speedtest-value.ul{color:#28a745}html[data-theme=dark] .speedtest-value.ul{color:#3fb950}.speedtest-value.ping{color:#e74c3c}html[data-theme=dark] .speedtest-value.ping{color:#ff6b6b}.speedtest-value.jitter{color:#e67e22;font-size:1.6rem}html[data-theme=dark] .speedtest-value.jitter{color:#ffa502;font-size:1.6rem}.speedtest-unit{color:var(--text-secondary);font-size:.75rem;font-weight:500}.speedtest-progress{background:rgba(0,0,0,.1);border-radius:3px;height:5px;margin-top:.75rem;overflow:hidden;width:100%}html[data-theme=dark] .speedtest-progress{background:hsla(0,0%,100%,.1)}.speedtest-progress-bar{background:linear-gradient(90deg,var(--color-primary),var(--color-primary-dark,#037));border-radius:3px;height:100%;transition:width .3s ease;width:0}.speedtest-btn-container{align-items:center;display:flex;flex-wrap:wrap;gap:.5rem;justify-content:center;margin-bottom:1.5rem}.speedtest-btn{background:linear-gradient(45deg,var(--color-primary),var(--color-primary-dark,#037));border:none;border-radius:var(--border-radius);box-shadow:0 4px 12px rgba(0,102,204,.3);color:#fff;cursor:pointer;font-size:.85rem;font-weight:700;margin:.25rem;min-width:120px;padding:.6rem 1.5rem;transition:var(--transition)}.speedtest-btn-reset{background:linear-gradient(45deg,#f1585c,#e04448);box-shadow:0 4px 12px rgba(241,88,92,.3)}.speedtest-btn:hover{box-shadow:0 6px 16px rgba(0,102,204,.4);transform:translateY(-2px)}.speedtest-btn:active{transform:translateY(0)}.speedtest-btn.running{background:linear-gradient(135deg,#e74c3c,#c0392b);box-shadow:0 4px 12px rgba(231,76,60,.4)}.speedtest-btn-reset:hover{background:linear-gradient(45deg,#e04448,#c82333)}.speedtest-btn:disabled{background-color:#6c757d;box-shadow:none;cursor:not-allowed;opacity:.6;transform:none}.speedtest-btn i{margin-right:.5rem}.speedtest-status{background:rgba(0,102,204,.05);border:1px solid rgba(0,102,204,.1);border-radius:var(--border-radius);font-size:.85rem;font-weight:500;padding:.75rem 1rem;text-align:center}html[data-theme=dark] .speedtest-status{background:rgba(99,102,241,.1);border-color:rgba(99,102,241,.3)}.speedtest-info{background:rgba(0,102,204,.03);border:1px solid rgba(0,102,204,.1);border-radius:var(--border-radius);color:var(--text-secondary);font-size:.8rem;margin-top:1.5rem;padding:1rem}html[data-theme=dark] .speedtest-info{background:rgba(99,102,241,.05);border-color:rgba(99,102,241,.2)}.speedtest-info p{margin:.25rem 0}.speedtest-info i{color:var(--color-primary);margin-right:.5rem}.passgen-checkbox-grid{display:grid;gap:.5rem;grid-template-columns:repeat(auto-fit,minmax(160px,1fr))}.passgen-check{align-items:center;background:var(--bg-light);border:1px solid var(--border-color);border-radius:5px;cursor:pointer;display:flex;font-size:.75rem;font-weight:500;gap:.5rem;padding:.5rem .8rem;transition:var(--transition)}.passgen-check span{display:inline-block;margin-left:.4rem;margin-top:-8px;vertical-align:middle}.passgen-check input[type=checkbox]{cursor:pointer;height:18px;width:18px}.passgen-check:hover{background:rgba(0,68,153,.05);border-color:var(--color-primary)}.passgen-check input[type=checkbox]{accent-color:var(--color-primary);height:16px;width:16px}.passgen-result-table{border-collapse:collapse;width:100%}.passgen-result-table tr{border-bottom:1px solid var(--border-color)}.passgen-result-table td{font-family:var(--font-mono);font-size:.75rem;padding:.6rem .8rem}.passgen-result-table td:first-child{color:var(--text-muted);text-align:center;width:50px}.passgen-result-table td:last-child{text-align:center;width:40px}.passgen-copy-btn{background:0 0;border:none;border-radius:4px;color:var(--color-primary);cursor:pointer;font-size:1.1rem;padding:.5rem;transition:var(--transition)}.passgen-copy-btn:hover{background:rgba(0,68,153,.1)}.passgen-copy-btn.copied{color:var(--color-success)}.ipua-container{max-width:100%;width:100%}.ipua-header{background:linear-gradient(135deg,var(--color-primary),var(--color-primary-dark,#037));border-radius:var(--border-radius);color:#fff;margin-bottom:1.5rem;padding:1rem;text-align:center}.ipua-header h4{font-size:1.1rem;font-weight:600;margin:0}.ipua-header p{font-size:.8rem;margin:.5rem 0 0;opacity:.9}.ipua-table td:first-child{font-weight:600;white-space:nowrap;width:180px}.ipua-table td:first-child i{color:var(--color-primary);margin-right:.5rem;width:16px}.ipua-loading{color:var(--text-muted);font-style:italic}@media(max-width:576px){.passgen-checkbox-grid{grid-template-columns:1fr}.ipua-table td:first-child{font-size:.7rem;width:120px}.ipua-table td{font-size:.7rem}}.phpencrypt-grid{align-items:start;display:grid;gap:15px;grid-template-columns:2fr 1.5fr 1fr;width:100%}.phpencrypt-grid .form-group{margin-bottom:0;min-width:0;width:100%}.phpencrypt-grid label{display:block;font-size:.8rem;font-weight:600;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.phpencrypt-grid input[type=file],.phpencrypt-grid select{background:var(--bg-light);border:1px solid var(--border-color);border-radius:5px;box-sizing:border-box;color:var(--text-primary);font-size:.8rem;height:42px;padding:.6rem;width:100%}html[data-theme=dark] .phpencrypt-grid input[type=file],html[data-theme=dark] .phpencrypt-grid select{background:var(--bg-dark)}.phpencrypt-grid .form-actions{display:flex;gap:10px;grid-column:1/-1;margin-top:15px}@media (max-width:768px){.phpencrypt-grid{gap:12px;grid-template-columns:1fr}.phpencrypt-grid .form-actions{flex-direction:column}.phpencrypt-grid input[type=file],.phpencrypt-grid select{height:auto}}.btn-download-test{align-items:center;background:linear-gradient(135deg,#049,#037);border:1px solid hsla(0,0%,100%,.1);border-radius:5px;box-shadow:0 2px 5px rgba(0,0,0,.1);color:#fff;display:inline-flex;font-size:.75rem;font-weight:600;gap:.5rem;padding:.4rem .8rem;text-decoration:none;transition:all .2s ease}.btn-download-test:hover{box-shadow:0 4px 8px rgba(0,68,153,.3);color:#fff;filter:brightness(1.1);text-decoration:none;transform:translateY(-2px)}.btn-download-test i{font-size:.85rem}.btn-download-test.btn-green{background:linear-gradient(135deg,#28a745,#20c997);border:1px solid hsla(0,0%,100%,.1)}.btn-download-test.btn-green:hover{box-shadow:0 4px 8px rgba(40,167,69,.3)}.btn-download-test.btn-dl-250,.btn-download-test.btn-dl-250mb{background:linear-gradient(135deg,#0369a1,#0ea5e9)}.btn-download-test.btn-dl-250:hover,.btn-download-test.btn-dl-250mb:hover{box-shadow:0 4px 12px rgba(3,105,161,.35)}.btn-download-test.btn-dl-500,.btn-download-test.btn-dl-500mb{background:linear-gradient(135deg,#1e3a8a,#3b82f6)}.btn-download-test.btn-dl-500:hover,.btn-download-test.btn-dl-500mb:hover{box-shadow:0 4px 12px rgba(30,58,138,.35)}.btn-download-test.btn-dl-1g,.btn-download-test.btn-dl-1gb{background:linear-gradient(135deg,#9d174d,#e11d48)}.btn-download-test.btn-dl-1g:hover,.btn-download-test.btn-dl-1gb:hover{box-shadow:0 4px 12px rgba(157,23,77,.35)}.btn-download-test.btn-dl-250-v6,.btn-download-test.btn-dl-250mb-v6{background:linear-gradient(135deg,#4f46e5,#818cf8)}.btn-download-test.btn-dl-250-v6:hover,.btn-download-test.btn-dl-250mb-v6:hover{box-shadow:0 4px 12px rgba(79,70,229,.35)}.btn-download-test.btn-dl-500-v6,.btn-download-test.btn-dl-500mb-v6{background:linear-gradient(135deg,#92400e,#d97706)}.btn-download-test.btn-dl-500-v6:hover,.btn-download-test.btn-dl-500mb-v6:hover{box-shadow:0 4px 12px rgba(146,64,14,.35)}.btn-download-test.btn-dl-1g-v6,.btn-download-test.btn-dl-1gb-v6{background:linear-gradient(135deg,#831843,#be185d)}.btn-download-test.btn-dl-1g-v6:hover,.btn-download-test.btn-dl-1gb-v6:hover{box-shadow:0 4px 12px rgba(131,24,67,.35)}.btn-download-test.btn-speedtest{background:linear-gradient(135deg,#065f46,#10b981)}.btn-download-test.btn-speedtest:hover{box-shadow:0 4px 12px rgba(6,95,70,.35)}.btn-download-test.btn-repository{background:linear-gradient(135deg,#7f1d1d,#dc2626)}.btn-download-test.btn-repository:hover{box-shadow:0 4px 12px rgba(127,29,29,.35)}.minify-type-label{align-items:center;background:0 0;border:1px solid var(--color-primary);border-radius:5px;color:var(--color-primary);cursor:pointer;display:inline-flex;font-size:.85rem;font-weight:600;gap:.5rem;padding:.5rem 1rem;transition:all .2s ease}.minify-type-label:hover{background:rgba(0,68,153,.1);transform:translateY(-1px)}.btn-check:checked+.minify-type-label{background:linear-gradient(135deg,var(--color-primary),var(--color-primary-dark));box-shadow:0 2px 5px rgba(0,68,153,.3);color:#fff}.rbl-results-table{background:var(--card-bg);border:1px solid var(--border-color);border-collapse:collapse;border-radius:var(--border-radius);margin:1rem 0;overflow:hidden;width:100%}.rbl-results-table td,.rbl-results-table th{border-bottom:1px solid var(--border-color);padding:.75rem 1rem;text-align:left;vertical-align:middle}.rbl-results-table th{background:rgba(0,123,255,.05);font-weight:700;white-space:nowrap}html[data-theme=dark] .rbl-results-table th{background:rgba(0,153,255,.1)}.rbl-results-table td{font-family:var(--font-mono);font-size:.95rem;word-wrap:break-word}.table-col-no{text-align:center;width:80px}.table-col-status{width:120px}.rbl-status-listed{color:var(--color-danger)}.rbl-status-clean,.rbl-status-listed{align-items:center;display:inline-flex;font-weight:700;gap:.4rem}.rbl-status-clean{color:var(--color-success)}.check-form-container{background:var(--card-bg);border-radius:var(--border-radius);box-shadow:var(--shadow-card);margin:2rem auto;max-width:900px;padding:2rem}.check-form-container,.input-field{border:1px solid var(--border-color);width:100%}.input-field{background-color:var(--bg-light);border-radius:6px;color:var(--text-primary);font-size:1rem;font-weight:600;padding:.75rem 1rem;text-align:center}html[data-theme=dark] .input-field{background-color:#0d1117;border-color:#30363d;color:#fff}html[data-theme=dark] .input-field::placeholder{color:#8b949e}.input-label{display:block;font-weight:700;margin-bottom:.5rem;text-align:center;width:100%}.status-alert{border-radius:6px;font-weight:600;margin-bottom:1rem;padding:1rem;text-align:center}.status-alert-danger{background-color:#fee;border:1px solid #fcc;color:#c00}.status-alert-success{background-color:#e8f5e9;border:1px solid #c8e6c9;color:#2e7d32}.status-alert-warning{background-color:#fff3cd;border:1px solid #ffeaa7;color:#856404}html[data-theme=dark] .status-alert-danger{background-color:rgba(239,68,68,.2);border-color:rgba(239,68,68,.5);color:#fca5a5}html[data-theme=dark] .status-alert-success{background-color:rgba(34,197,94,.2);border-color:rgba(34,197,94,.5);color:#86efac}html[data-theme=dark] .status-alert-warning{background-color:rgba(251,191,36,.2);border-color:rgba(251,191,36,.5);color:#fcd34d}@media(max-width:768px){.passgen-form{padding:1rem!important}.passgen-form .form-group{flex-basis:100%!important;margin-bottom:1rem!important;width:100%!important}.passgen-form input[type=number]{font-size:.7rem!important;padding:.75rem!important;width:100%!important}.passgen-form label{display:block!important;font-size:.7rem!important;font-weight:600!important;margin-bottom:.5rem!important}.passgen-form .form-group>div:first-child{font-size:.7rem!important;font-weight:700!important;margin-bottom:.7rem!important}.passgen-checkbox-grid{display:flex!important;flex-direction:column!important;gap:.75rem!important;width:100%!important}.passgen-check{background:var(--card-bg)!important;border:1px solid var(--border-color)!important;border-radius:8px!important;margin:0!important;padding:.75rem!important;width:100%!important}.passgen-check label{font-size:.7rem!important}.passgen-check input[type=checkbox]{height:20px!important;margin-right:.75rem!important;width:20px!important}.passgen-result-table{font-size:.85rem!important;table-layout:fixed!important}.passgen-result-table thead th{font-size:.75rem!important;font-weight:700!important;padding:.75rem .5rem!important;text-align:center!important}.passgen-result-table thead th:first-child{width:75%!important}.passgen-result-table thead th:last-child{text-align:center!important;width:25%!important}.passgen-result-table tbody td:first-child{font-size:.75rem!important;font-weight:700!important;padding:.75rem .5rem!important;word-break:break-all!important}.passgen-result-table tbody td:last-child{padding:.75rem .5rem!important;text-align:center!important}.passgen-copy-btn{font-size:.9rem!important;padding:.5rem .75rem!important}.passgen-form button[type=submit]{font-size:.7rem!important;padding:.875rem!important;width:100%!important}#netplanconfig-panel .form-group,#netplanconfig-panel .np-check{flex-basis:100%!important;margin-bottom:1rem!important;width:100%!important}#netplanconfig-panel input[type=text],#netplanconfig-panel textarea{font-size:16px!important;padding:.75rem!important;width:100%!important}#netplanconfig-panel label{display:block!important;font-size:.7rem!important;font-weight:600!important;margin-bottom:.5rem!important}#netplanconfig-panel .np-check{padding:.75rem!important}#netplanconfig-panel .np-check label{font-size:.7rem!important}#netplanconfig-panel input[type=checkbox]{height:20px!important;width:20px!important}#netplanconfig-panel button[type=submit]{font-size:.7rem!important;padding:.875rem!important;width:100%!important}#netplanconfig-panel textarea{font-family:monospace!important;min-height:200px!important}#netplanconfig-panel .netplan-form{display:flex!important;flex-direction:column!important;gap:1rem!important}.netplan-form .np-col-12,.netplan-form .np-col-2,.netplan-form .np-col-3,.netplan-form .np-col-6{grid-column:span 12!important}.np-ipv6-section{display:none;grid-template-columns:1fr!important}.np-ipv6-section .form-group{grid-column:span 1!important;width:100%!important}.site-header h1{font-size:1.5rem!important;margin-bottom:.2rem!important}.site-header p{font-size:.8rem!important;margin-top:0!important}.form-actions{align-items:stretch;flex-direction:column;gap:.5rem!important}.action-btn{margin:0!important;width:100%!important}.nav-item a{font-size:.7rem;padding:.4rem .6rem}.main-content{padding:20px}.theme-switcher-top{font-size:1.2rem;height:38px;width:38px}.passgen-checkbox-grid{gap:.6rem;grid-template-columns:1fr}.passgen-check{font-size:.75rem;padding:.6rem .8rem}.passgen-check input[type=checkbox]{height:16px;width:16px}.passgen-copy-btn{font-size:1rem;padding:.4rem}}.whois-result-card{background:var(--card-bg);border:1px solid var(--border-color);border-radius:12px;box-shadow:var(--shadow-card);margin-top:1.5rem;overflow:hidden;transition:var(--transition)}.whois-result-header{align-items:center;background:linear-gradient(135deg,#3730a3,#0891b2);color:#fff;display:flex;font-size:.9rem;font-weight:700;gap:.6rem;padding:.9rem 1.2rem}.whois-result-header i{font-size:1.1rem}.whois-result-table{border-collapse:separate;border-spacing:0;width:100%}.whois-result-table td{border-bottom:1px solid var(--border-color);font-size:.85rem;padding:.85rem 1.2rem;vertical-align:middle}.whois-result-table tr:last-child td{border-bottom:none}.whois-result-table tr:nth-child(2n){background:rgba(79,70,229,.02)}html[data-theme=dark] .whois-result-table tr:nth-child(2n){background:rgba(255,255,255,.015)}.whois-result-table tr:hover{background:rgba(79,70,229,.05)}html[data-theme=dark] .whois-result-table tr:hover{background:rgba(255,255,255,.03)}.whois-result-table td:first-child{color:var(--color-primary);font-weight:600;white-space:nowrap;width:240px}.whois-result-table td:first-child i{margin-right:.5rem;width:18px;text-align:center;display:inline-block}.whois-result-table td:last-child{color:var(--text-primary);font-family:var(--font-mono);font-size:.8rem;word-break:break-all}.whois-info-tip{color:var(--text-secondary);display:block;font-size:.65rem;font-weight:400;margin-top:4px}.whois-raw-toggle{background:linear-gradient(135deg,#3730a3,#0891b2);border:none;border-radius:6px;color:#fff;cursor:pointer;display:inline-flex;align-items:center;font-size:.75rem;font-weight:600;gap:.4rem;margin:1.2rem;padding:.5rem 1rem;transition:var(--transition);box-shadow:0 2px 6px rgba(55,48,163,.2)}.whois-raw-toggle:hover{filter:brightness(1.1);transform:translateY(-1px);box-shadow:0 4px 12px rgba(55,48,163,.35)}.whois-raw-box{background:#090d16;border-radius:8px;color:#8a9fc4;display:none;font-family:var(--font-mono);font-size:.75rem;max-height:400px;overflow-y:auto;padding:1.2rem;margin:0 1.2rem 1.2rem;border:1px solid var(--border-color);white-space:pre-wrap;word-wrap:break-word;line-height:1.5}.whois-raw-box.show{display:block}.dns-result-card{background:var(--card-bg);border:1px solid var(--border-color);border-radius:var(--border-radius);box-shadow:0 2px 8px rgba(0,0,0,.08);margin-top:.8rem;overflow:hidden}.dns-type-header{align-items:center;background:linear-gradient(135deg,var(--color-primary),var(--color-primary-dark));color:#fff;display:flex;font-size:.8rem;font-weight:700;gap:.5rem;padding:.55rem .8rem}.dns-type-header i{font-size:.85rem}.dns-type-badge{background:hsla(0,0%,100%,.2);border-radius:4px;font-size:.65rem;font-weight:600;margin-left:auto;padding:.15rem .5rem}.dns-table-wrapper{width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.dns-record-table{border-collapse:collapse;width:100%;min-width:650px}.dns-record-table thead{background:rgba(0,68,153,.06)}html[data-theme=dark] .dns-record-table thead{background:rgba(255,255,255,.04)}.dns-record-table th{border-bottom:2px solid var(--border-color);color:var(--text-secondary);font-size:.7rem;font-weight:700;padding:.5rem .6rem;text-align:left;text-transform:uppercase}.dns-record-table td{border-bottom:1px solid var(--border-color);font-family:var(--font-mono);font-size:.75rem;padding:.5rem .6rem;word-break:break-all;vertical-align:middle}.dns-record-table tr:last-child td{border-bottom:none}.dns-record-table tr:nth-child(2n){background:rgba(0,68,153,.03)}html[data-theme=dark] .dns-record-table tr:nth-child(2n){background:rgba(255,255,255,.02)}.dns-record-table tr:hover{background:rgba(0,68,153,.07)}html[data-theme=dark] .dns-record-table tr:hover{background:rgba(255,255,255,.05)}.dns-no-records{color:var(--text-secondary);font-size:.75rem;font-style:italic;padding:.8rem;text-align:center}.dns-summary-bar{align-items:center;background:rgba(0,68,153,.04);border:1px solid var(--border-color);border-radius:var(--border-radius);display:flex;flex-wrap:wrap;gap:.5rem;justify-content:center;margin-top:1rem;padding:.6rem 1rem}.dns-summary-badge{align-items:center;border-radius:4px;display:inline-flex;font-size:.7rem;font-weight:600;gap:.3rem;padding:.25rem .6rem}.dns-summary-badge.has-records{background:rgba(40,167,69,.1);border:1px solid rgba(40,167,69,.3);color:#28a745}.dns-summary-badge.no-records{background:rgba(108,117,125,.08);border:1px solid rgba(108,117,125,.2);color:var(--text-secondary)}.dns-record-table td:first-child,.dns-record-table th:first-child{width:35%;text-align:left;word-break:break-all}.dns-record-table td:nth-child(2),.dns-record-table th:nth-child(2){width:15%;text-align:center}.dns-record-table td:nth-child(3),.dns-record-table th:nth-child(3){width:15%;text-align:center}.dns-record-table td:nth-child(4),.dns-record-table th:nth-child(4){width:35%;text-align:left;word-break:break-all}.dns-badge{display:inline-block;padding:.15rem .4rem;font-size:.7rem;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:4px;color:#fff;text-transform:uppercase}.dns-badge-a{background:linear-gradient(135deg,#1a56db,#3b82f6)}.dns-badge-aaaa{background:linear-gradient(135deg,#5b21b6,#7c3aed)}.dns-badge-ns{background:linear-gradient(135deg,#065f46,#059669)}.dns-badge-mx{background:linear-gradient(135deg,#b91c1c,#d97706)}.dns-badge-soa{background:linear-gradient(135deg,#881337,#be123c)}.dns-badge-txt{background:linear-gradient(135deg,#0e7490,#0369a1)}.dns-header-a{background:linear-gradient(135deg,#1a56db,#3b82f6)!important}.dns-header-aaaa{background:linear-gradient(135deg,#5b21b6,#7c3aed)!important}.dns-header-ns{background:linear-gradient(135deg,#065f46,#059669)!important}.dns-header-mx{background:linear-gradient(135deg,#b91c1c,#d97706)!important}.dns-header-soa{background:linear-gradient(135deg,#881337,#be123c)!important}.dns-header-txt{background:linear-gradient(135deg,#0e7490,#0369a1)!important}@media(max-width:768px){.whois-result-table td:first-child{font-size:.7rem;width:160px}.whois-result-table td:last-child{font-size:.7rem}.whois-info-tip{font-size:.6rem}.dns-record-table th{font-size:.6rem;padding:.4rem .5rem}.dns-record-table td{font-size:.65rem;padding:.4rem .5rem}.dns-type-header{font-size:.7rem;padding:.45rem .6rem}}@media(max-width:576px){.whois-result-table td{display:block;padding:.4rem .6rem}.whois-result-table td:first-child{border-bottom:none;padding-bottom:0;width:100%}.whois-result-table td:last-child{padding-top:0}.dns-record-table{display:block;overflow-x:auto}.dns-summary-bar{gap:.3rem;padding:.5rem}}
	</style>
	
</head>

<body>
    <div class="progress-spinner-overlay" id="progressLoader">
        <div class="spinner-element"></div>
    </div>
    <div class="wrapper">
        <header class="header" role="banner">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <a href="/" aria-label="Home"><img src="lg-logo.webp" alt="Looking Glass Logo" class="me-3"
                                loading="lazy"></a>
                        <span class="header__title">Looking Glass <span class="highlight2">Network Tools</span></span>
                    </div>
                    <div class="contact-info">
                        <span><i class="fa-solid fa-phone-alt"></i> +62-812-6969-6969</span>
                        <span>|</span>
                        <span><i class="fa-solid fa-envelope"></i> <a
                                href="mailto:info@alsyundawy.com">info@alsyundawy.com</a></span>
                        <span>|</span>
                        <span><i class="fa-brands fa-whatsapp"></i> +62-812-6969-6969</span>
                        <span>|</span>
                        <span><i class="fa-solid fa-globe"></i> <a href="https://www.alsyundawy.com" target="_blank"
                                rel="noopener">www.alsyundawy.com</a></span>
                    </div>
                    <div class="contact-info-mobile">
                        <a href="tel:+62-812-6969-6969" aria-label="Phone"><i class="fa-solid fa-phone-alt"></i></a>
                        <a href="mailto:info@alsyundawy.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                        <a href="https://wa.me/628126969696" target="_blank" rel="noopener" aria-label="WhatsApp"><i
                                class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.alsyundawy.com" target="_blank" rel="noopener" aria-label="Website"><i
                                class="fa-solid fa-globe"></i></a>
                    </div>
                </div>
            </div>
        </header>
        <section class="site-header" aria-label="Site hero">
            <div class="header-content">
                <img src="lg-logo.webp" alt="ALSYUNDAWY IT SOLUTION" width="220">
                <h1>
                    <?php echo sanitize_output($siteName); ?>
                </h1>
                <p>Enterprise Network Diagnostics &amp; Monitoring Solutions</p>
            </div>
        </section>
			<nav class="main-nav" aria-label="Main navigation">
				<div class="container d-flex align-items-center">
					<ul class="nav-menu flex-grow-1">
						<li class="nav-item">
							<a href="/">
								<i class="fa-solid fa-house"></i><span>Home</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://wa.me/628126969696" target="_blank" rel="noopener">
								<i class="fa-brands fa-whatsapp"></i><span>WhatsApp</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://t.me/alsyundawy" target="_blank" rel="noopener">
								<i class="fa-brands fa-telegram"></i><span>Telegram</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://github.com/alsyundawy" target="_blank" rel="noopener">
								<i class="fa-brands fa-github"></i><span>GitHub</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://www.alsyundawy.com" target="_blank" rel="noopener">
								<i class="fa-solid fa-globe"></i><span>Website</span>
							</a>
						</li>
								
						<li class="nav-item">
							<a href="https://dnschecker.org" target="_blank" rel="noopener">
								<i class="fa-solid fa-network-wired"></i><span>DNS Checker</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://hetrixtools.com/blacklist-check/" target="_blank" rel="noopener">
								<i class="fa-solid fa-shield-alt"></i><span>RBL Checker</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://mxtoolbox.com" target="_blank" rel="noopener">
								<i class="fa-solid fa-envelope-circle-check"></i><span>MX Tools</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="https://check-host.net" target="_blank" rel="noopener noreferrer">
									<i class="fa-solid fa-satellite-dish"></i><span>MULTI PING</span>
							</a>
						</li>	

						<li class="nav-item">
							<a href="mailto:info@alsyundawy.com">
								<i class="fa-solid fa-envelope"></i><span>Contact</span>
							</a>
						</li>
					</ul>

					<div class="nav-item nav-item-theme">
						<button id="themeToggle" aria-label="Toggle theme">
							<i class="fa-solid fa-moon"></i>
						</button>
					</div>
				</div>
			</nav>

        <main class="main-content container">
            <div class="row g-3 mt-2">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="info-card">
                        <div class="info-card-body">
                            <h3 class="info-card-title"><i class="fas fa-server"></i>SERVER INFO</h3>
                            <table class="data-table">
                                <tr>
                                    <td><i class="fas fa-map-marker-alt"></i>SERVER LOCATION</td>
                                    <td>:</td>
                                    <td>
                                        <?php echo sanitize_output($serverLocation); ?>
                                    </td>
                                </tr>
                                <?php if (!empty($ipv4)): ?>
                                    <tr>
                                        <td><i class="fas fa-globe"></i>Server IPv4</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo sanitize_output($ipv4); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($ipv6)): ?>
                                    <tr>
                                        <td><i class="fas fa-network-wired"></i>Server IPv6</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo sanitize_output($ipv6); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-card-body">
                            <h3 class="info-card-title"><i class="fas fa-network-wired"></i>YOUR IP ADDRESS</h3>
                            <table class="data-table">
                                <tr>
                                    <td><i class="fas fa-desktop"></i>Your IPv4</td>
                                    <td>:</td>
                                    <td><span id="clientIPv4">Loading...</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-laptop"></i>Your IPv6</td>
                                    <td>:</td>
                                    <td><span id="clientIPv6">Loading...</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <?php if (!empty($iperfport)): ?>
                        <div class="info-card" style="height:calc(100% - 1.2rem)">
                            <div class="info-card-body">
                                <h3 class="info-card-title"><i class="fas fa-tachometer-alt"></i>IPERF TEST</h3>
                                <?php if (!empty($ipv4)): ?>
                                    <h5 style="font-weight:700;margin-top:.8rem;font-size:.85rem">IPv4</h5>
                                    <pre class="iperf-cmd-box">iperf3 -c <?php echo sanitize_output($ipv4); ?> -p <?php echo sanitize_output($iperfport); ?> -P 4</pre>
                                    <pre class="iperf-cmd-box">iperf3 -c <?php echo sanitize_output($ipv4); ?> -p <?php echo sanitize_output($iperfport); ?> -P 4 -R</pre>
                                <?php endif; ?>
                                <?php if (!empty($ipv6)): ?>
                                    <h5 style="font-weight:700;margin-top:.8rem;font-size:.85rem">IPv6</h5>
                                    <pre class="iperf-cmd-box">iperf3 -c <?php echo sanitize_output($ipv6); ?> -p <?php echo sanitize_output($iperfport); ?> -P 4</pre>
                                    <pre class="iperf-cmd-box">iperf3 -c <?php echo sanitize_output($ipv6); ?> -p <?php echo sanitize_output($iperfport); ?> -P 4 -R</pre>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="info-card" style="height:calc(100% - 1.2rem)">
                        <div class="info-card-body">
                            <h3 class="info-card-title"><i class="fa-solid fa-download"></i>DOWNLOAD TEST</h3>
                            <?php if (!empty($ipv4)): ?>
                                <h5 class="download-section-title">IPv4 DOWNLOAD TEST FILE</h5>
                                <div style="display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin:.4rem 0">
                                    <?php
                                    if (!empty($testFiles) && is_array($testFiles)):
                                        foreach ($testFiles as $val) {
                                            echo '<a href="?download=' . sanitize_output($val) . '" class="btn-download-test ' . ('btn-dl-' . strtolower(str_replace(' ', '', $val))) . '"><i class="fa-solid fa-file-arrow-down"></i> ' . sanitize_output($val) . '</a>';
                                        }
                                    endif;
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($ipv6)): ?>
                                <h5 class="download-section-title">IPv6 DOWNLOAD TEST FILE</h5>
                                <div style="display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin:.4rem 0">
                                    <?php
                                    if (!empty($testFiles) && is_array($testFiles)):
                                        foreach ($testFiles as $val) {
                                            echo '<a href="?download=' . sanitize_output($val) . '" class="btn-download-test ' . ('btn-dl-' . strtolower(str_replace(' ', '', $val)) . '-v6') . '"><i class="fa-solid fa-file-arrow-down"></i> ' . sanitize_output($val) . '</a>';
                                        }
                                    endif;
                                    ?>
                                </div>
                            <?php endif; ?>
                            <h5 class="download-section-title">SPEEDTEST & REPOSITORY</h5>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin:.4rem 0">
                                <a href="https://www.speedtest.net" target="_blank" rel="noopener"
                                    class="btn-download-test btn-speedtest"><i class="fa-solid fa-tachometer-alt"></i>
                                    SPEEDTEST</a>
                                <a href="https://mirror.sg.gs" target="_blank" rel="noopener"
                                    class="btn-download-test btn-repository"><i class="fa-solid fa-book-atlas"></i>
                                    REPOSITORY</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="network-test-container">
                        <h3 class="network-test-title"><i class="fa-solid fa-network-wired"></i> LOOKING GLASS NETWORK
                            TEST TOOLS</h3>
                        <div class="test-tabs">
                            <ul class="nav nav-tabs" id="networkTestTabs" role="tablist">
								<?php
								$tabs = [];
								if (((!empty($ipv4)) || (!empty($ipv6))) && (empty($ping))) {
									$tabs[] = [
										'id' => 'ping',
										'icon' => 'fa-satellite-dish',
										'label' => 'Ping',
										'desc' => 'Check network connectivity and packet loss to a host (ICMP ping).',
										'active' => true
									];
								}
								if (((!empty($ipv4)) || (!empty($ipv6))) && (empty($traceroute))) {
									$tabs[] = [
										'id' => 'traceroute',
										'icon' => 'fa-route',
										'label' => 'Traceroute',
										'desc' => 'Trace the packet path and measure per-hop latency to a host.',
										'active' => empty($tabs)
									];
								}
								if (((!empty($ipv4)) || (!empty($ipv6))) && (empty($host_cmd))) {
									$tabs[] = [
										'id' => 'host',
										'icon' => 'fa-server',
										'label' => 'Host',
										'desc' => 'Perform DNS lookups and resolve hostnames to IP addresses (A/AAAA records).',
										'active' => empty($tabs)
									];
								}
								if (((!empty($ipv4)) || (!empty($ipv6))) && (empty($mtr))) {
									$tabs[] = [
										'id' => 'mtr',
										'icon' => 'fa-chart-line',
										'label' => 'MTR',
										'desc' => 'Run MTR (combined traceroute and continuous ping) for real-time path and loss diagnostics.',
										'active' => empty($tabs)
									];
								}
								$tabs[] = [
									'id' => 'whois',
									'icon' => 'fa-circle-info',
									'label' => 'WHOIS',
									'desc' => 'Lookup WHOIS information for any IP address or domain name. Results displayed in a human-readable format.',
									'active' => false,
									'type' => 'ajax'
								];
								$tabs[] = [
									'id' => 'dnslookup',
									'icon' => 'fa-magnifying-glass-chart',
									'label' => 'DNS Lookup',
									'desc' => 'Check DNS records for a domain — A, AAAA, NS, MX, SOA, and TXT records.',
									'active' => false,
									'type' => 'ajax'
								];
								foreach ($tabs as $tab):
									?>

                                    <li class="nav-item" role="presentation">
                                        <?php if (isset($tab['link'])): ?>
                                            <a href="<?php echo sanitize_output($tab['link']); ?>"
                                                class="nav-link <?php echo $tab['active'] ? 'active' : ''; ?>">
                                                <i class="fas <?php echo sanitize_output($tab['icon']); ?>"></i>
                                                <?php echo sanitize_output($tab['label']); ?>
                                            </a>
                                        <?php else: ?>
                                            <button class="nav-link <?php echo $tab['active'] ? 'active' : ''; ?>"
                                                id="<?php echo sanitize_output($tab['id']); ?>-tab" data-bs-toggle="tab"
                                                data-bs-target="#<?php echo sanitize_output($tab['id']); ?>-panel" type="button" role="tab">
                                                <i class="fas <?php echo sanitize_output($tab['icon']); ?>"></i>
                                                <?php echo sanitize_output($tab['label']); ?>
                                            </button>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tab-content" id="networkTestTabsContent">
                                <?php foreach ($tabs as $tab): ?>
                                    <div class="tab-pane fade <?php echo $tab['active'] ? 'show active' : ''; ?>"
                                        id="<?php echo sanitize_output($tab['id']); ?>-panel" role="tabpanel">
                                        <div class="tab-section-header">
                                            <h4><i class="fas <?php echo sanitize_output($tab['icon']); ?>"></i> <?php echo sanitize_output($tab['label']); ?></h4>
                                            <p><?php echo sanitize_output($tab['desc'] ?? ''); ?></p>
                                        </div>
                                        <?php if (($tab['type'] ?? '') === 'ajax'): ?>
                                        <form class="test-form ajax-test-form" data-test-type="<?php echo sanitize_output($tab['id']); ?>">
                                            <div class="form-group" style="flex-grow:2">
                                                <label for="<?php echo sanitize_output($tab['id']); ?>_host"><?php echo $tab['id'] === 'whois' ? 'Domain or IP Address:' : 'Domain Name:'; ?></label>
                                                <input type="text" name="host" id="<?php echo sanitize_output($tab['id']); ?>_host" placeholder="<?php echo $tab['id'] === 'whois' ? 'Example: 8.8.8.8 or google.com' : 'Example: google.com'; ?>" autocomplete="on" autocapitalize="none" spellcheck="false" required>
                                            </div>
                                            <div class="form-actions" style="flex-basis:100%;margin-top:.8rem">
                                                <input type="hidden" name="csrf" value="<?php echo $csrf_token; ?>">
                                                <input type="hidden" name="cmd" value="<?php echo sanitize_output($tab['id']); ?>">
                                                <button type="submit" class="action-btn action-btn-primary"><i class="fas fa-play"></i>Run <?php echo sanitize_output($tab['label']); ?></button>
                                                <button type="button" class="action-btn action-btn-reset reset-tab-btn"><i class="fas fa-eraser"></i>Reset</button>
                                            </div>
                                        </form>
                                        <div class="output-section" data-output-for="<?php echo sanitize_output($tab['id']); ?>">
                                            <div class="alert-msg alert-error" style="display:none"></div>
                                            <div class="ajax-result-container" id="<?php echo sanitize_output($tab['id']); ?>-result"></div>
                                        </div>
                                        <?php else: ?>
                                        <form class="test-form network-test-form" data-test-type="<?php echo sanitize_output($tab['id']); ?>">
                                            <div class="form-group" style="flex-grow:2">
                                                <label for="<?php echo sanitize_output($tab['id']); ?>_host">Host or IP Address:</label>
                                                <input type="text" name="host" id="<?php echo sanitize_output($tab['id']); ?>_host" placeholder="Example: 8.8.8.8 or google.com" autocomplete="on" autocapitalize="none" spellcheck="false" required>
                                            </div>
                                            <?php if (in_array($tab['id'], ['ping', 'traceroute', 'mtr'])): ?>
                                                <div class="form-group" style="flex-grow:1">
                                                    <label for="<?php echo sanitize_output($tab['id']); ?>_ipv">IP Version:</label>
                                                    <select name="ipversion" id="<?php echo sanitize_output($tab['id']); ?>_ipv">
                                                        <?php if (!empty($ipv4)): ?>
                                                            <option value="4">IPv4</option>
                                                        <?php endif; ?>
                                                        <?php if (!empty($ipv6)): ?>
                                                            <option value="6">IPv6</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-actions" style="flex-basis:100%;margin-top:.8rem">
                                                <input type="hidden" name="csrf" value="<?php echo $csrf_token; ?>">
                                                <input type="hidden" name="cmd" value="<?php echo sanitize_output($tab['id']); ?>">
                                                <button type="submit" class="action-btn action-btn-primary"><i class="fas fa-play"></i>Run Test</button>
                                                <button type="button" class="action-btn action-btn-reset reset-tab-btn"><i class="fas fa-eraser"></i>Reset</button>
                                            </div>
                                        </form>
                                        <div class="output-section" data-output-for="<?php echo sanitize_output($tab['id']); ?>">
                                            <div class="alert-msg alert-error" style="display:none"></div>
                                            <pre class="output-box"></pre>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="site-footer" role="contentinfo">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fa-solid fa-network-wired"></i> Looking Glass <span class="highlight">Network
                                Tools</span></h5>
                        <p>Solusi analisis jaringan modern untuk kebutuhan diagnostik dan pemantauan profesional.</p>
						<p><a class="footer-brand" href="https://www.alsyundawy.com" target="_blank"
						      rel="noopener">ALSYUNDAWY IT SOLUTION</a> | AS696969 | COPYLEFT © 2022-<?php echo date('Y'); ?>. ALL RIGHTS RESERVED.</p>
                        <p><a href="https://alsyundawy.com" target="_blank" rel="noopener">DESIGN OLEH HARRY DERTIN
                                SUTISNA ALSYUNDAWY</a></p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>COPYLEFT © 2022-<?php echo date('Y'); ?> ALSYUNDAWY LOOKING GLASS NETWORK TOOLS. HAK CIPTA DILINDUNGI.</p>
						<p>
							INFO:
							<a href="https://stat.ripe.net/AS696969" target="_blank" rel="noopener">RIPESTAT</a> |
							<a href="https://bgp.he.net/AS696969" target="_blank" rel="noopener">HE.NET</a> |
							<a href="https://bgp.tools/as/696969" target="_blank" rel="noopener">BGP.Tools</a> |
							<a href="https://www.robtex.com/as/AS696969.html" target="_blank" rel="noopener">ROBTEX</a> |
							<a href="https://www.peeringdb.com/view.php?asn=696969" target="_blank" rel="noopener">PEERINGDB</a> |
							<a href="https://ipinfo.io/AS696969" target="_blank" rel="noopener">IPinfo</a> |
							<a href="https://asrank.caida.org/asns/696969" target="_blank" rel="noopener">ASRank</a>
						</p>
                        <div class="social-links">
                            <a href="https://github.com/alsyundawy" target="_blank" rel="noopener"
                                aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                            <a href="https://linkedin.com/in/alsyundawy" target="_blank" rel="noopener"
                                aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://twitter.com/alsyundawy" target="_blank" rel="noopener"
                                aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="https://facebook.com/alsyundawy" target="_blank" rel="noopener"
                                aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                            <a href="https://instagram.com/harry.ds.alsyundawy" target="_blank" rel="noopener"
                                aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://youtube.com/alsyundawy" target="_blank" rel="noopener"
                                aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                            <a href="https://tiktok.com/alsyundawy" target="_blank" rel="noopener"
                                aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="https://threads.net/alsyundawy" target="_blank" rel="noopener"
                                aria-label="Threads"><i class="fa-brands fa-threads"></i></a>
                            <a href="https://discord.gg/alsyundawy" target="_blank" rel="noopener"
                                aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
                            <a href="https://t.me/alsyundawy" target="_blank" rel="noopener"
                                aria-label="Telegram"><i class="fa-brands fa-telegram"></i></a>
                            <a href="https://wa.me/628126969696" target="_blank" rel="noopener"
                                aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <button id="scrollToTop" class="scroll-top-btn" aria-label="Scroll to top"><i class="fa-solid fa-circle-arrow-up"></i></button>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
	<script>
	!function(){const t=document.documentElement,e=document.getElementById("themeToggle"),s=e.querySelector("i"),a=document.getElementById("scrollToTop"),o=document.getElementById("progressLoader"),n=()=>{const e="dark"===t.getAttribute("data-theme");s.classList.toggle("fa-sun",e),s.classList.toggle("fa-moon",!e)};e.addEventListener("click",()=>{const e="dark"===t.getAttribute("data-theme")?"light":"dark";t.setAttribute("data-theme",e),localStorage.setItem("theme",e),document.cookie=`theme=${e};path=/;max-age=31536000;samesite=strict${"https:"===location.protocol?";secure":""}`,n()}),window.addEventListener("scroll",()=>{a.style.display=window.scrollY>300?"block":"none"}),a.addEventListener("click",t=>{t.preventDefault(),window.scrollTo({top:0,behavior:"smooth"})}),n();const r=async(t,e,s)=>{try{const s=await fetch(e,{signal:AbortSignal.timeout(4e3)});if(!s.ok)throw new Error("Network error");const a=await s.json();document.getElementById(t).textContent=a.ip}catch(e){document.getElementById(t).textContent=s}};Promise.allSettled([r("clientIPv4","https://api.ipify.org?format=json","N/A"),r("clientIPv6","https://api6.ipify.org?format=json","N/A")]),$(".network-test-form").on("submit",async function(t){t.preventDefault();const e=$(this),s=e.find("input[name=host]").val().trim();if(!s)return alert("Host or IP address required"),void e.find("input[name=host]").focus();let a=e.find("input[name=cmd]").val();const n=e.find("select[name=ipversion]");n.length&&"6"===n.val()&&(a+="6");const r=e.closest(".tab-pane").find(".output-section"),i=r.find(".output-box");r.removeClass("show"),r.find(".alert-error").hide(),i.text("Running command..."),o.classList.add("active");const d=["ping","ping6","traceroute","traceroute6","mtr","mtr6"].includes(a);try{const t=new FormData;t.append("host",s),t.append("cmd",a),t.append("csrf",e.find("input[name=csrf]").val());const n=await fetch(window.location.pathname,{method:"POST",headers:{"X-Requested-With":"XMLHttpRequest"},body:t});if(o.classList.remove("active"),403===n.status){const t=await n.text();return alert(t),void location.reload()}if(r.addClass("show"),i.text(""),d){const t=n.body.getReader(),e=new TextDecoder;for(;;){const{done:s,value:a}=await t.read();if(s)break;const o=e.decode(a,{stream:!0});i.append(document.createTextNode(o)),$("html,body").animate({scrollTop:r.offset().top-80},0)}}else{const t=await n.text();i.text(t),$("html,body").animate({scrollTop:r.offset().top-80},400)}}catch(t){o.classList.remove("active");const e=`Error: ${t.message||"Unknown error"}`;r.find(".alert-error").text(e).show(),r.addClass("show")}}),$(".reset-tab-btn").on("click",function(){const t=$(this).closest(".tab-pane");t.find("form")[0].reset(),t.find(".output-section").removeClass("show"),t.find(".alert-error").hide(),t.find(".output-box").text(""),t.find(".ajax-result-container").html("")})}(),function(){const t=t=>{const e=document.createElement("div");return e.appendChild(document.createTextNode(t)),e.innerHTML},e={A:"fa-globe",AAAA:"fa-network-wired",NS:"fa-server",MX:"fa-envelope",SOA:"fa-database",TXT:"fa-file-lines"},s=document.getElementById("progressLoader");$(".ajax-test-form").on("submit",async function(a){a.preventDefault();const o=$(this),n=o.find("input[name=host]").val().trim();if(!n)return alert("Host or domain required"),void o.find("input[name=host]").focus();const r=o.find("input[name=cmd]").val(),i=o.find("input[name=csrf]").val(),d=o.closest(".tab-pane"),c=d.find(".output-section"),l=d.find(".ajax-result-container");c.removeClass("show"),c.find(".alert-error").hide(),l.html('<div style="text-align:center;padding:2rem;color:var(--text-secondary)"><i class="fas fa-spinner fa-spin" style="font-size:1.5rem;margin-bottom:.5rem;display:block"></i>Memproses '+t("whois"===r?"WHOIS":"DNS")+" lookup untuk <strong>"+t(n)+"</strong>...</div>"),c.addClass("show"),s.classList.add("active");try{const a=new FormData;a.append("host",n),a.append("cmd",r),a.append("csrf",i);const o=await fetch(window.location.pathname,{method:"POST",headers:{"X-Requested-With":"XMLHttpRequest"},body:a});if(s.classList.remove("active"),403===o.status)return alert(await o.text()),void location.reload();if(!o.ok)return c.find(".alert-error").text(await o.text()||"Error occurred").show(),void l.html("");const d=await o.json();"whois"===r?function(e,s){let a="";e.error?s.innerHTML='<div class="alert-msg alert-error">'+t(e.error)+"</div>":(e.parsed&&e.parsed.length?(a+='<div class="whois-result-card"><div class="whois-result-header"><i class="fas fa-circle-info"></i> Informasi WHOIS untuk '+t(e.host)+'</div><table class="whois-result-table"><tbody>',e.parsed.forEach(function(e){a+='<tr><td><i class="fas '+t(e.icon)+'"></i> '+t(e.key)+'<span class="whois-info-tip"><i class="fas fa-question-circle"></i> '+t(e.info)+"</span></td><td>"+t(e.value)+"</td></tr>"}),a+='</tbody></table><button class="whois-raw-toggle" onclick="$(this).next().toggleClass(\'show\');$(this).find(\'i.fa-chevron-down,i.fa-chevron-up\').toggleClass(\'fa-chevron-down fa-chevron-up\')"><i class="fas fa-code"></i> Raw WHOIS Data <i class="fas fa-chevron-down"></i></button><pre class="whois-raw-box">'+t(e.raw||"")+"</pre></div>"):a+='<div class="whois-result-card"><div class="whois-result-header"><i class="fas fa-circle-info"></i> Raw WHOIS untuk '+t(e.host)+'</div><pre class="whois-raw-box show">'+t(e.raw||"No data returned.")+"</pre></div>",s.innerHTML=a)}(d,l[0]):"dnslookup"===r&&function(s,a){let o="";if(s.error)return void(a.innerHTML='<div class="alert-msg alert-error">'+t(s.error)+"</div>");const n=s.records||{};let r=[];["A","AAAA","NS","MX","SOA","TXT"].forEach(function(s){const a=e[s]||"fa-question",i=n[s]||[],d=i.length;r.push({type:s,count:d});const c="dns-header-"+s.toLowerCase();o+='<div class="dns-result-card"><div class="dns-type-header '+c+'"><i class="fas '+a+'"></i> '+s+' Records <span class="dns-type-badge">'+d+" record"+(1!==d?"s":"")+"</span></div>",d>0?(o+='<div class="dns-table-wrapper"><table class="dns-record-table"><thead><tr><th><i class="fas fa-hashtag"></i> Name</th><th><i class="fas fa-clock"></i> TTL</th><th><i class="fas fa-tag"></i> Type</th><th><i class="fas fa-align-left"></i> Value</th></tr></thead><tbody>',i.forEach(function(e){const s="dns-badge-"+e.type.toLowerCase();o+="<tr><td>"+t(e.name)+"</td><td>"+t(e.ttl)+'</td><td><span class="dns-badge '+s+'">'+t(e.type)+"</span></td><td>"+t(e.value)+"</td></tr>"}),o+="</tbody></table></div>"):o+='<div class="dns-no-records"><i class="fas fa-info-circle"></i> Tidak ada record '+s+" yang ditemukan</div>",o+="</div>"}),o+='<div class="dns-summary-bar">',r.forEach(function(t){o+='<span class="dns-summary-badge '+(t.count>0?"has-records":"no-records")+'"><i class="fas '+(e[t.type]||"fa-question")+'"></i> '+t.type+": "+t.count+"</span>"}),o+="</div>",a.innerHTML=o}(d,l[0]),$("html,body").animate({scrollTop:c.offset().top-80},400)}catch(t){s.classList.remove("active"),c.find(".alert-error").text("Error: "+(t.message||"Unknown error")).show(),l.html("")}})}();
	</script>
</body>
</html>