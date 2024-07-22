<form name="feedback" method="post">
    <label>Write comment: 
        <input type="text" name="comment">
        <input type="hidden" name="Id" value=<?php echo $params['postId']; ?>>
    </label>
    <button type="submit" name="send" value="enter">Add comment</button>
</form>

<form method='post'> 
        <input type = "hidden" name = "commentback" >
        <button class="float-left submit-button", type="submit" >Back</button>
</form>