<?php
session_start();
session_destroy();
echo "<p>Du hast dich erfolgreich abgemeldet.</p>";
echo "<p><a href='/index.php'>Zurück</a></p>";
?>
