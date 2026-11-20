<?php
/**
 * DevTalk API extension — Cross-Origin Resource Sharing (CORS) policy.
 *
 * Called once, at the top of public/api/index.php, before any route runs.
 *
 * DevTalk's own pages (including messages.php) are on the same origin as the
 * API and need no CORS. The only other origin allowed to read API responses
 * is the product team's planned front end at http://localhost:5173.
 *
 * Previously this function reflected ANY Origin back with credentials, letting
 * every website (and the "null" origin) read a logged-in user's API data.
 * Fixed for Lab 8, Part A.
 */

/** Origins allowed to read API responses cross-origin. Exact matches only. */
const API_CORS_ALLOWED_ORIGINS = [
    'http://localhost:5173',
];

function api_cors(): void
{
    // Responses differ by Origin, so every API response tells caches to key
    // on it; a cache must never serve one origin's CORS headers to another.
    header('Vary: Origin', false);

    $origin = $_SERVER['HTTP_ORIGIN'] ?? null;

    // Exact, type-strict string match against the allowlist (no substring,
    // suffix or regex matching). The "null" origin (sandboxed iframes, file://,
    // some redirects) is never allowed, even if someone adds it to the list.
    $allowed = is_string($origin)
        && $origin !== 'null'
        && in_array($origin, API_CORS_ALLOWED_ORIGINS, true);

    if ($allowed) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Credentials: true');
    }

    // Answer CORS preflight requests (sent by the browser before a PATCH,
    // a JSON POST, or any request with an Authorization header). Only an
    // allowed origin is told which methods and headers it may use; any other
    // origin gets a bare 204 with no Access-Control-* headers, so the browser
    // refuses to send the real request.
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        if ($allowed) {
            header('Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization');
            header('Access-Control-Max-Age: 600');
        }
        http_response_code(204);
        exit;
    }
}
