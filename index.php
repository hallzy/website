<?php

$jsonStr = file_get_contents("data.json");
$data = json_decode($jsonStr);

function lists2html(array $arr) : string {
    $html = '';
    foreach($arr as $item) {
        if (is_array($item)) {
            $value = array_shift($item);

            $innerHTML = lists2html($item);
            $html .= "
                <li>
                    $value
                    <ul>
                        $innerHTML
                    </ul>
                </li>
            ";
        } else {
            $html .= "<li>$item</li>";
        }
    }
    return $html;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data->pageTitle ?></title>
    <link rel='stylesheet' href='./style.css'>
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
            <?php foreach($section->entries as $entry): ?>
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
                            <?= lists2html($entry->description) ?>

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
