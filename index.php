<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Курсовая работа</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="title">Хэштег Сортер</h1>
        </div>
    </header>
    <main class="main">
        <div class="container main__container">
            <form class="form" method="post" action="index.php">
                <label class="position" for="hashtag">Напишите свой Хэштег</label>
                <textarea class="position" name="hashtag" placeholder="#php"></textarea>
<!--                <input type="textarea">-->
<!--                <input class="position" type="text" name="hashtag" placeholder="#php">-->
                <div class="form__btns">
                    <label class="position" for="save">Save</label>
                    <input class="btn" type="checkbox" name="save" value="1">
                    <label class="position" for="like">Like</label>
                    <input class="btn" type="checkbox" name="like" value="1">
                    <label class="position" for="field">Table Field</label>
                    <select name="field" id="">
                        <?php
                            require_once 'HashtagSorter.php';

                            $object->getFieldNames();
                        ?>
                    </select>
                </div>
                <input class="submit" type="submit">
                <?php
                 echo '<h1>' . $object->getHashtagName(trim($_POST['hashtag'], '#')) . '</h1>';
                    if (!empty($_POST['hashtag'])) {
                        $pattern = '/#[0-9A-Za-zаL-яАL-ЯёЁ]+/';
                        preg_match($pattern, $_POST['hashtag'], $matches);
                        if ($object->getHashtagName(trim($matches[0], '#')) != trim($matches[0], '#')) {
                            var_dump($object->getHashtagName(trim($matches[0], '#')));
                            $object->addTable(trim($matches[0], '#'));
                        }
                    }
                ?>
            </form>
        </div>
    </main>
</body>
</html>