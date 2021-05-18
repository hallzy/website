<?php

$jsonStr = file_get_contents("data.json");
$data = json_decode($jsonStr);

$mtime = filemtime('./style.css');
if ($mtime === false) {
    $mtime = 0;
}

// $className is used as a hack for CSS selector so that I an force a page break
// in a sensible place, because chrome thinks it is a good idea to break right
// in the middle of a line of text.
function lists2html($className, array $arr) : string {
    $html = '';
    foreach($arr as $idx => $item) {
        if (is_array($item)) {
            $value = array_shift($item);

            $innerHTML = lists2html("$className-$idx", $item);
            $html .= "
                <li class='${className}-$idx'>
                    $value
                    <ul>
                        $innerHTML
                    </ul>
                </li>
            ";
        } else {
            $html .= "<li class='${className}-$idx'>$item</li>";
        }
    }
    return $html;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?= $data->pageTitle ?></title>
    <link rel='stylesheet' href='./style.css?v=<?= $mtime ?>'>
</head>
    <body>
        <div class='header'>
        <span class='firstName'><?= $data->firstName ?></span><span class='lastName'><?= $data->lastName ?></span>
        <div class='position'><?= $data->position ?></div>
        </div>
        <div class='content'>
            <div class='sidebar'>
                <div class='contact'>
                    <div class='title'>Contact</div>
                    <ul>
                    <?php foreach($data->contactInfo as $contactInfo): ?>
                        <li>
                            <a class='img-container' href='<?= $contactInfo->href ?>'><img src='<?= $contactInfo->imgSrc ?>'><?= $contactInfo->text ?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div class='title'>Languages</div>
                    <ul>
                    <?php foreach($data->languages as $language): ?>
                        <li><?= $language ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div class='title'>Programs</div>
                    <ul>
                    <?php foreach($data->programs as $program): ?>
                        <li><?= $program ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php foreach($data->sections as $className => $section): ?>
            <div class='section <?= $className ?>'>
            <div class='heading'><span class='colour'><?= substr($section->title, 0, 3) ?></span><?= substr($section->title, 3) ?></div>
            <?php foreach($section->entries as $idx => $entry): ?>
                <div class='entry'>
                    <div class='title img-container'>

                    <?php if ($entry->imgSrc): ?>
                        <img src='<?= $entry->imgSrc ?>'>
                    <?php endif; ?>

                    <?php if ($entry->boldTitle): ?>
                        <span class='heavy'><?= $entry->boldTitle ?></span>
                    <?php endif; ?>

                    <?php if ($entry->normalTitle): ?>
                        <span><?= $entry->normalTitle ?></span>
                    <?php endif; ?>

                    </div>

                <?php if ($entry->timePeriod): ?>
                    <div class='timePeriod'><?= $entry->timePeriod ?></div>
                <?php endif; ?>

                    <div class='description'>
                        <ul>
                            <?= lists2html("$className-$idx", $entry->description) ?>

                        <?php if ($entry->skills): ?>
                            <li><strong>Skills:</strong> <?= implode(', ', $entry->skills) ?></li>
                        <?php endif; ?>

                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        </div>
    </body>
</html>
