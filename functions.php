<?php
function pdo_connect_mysql()
{
  // Update the details below with your MySQL details
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'shoppingcart';
  try {
    return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
  } catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
  }
}
// Template header, feel free to customize this
function template_header($title)
{
  // Get the amount of items in the shopping cart, this will be displayed in the header.
  $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
  echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="apple-touch-icon" sizes="180x180" href="imgs/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon-16x16.png">
    <link rel="manifest" href="imgs/site.webmanifest">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Gadgets Pedia</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    
                </nav>
                <div class="link-icons">
                <a href="phplogin/index.php">Login</a>
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
            <span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer()
{
  $year = date('Y');
  echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Gadgets Pedia</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}

//Admin template header
function admin_template_header($title)
{
  echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../imgs/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../imgs/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../imgs/favicon-16x16.png">
    <link rel="manifest" href="../imgs/site.webmanifest">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Administration Panel</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                  <a href="../phplogin/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}

function admin_template_footer()
{
  $year = date('Y');
  echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Gadgets Pedia</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
