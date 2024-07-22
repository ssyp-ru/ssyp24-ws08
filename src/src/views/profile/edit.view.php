
<form name="feedback" method="post">
	<label>change username: <input type="text" name="name" value=<?php echo $params['username']?>></label>
	<button type="submit" name="send" value="enter">Enter</button>
</form>

<form name="feedback" method="post">
	<label>change password: <input type="text" name="password"></label>
	<button type="submit" name="send" value="enter">Enter</button>
</form>

<form name="feedback" method="post">
	<label>change email: <input type="text" name="email" value=<?php echo $params['email']?>></label>
	<button type="submit" name="send" value="enter">Enter</button>
</form>

<form method="post">
    <input type="hidden" name="back">
	<button type="submit" value="Edit">Back to profile</button>
</form>