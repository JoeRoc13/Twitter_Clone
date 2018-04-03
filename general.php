<?php

include('./header.php');

echo "<div class='container'>";
/*
  Query 1
 */
$stmt = $db->prepare("SELECT body
                      FROM twitts
                      WHERE tid =
                        (SELECT MAX(tid)
                         AS most_liked
                         FROM
                          (SELECT tid, COUNT(tid) mycount
                           FROM thumb
                           GROUP BY tid) t)");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<b>1. Find the post that has the most number of likes:</b> <br  />" . $row["body"];

echo "<br />";
echo "<br />";

/*
  Query 2
 */
$stmt = $db->prepare("SELECT username
                      FROM user
                      WHERE uid =
                        (SELECT following_id
                         FROM follow
                         GROUP BY following_id
                         ORDER BY count(*)
                         DESC LIMIT 1)");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<b>2. Find the person who has the most number of followers:</b> <br  />" . $row["username"];

echo "<br />";
echo "<br />";

/*
  Query 3
 */
$stmt = $db->prepare("SELECT user.username, user.location, twitts.body
                      FROM user, twitts
                      WHERE user.uid = twitts.uid
                      AND (twitts.body
                      LIKE '% flu %'
                      OR twitts.body LIKE 'flu %'
                      OR twitts.body LIKE '% flu'
                      OR twitts.body = 'flu')
                      ORDER BY user.location");
$stmt->execute();
echo "<b>3. Count the number of posts that contains the keyword “flu”, display the location of the users who have made the posts as well (use “GROUP BY location”):</b> <br  />";
$count = 0;
echo "<table class='table table-striped'>
        <thead>
          <th>Username</td>
          <th>Body</td>
          <th>Location</td>
        </thead>";
// Echo out results as a table
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>" . $row["username"] . "</td><td>" . $row["body"] . "</td><td>" . $row["location"] . '</td></tr>';
  $count++;
}
echo "</table>";
echo "Count: " . $count;

echo "<br />";
echo "<br />";

/*
  Query 4
 */
echo "<b>4. User input a person’s twitter name, find all the posts made by that person:</b> <br  />";
echo '<div class="row">
        <div class="col-md-6">
          <form action="general.php" method="post">
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="username" class="form-control" placeholder="Enter a username">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Go!</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>';

// Check if $_POST["username"] exists, if it does, continue executing the following queries
if(isset($_POST["username"])) {
  $stmt = $db->prepare("SELECT uid
                        FROM user
                        WHERE username = '" .$_POST["username"] . "'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $uid = $row["uid"];

  $stmt = $db->prepare("SELECT body
                        FROM twitts
                        WHERE uid = '" . $uid . "'");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row["body"] . "<br  />";
  }
}

echo "<br />";

/*
  Query 5
 */
echo "<b>5. User input a year, find the person who twits the most in that year:</b> <br  />";
echo '<div class="row">
        <div class="col-md-6">
          <form action="general.php" method="post">
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="year" class="form-control" placeholder="Enter a year">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Go!</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>';

// Check to see if $_POST["year"] exists, if it does, execute query. Display each username on a new line
if(isset($_POST["year"])) {
 $year = $_POST["year"];
 $stmt = $db->prepare("SELECT username
                      FROM user
                      WHERE uid =
                        (SELECT uid
                         FROM twitts
                         GROUP BY uid
                         ORDER BY count(*)
                         DESC LIMIT 1)
                      AND uid IN
                        (SELECT uid
                         FROM twitts
                         WHERE post_time >= '" . $year . "-01-01'
                         AND post_time < '" . $year . "-12-31')");
 $stmt->execute();
 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   echo $row["username"] . "<br  />";
 }
}

echo "<br />";
echo "<br />";

echo "</div>";

?>
