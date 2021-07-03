<?php
if(isset($_GET['id'])){
echo password_hash($_GET['id'],PASSWORD_DEFAULT);
}
?>
<form method="GET">
<input name="id">
<input type="submit">
</form>
