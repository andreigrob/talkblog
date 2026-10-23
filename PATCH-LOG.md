Patch #1: Prepared statements for login.php (A05 Injection SQL)
Replaces string concatenation with a prepared statement in login.php. Fixes Lab 4 Finding #1.

Patch #2: Strip HTML tags from topic and comment texts (A05 Injection Cross Site Scripting)
Replaces the topic and comment texts with versions that have most HTML tags stripped out. Fixes Lab 4 Finding #2.

Patch #3: Profile page only displays form for current user and only accepts post requests for current user (A01 Broken Access Control Insecure Direct Object Reference)
Ensures that the profile page only displays the form for the current user and only accepts post requests for the current user. Fixes Lab 4 Finding #3.

