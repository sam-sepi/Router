<?php

$content = new Router\Content();

$article = $content->read($data);

?>

<!DOCTYPE html>
<html>
    <h1><?php echo $article['title']; ?></h1>
</html>