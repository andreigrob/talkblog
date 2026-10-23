Patch #1: Prepared statements for login.php (A05 Injection SQL)
Replaces string concatenation with a prepared statement in login.php. Fixes Lab 4 Finding #1.

Patch #2: Strip HTML tags from topic and comment texts (A05 Injection Cross Site Scripting)
Replaces the topic and comment texts with versions that have most HTML tags stripped out. Fixes Lab 4 Finding #2.

