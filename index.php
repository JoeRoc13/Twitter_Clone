<?php

include('./header.php');

$db = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');

$stmt = $db->prepare("SELECT * from twitts");
$stmt->execute();

echo "</div>";

?>

<div class="container">
  <div class="col-md-6 col-md-offset-3">
    <h2 class="text-center">Recent activity</h2>
    <h3>@username</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <div>
      <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right"><button class=>Like</button></div>
    </div>
    <br>
    <textarea style="width: 100%;" placeholder="Add a comment..." name="name" rows="1" cols="153"></textarea>
    <div id="chatbox"></div>
    <hr>
    <h3>@username</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <div>
      <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right"><button class=>Like</button></div>
    </div>
    <br>
    <textarea style="width: 100%;" placeholder="Add a comment..." name="name" rows="1" cols="153"></textarea>
    <div id="chatbox"></div>
    <hr>
    <h3>@username</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <div>
      <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right"><button class=>Like</button></div>
    </div>
    <br>
    <textarea style="width: 100%;" placeholder="Add a comment..." name="name" rows="1" cols="153"></textarea>
    <div id="chatbox"></div>
    <hr>
    <h3>@username</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <div>
      <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right"><button class=>Like</button></div>
    </div>
    <br>
    <textarea style="width: 100%;" placeholder="Add a comment..." name="name" rows="1" cols="153"></textarea>
    <div id="chatbox"></div>
    <hr>
  </div>
</div>
<?php
  include("./footer.php");
?>
