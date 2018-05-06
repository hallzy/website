<?php
  require_once("header_footer.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Home - Steven Hall</title>
    <?= dumpHead(); ?>
  </head>
  <body>
    <?= dumpHeaderBody(); ?>
    <div class="jumbotron">
      <div class="container">
        <h1>Steven Hall</h1>
        <p>Junior PHP Developer at LinuxMagic Inc.</p>
      </div>
    </div>
    <div class="extraText">
        <div class="container">
            <h2><a href="projects.php" target="_blank">Projects</a></h2>
            <ul>
              <li>Electromagnetically Tethered Robot</li>
              <li>Dining Philosophers Problem (Multithreading)</li>
              <li>See Github for others</li>
            </ul>
            <h2>Interests</h2>
            <ul>
              <li>Encryption - I use openPGP (public key encryption) with the
                  RSA encryption algorithm for signing and encrypting emails and
                  files. My public key can be found
                  <a href="757DAC481DBC48368ECCC5EE13D1B282D9F17F17.asc">here</a>
              </li>
              <li>Computer Security - I try and stay as up to date on computer
                  security topics as possible by following sites like
                  <a href="http://thehackernews.com/" target="_blank">The Hacker
                    News</a> and <a href="http://www.securityweek.com/"
                    target="_blank">Security Week</a>.
              </li>
              <li>Programming</li>
              <li>Skiing/ Snowboarding</li>
              <li>Baseball</li>
              <li>Fixing Computers</li>
            </ul>
        </div>
    </div>
    <?= dumpFooterBody(); ?>
  </body>
</html>
