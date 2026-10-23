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
