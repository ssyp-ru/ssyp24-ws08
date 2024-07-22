<?php
echo($params['user']->getUsername());
echo nl2br("\n");
echo($params['user']->getEmail());
?>

<form method="post">
	<button type="submit" value="Edit">Edit</button>
</form>
<form action="https://localhost/home">
	<button type="submit" value="Back">Back</button>
</form>