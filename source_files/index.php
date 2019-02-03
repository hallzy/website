<?php
// We are trying to upload the resume
if (isset($_POST['upload_resume_key'])) {
  // Curl request to upload resume
  // curl -X POST -F 'upload_resume_key=<KEY>' -F 'file=@<path to pdf>'
  // https://stmhall.ca

  // If we are trying to upload resume and the key is correct then attempt
  $expectedKey = file_get_contents('/home/stmhallc/upload_key.txt');

  if ($expectedKey === FALSE) {
    echo "Upload Key not found on server\n";
    die();
  }

  // If we are trying to upload resume but the key is wrong
  if ($_POST['upload_resume_key'] !== $expectedKey) {
    echo "Auth Failed\n";
    die();
  }

  // Check if the POSTed key is the expected key
  $target = '/home/stmhallc/public_html/Steven Hall Resume.pdf';
  if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    echo "Successfully Uploaded Resume\n";
  } else {
    echo "Failed to upload resume\n";
  }
  die();
}

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
    <?= dumpHeaderBody(basename(__FILE__)); ?>
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
