<?php 

echo "Autor: " . $params['post']->getUser()->getUsername();
echo nl2br("\n");
echo "Post text: " . $params['post']->getText();
echo nl2br("\n");
echo "Likes amount: " . count($params['post']->getLikes());
echo nl2br("\n");
echo nl2br("\n");
echo "Comments to this post:";
echo nl2br("\n");
?>
<form method='post'> 
        <input type = "hidden" name = "addcomment" >
        <button class="float-left submit-button", type="submit" >Add comment</button>
</form>
<?php
foreach($params['post']->getComments() as $comment)
{
    echo $comment->getText();
    echo nl2br("\n");
} 
?>  

<form method='post'> 
            <button class="float-left submit-button", type="submit" >back</button>
        </form>