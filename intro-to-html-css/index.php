<?PHP
   include_once ('config/database.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>camagru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>

    <div class="main-nav">
        <ul class="nav">
          <li class="name">CAMAGRU</li>
          <li><a href="login.php">Login</a></li>
          <li><a href="registration/registration.php">Register</a></li>
          <li><a href="snap.php">Snap</a></li>
          <li><a href="#">Gallery</a></li>
        </ul>
    </div>

    <header>
		 <img src="images/placeholder.png" id="profile-image" width= "200" height="200">
      <h1 class="tag name">Welcome, Vuyo!.</h1>
      <p class="tag location">Johannesburg</p>
    </header>

    <main class="flex">
      <div class="card">
        <h2>About The Picture</h2>
        <p>I’ve been a professional cook  and am a life-long learner who's always interested in expanding my skills and I love taking pictures</p>
      </div> 

      <div class="card">
        <h2>Comments</h2>
        <p>I want to master the process of building web sites and increase my knowledge, skills and abilities in:</p>
        <ul class="skills">
          <li>Like</li>
          <li>Dislike</li>
          <li>Super Like</li>
        </ul>
      </div>

    </main>
  <footer>
      <p class="copyright">Copyright 2018, Vuyo Mhlotshane</p>
    </footer>

  </body>
  </html>
