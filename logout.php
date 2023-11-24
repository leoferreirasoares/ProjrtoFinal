<?php
session_start();
session_unset();
session_destroy();
?> 
<script language='javascript'>
window.location = 'index.php';
</script>
<?php
