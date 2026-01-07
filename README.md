<h1>Product & Category Management System</h1>

<p>
A simple Product and Category Management web application built using
<strong>Core PHP</strong>, <strong>MySQL</strong>, <strong>PDO</strong>, and
<strong>Bootstrap 5</strong>.
</p>

<hr>

<h2>Requirements</h2>

<ul>
    <li>PHP 8.0 or higher</li>
    <li>MySQL 5.7 or higher</li>
    <li>Apache server (XAMPP / WAMP / LAMP)</li>
    <li>Web browser</li>
</ul>

<hr>

<h2>Project Setup Instructions</h2>

<h3>1. Clone the Repository</h3>

<pre><code>git clone https://github.com/your-username/product-manager.git</code></pre>

<p>Move the project folder into your web server root:</p>

<ul>
    <li><strong>XAMPP:</strong> htdocs/</li>
    <li><strong>WAMP:</strong> www/</li>
    <li><strong>LAMP:</strong> /var/www/html/</li>
</ul>

<hr>

<h3>2. Create the Database</h3>

<hr>

<h3>3. Configure Database Connection</h3>

<p>Edit the file:</p>

<pre><code>config/database.php</code></pre>

<p>Update credentials if required:</p>

<pre><code>$host = "localhost";
$db   = "product_manager";
$user = "root";
$pass = "";</code></pre>

<hr>

<h3>4. Create Admin User</h3>

<p>Create a temporary file named <code>create_admin.php</code> in the project root:</p>

<pre><code>&lt;?php
require 'config/database.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

echo "Admin user created";
</code></pre>

<p>Open the file once in the browser, then <strong>DELETE the file</strong>.</p>

<hr>

<h3>5. Run the Application</h3>

<p>Start Apache and MySQL.</p>

<p>Open your browser and visit:</p>

<pre><code>http://localhost/product-manager/public/index.php</code></pre>

<h4>Login Credentials</h4>

<ul>
    <li><strong>Username:</strong> admin</li>
    <li><strong>Password:</strong> admin123</li>
</ul>

<hr>

<h3>6. Security Notes</h3>

<ul>
    <li>All database queries use PDO prepared statements</li>
    <li>CSRF protection enabled for all POST actions</li>
    <li>XSS protection using output escaping</li>
    <li>Session-based authentication</li>
</ul>

<hr>

<h2>Done</h2>

<p>
The application is now ready to use.
</p>
