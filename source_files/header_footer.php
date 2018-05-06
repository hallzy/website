<?php

// Dump the head of the page which just includes all the CSS
function dumpHead() {
  $html = "";
  $html .= "<link rel='stylesheet' href='shift.css'>\n";
  $html .= "    <link rel='stylesheet' href='bootstrap.css'>\n";
  $html .= "    <link rel='stylesheet' href='common.css'>\n";
  return $html;
}

// Dump the navigation bar at the top of each page
function dumpHeaderBody() {
  $linkedInURL     = "https://www.linkedin.com/in/steven-hall-7067a9111";
  $githubResumeURL = "https://hallzy.github.io/GhResume/?hallzy";
  $githubURL       = "https://github.com/hallzy";
  $resumeFile      = "Steven Hall Resume.pdf";

  $blankTarget = "' target='_blank";

  $navigationBarArr = array(
    '127.0.0.1 (Home)'            => 'index.php',
    'About Me'                    => 'aboutme.php',
    'Resume'                      => $resumeFile . $blankTarget,
    'References'                  => 'references.php',
    'Projects'                    => 'projects.php',
    'GitHub'                      => $githubURL . $blankTarget,
    'LinkedIn'                    => $linkedInURL . $blankTarget,
    'GitHub Resume'               => $githubResumeURL . $blankTarget,
    'Pick a Part Database'        => 'pickapart.php' . $blankTarget,
    'Vacation Schedule Generator' => 'vacation.html' . $blankTarget
  );

  $html = "";
  $html .= "<div class='nav'>\n";
  $html .= "      <div class='container'>\n";
  $html .= "        <ul class='pull-left'>\n";

  foreach($navigationBarArr as $string => $link) {
    $html .= "          <li><a href='" . $link . "'>" . $string . "</a></li>\n";
  }

  $html .= "        </ul>\n";
  $html .= "      </div>\n";
  $html .= "    </div>\n";


  return $html;
}

// Dump the Footer for each page
function dumpFooterBody() {
  $myMailTo = 'mailto:steven@stmhall.ca';
  $myEmail = 'steven@stmhall.ca';

  $arnoldDescription = "Arnold Fernandes is my most recent employer. I worked";
  $arnoldDescription .= " for him at ByteCom, a computer repair shop.";

  $arnoldDescription2 = "For more information about how I know Arnold";
  $arnoldDescription2 .= " Fernandes, visit the references page:";

  $arnoldMailTo = 'mailto:bytecom@live.com';
  $arnoldEmail = 'bytecom@live.com';

  $html = "";
  $html .= "<div class='learn-more'>\n";
  $html .= "      <div class='container'>\n";
  $html .= "        <div class='row'>\n";
  $html .= "          <div class='col-md-4'>\n";
  $html .= "            <h3>Contact Information For Steven Hall</h3>\n";
  $html .= "            <p>I can be reached by email at:</p>\n";
  $html .= "            <p><a href='" . $myMailTo ."'>";
  $html .= $myEmail . "</a></p>\n";
  $html .= "          </div>\n";
  $html .= "          <div class='col-md-4'>\n";
  $html .= "            <h3>&nbsp;</h3>\n";
  $html .= "            <h4>Arnold Fernandes</h4>\n";
  $html .= "            <p>" . $arnoldDescription . "</p>\n";
  $html .= "            <p>" . $arnoldDescription2 . "</p>\n";
  $html .= "            <p><a href='references.php'>References</a></p>\n";
  $html .= "            <p>\n";
  $html .= "              <em>Contact Information:</em><br>\n";
  $html .= "              <a href='" . $arnoldMailTo . "'>" . $arnoldEmail;
  $html .= "</a><br>\n";
  $html .= "            </p>\n";
  $html .= "          </div>\n";
  $html .= "        </div>\n";
  $html .= "      </div>\n";
  $html .= "    </div>\n";

  return $html;
}

?>
