<?php

$content = new Router\Content();

if(Router\Request::getMethod() == 'get')
{
    $article = $content->read($data);
}
else if(Router\Request::getMethod() == 'post')
{
    $article = $content->create($data);
    print_r($article);
}

?>

<!DOCTYPE html>
<html>
    <h1><?php //echo $article['title']; ?></h1>
</html>