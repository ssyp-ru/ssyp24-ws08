
<html>

<form method='post'> 
        <input type = "hidden" name = "addpost" >
        <button class="float-left submit-button", type="submit" >Add post</button>
</form>

<?php foreach($params['posts'] as $post):
{
    if ($post->getPost() === null)
    {
        echo "Autor: " . $post->getUser()->getUsername();
        echo nl2br("\n");
        echo "Post text: " . $post->getText();
        echo nl2br("\n");
        echo "Likes amount: " . count($post->getLikes());
        echo nl2br("\n");
        
        ?>
        <form method='post'> 
            <input type = "hidden" name = "LikedPostId" value = <?php echo $post->getId() ?>>
            <button class="float-left submit-button", type="submit" > 	&#9829</button>
        </form>
        <form method='post'> 
            <input type = "hidden" name = "id" value = <?php echo $post->getId() ?>>
            <button class="float-left submit-button", type="submit" >show more</button>
        </form>
        <?php
        echo nl2br("\n");
        echo nl2br("\n");
        ?>
        <form action="https://localhost/home"> 
            <!-- <input type = "hidden" name = "id" value = <?php echo $post->getId() ?>> -->
            <button class="float-left submit-button", type="submit" >Back</button>
        </form> <?php
    }
}   
endforeach?>
<?php
if($params['countAll']<=$params['pageNumber']*5)
{
    
}
else{ 
    ?>
    <form method='post'> 
        <input type = "hidden" name = "pg" value = <?php echo $params['pageNumber'] +1; ?>>
        <button class="float-left submit-button", type="submit" >next page</button>
    </form>
    <?php
}

if ($params['pageNumber']> 1)
{
    ?>
    <form method='post'> 
        <input type = "hidden" name = "pg" value = <?php echo $params['pageNumber'] -1; ?>>
        <button class="float-left submit-button", type="submit" >previous page</button>
    </form>
    <?php
}

?>
</html>