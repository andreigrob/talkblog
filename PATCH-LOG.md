Patch #1: Prepared statements for login.php (A05 Injection SQL)
Replaces string concatenation with a prepared statement in login.php. Fixes Lab 4 Finding #1.

Patch #2: Strip HTML tags from topic and comment texts (A05 Injection Cross Site Scripting)
Replaces the topic and comment texts with versions that have most HTML tags stripped out in topic.php. Fixes Lab 4 Finding #2.

Patch #3: Profile page only displays form for current user and only accepts post requests for current user (A01 Broken Access Control Insecure Direct Object Reference)
The profile.php script checks if the current user is the same as the profile being viewed and only displays the form for editing the profile if they are the same. It also only accepts post requests for updating the profile if the current user is the same as the profile being viewed. Fixes Lab 4 Finding #3.

Patch #4: Fetch image only accepts valid URLs (A01 Broken Access Control Server Side Request Forgery)
The fetch_image.php script now checks if the provided URL is valid before attempting to fetch the image. Fixes Lab 4 Finding #4.

Patch #5: Search page displays a simple error message in production (A10 Mishandling of Exceptional Conditions)
The search.php script now displays a simple error message in production instead of the SQL error message. Fixes Lab 4 Finding #5.

Patch #6: Content Security Policy findings fixed without 'unsafe-inline' (A02 Security Misconfiguration)
Browsed every page while logged in with the DevTools Console open. The only CSP violation was the inline onclick="return confirm(...)" on the Delete topic link in topic.php (script-src-attr), reported on every topic page. It was replaced with a data-confirm attribute handled by a new external script, public/assets/app.js, loaded from render_footer(). Bootstrap 5.3.3 CSS and JS are now self-hosted in public/assets/vendor/bootstrap/ (checked against the official SRI hashes) instead of loaded from cdn.jsdelivr.net, so script-src and style-src are now just 'self'. Also added autocomplete attributes to the login and register inputs to clear the console's DOM warnings. After the changes every page loads with a clean console and zero CSP reports.

Patch #7: API CORS restricted to an exact origin allowlist (A01 Broken Access Control)
src/api/cors.php previously reflected any Origin header back in Access-Control-Allow-Origin with Access-Control-Allow-Credentials: true, so any website (including the null origin) could read a logged-in user's API data. api_cors() now uses an explicit allowlist containing only http://localhost:5173, matched with a strict exact comparison (in_array(..., true)); the null origin is always rejected. CORS headers, and the preflight Allow-Methods/Allow-Headers, are sent only to the allowed origin; any other origin gets no Access-Control-* headers. Every API response now carries Vary: Origin. DevTalk's own pages are same-origin and need no CORS.
