<?php

function array_some(array $array, callable $fn) {
    foreach ($array as $value) {
        if($fn($value)) {
            return true;
        }
    }
    return false;
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}

$publicIP = get_client_ip();
$json     = file_get_contents("http://ipinfo.io/$publicIP/geo");
$json     = json_decode($json, true);

$country  = $_GET['force'] ?? $json['country'];
$region   = $json['region'];
$city     = $json['city'];
$postal     = $json['postal'];
$forced = isset($_GET['force']);

$ua = $_SERVER['HTTP_USER_AGENT'] ?? 'N/A';
$httpReferer = $_SERVER['HTTP_REFERER'] ?? 'No HTTP Referer';

$customReferers = [
    'ig'  => "My Instagram Profile",
    'gh'  => "My GitHub Profile",
    'ghw' => "My Website Repo on GitHub",
    'li'  => "My LinkedIn Profile",
];

$customRefererIdx = $_GET['referer'] ?? $_GET['r'] ?? 'No Custom Referer';
$customReferer = $customReferers[$customRefererIdx] ?? $customRefererIdx;

$ignoreUA = [
    "bot",
    "scan",
    "a simple request",
];

$goodUA = !array_some(
    $ignoreUA,
    function($keyword) use ($ua) {
        return strpos($ua, $keyword) !== false;
    }
);

$date = getdate();

$year = $date['year'];
$month = str_pad($date['mon'], 2, "0", STR_PAD_LEFT);
$day = str_pad($date['mday'], 2, "0", STR_PAD_LEFT);
$hour = $date['hours'];
$min = str_pad($date['minutes'], 2, "0", STR_PAD_LEFT);
$sec = str_pad($date['seconds'], 2, "0", STR_PAD_LEFT);

switch($country) {
    case 'RU':
        if (!$forced) {
            file_put_contents('russian_accesses.txt', "{$year}/{$month}/{$day} {$hour}:{$min}:{$sec} UTC -- {$publicIP} -- {$ua}\n", FILE_APPEND);
        }

        // Feb 24
        http_response_code(224);
        die("
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <title>🇺🇦 Slava Ukraini! Heroiam Slava! 🇺🇦</title>
                <style>
                    body
                    {
                        text-align: center;
                        margin-top: 30vh;
                        font-size: 30px;
                        color: yellow;
                        background-color: #034f9a;
                    }

                    .putin
                    {
                        color: tomato;
                    }
                </style>
            </head>
            <body>
                <h1>🇺🇦 Slava Ukraini! 🇺🇦</h1>
                <h1>🇺🇦 Heroiam Slava! 🇺🇦</h1>
                <h1 class='putin'>Fuck Putin!</h1>
            </body>
        ");
        break;
    default:
        if (!$forced && $goodUA) {
            file_put_contents('website_accesses.txt', "{$year}/{$month}/{$day} {$hour}:{$min}:{$sec} UTC -- {$publicIP} -- {$httpReferer} -- {$customReferer} -- {$city} -- {$region} -- {$country} -- {$postal} -- {$ua}\n", FILE_APPEND);
        }
        break;
}

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
                    <div class='title'>Languages &amp; Frameworks</div>
                    <ul>
                    <?php foreach($data->languages as $language): ?>
                        <li><?= $language ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div class='title'>Tools</div>
                    <ul>
                    <?php foreach($data->tools as $tool): ?>
                        <li><?= $tool ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div class='title'>Soft Skills</div>
                    <ul>
                    <?php foreach($data->skills as $skill): ?>
                        <li><?= $skill ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php foreach($data->sections as $className => $section): ?>
            <div class='section <?= $className ?>'>
            <div class='heading'><span class='colour'><?= substr($section->title, 0, 3) ?></span><?= substr($section->title, 3) ?></div>
            <?php foreach($section->entries as $idx => $entry): ?>
                <div class='entry <?= $entry->entryClasses ?? "" ?>'>
                    <div class='title img-container'>

                    <?php if ($entry->imgSrc): ?>
                        <img src='<?= $entry->imgSrc ?>'>
                    <?php endif; ?>

                    <?php if ($entry->boldTitle): ?>
                        <?php if ($entry->link): ?>
                            <a href="<?= $entry->link ?>" target="_blank">
                        <?php endif; ?>
                        <span class='heavy'><?= $entry->boldTitle ?></span>
                        <?php if ($entry->link): ?>
                            </a>
                        <?php endif; ?>
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
