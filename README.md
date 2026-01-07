<h1>Product & Category Management System</h1>

<p>
A simple Product and Category Management web application built using
<strong>Core PHP</strong>, <strong>MySQL</strong>, <strong>PDO</strong>, and
<strong>Bootstrap 5</strong>.
</p>

<hr>

<h2>System Requirements</h2>

<ul>
    <li>PHP 8.0 or higher</li>
    <li>MySQL 5.7 or higher</li>
    <li>Apache / Nginx or PHP built-in server</li>
    <li>Web browser</li>
</ul>

<hr>

<h2>Project Setup Instructions</h2>

<h3>1. Clone the Repository</h3>

<pre><code>git clone https://github.com/arjun0008/Product-Category-Management-php-.git</code></pre>

<p>Move the project folder into your web server root:</p>

<ul>
    <li><strong>XAMPP:</strong> htdocs/</li>
    <li><strong>WAMP:</strong> www/</li>
    <li><strong>LAMP:</strong> /var/www/html/</li>
</ul>

<hr>

<h3>2. Create the Database</h3>

<p>
Import the provided <code>db.sql</code> file using
<strong>phpMyAdmin</strong> or <strong> MySQL CLI </strong>.
</p>
<h4>Option A: Using MYSQL CLI</h4>
<strong> Import Database (MySQL CLI)</strong>

<pre><code>mysql -u root -p &lt; db.sql</code></pre>
<hr>
<h4>Option B: Using PhpMyAdmin</h4>

<p> import the file using phpMyAdmin.</p>

<hr>

<h3>4. Configure Database Connection</h3>

<p>Edit the file:</p>

<pre><code>config/database.php</code></pre>

<p>Update credentials if required:</p>

<pre><code>$host = "localhost";
$db   = "pcm";
$user = "root";
$pass = "";</code></pre>

<hr>

<h3>5. Run the Application</h3>

<h4>Option A: Apache / XAMPP</h4>

<p>Start Apache and MySQL, then open:</p>

<pre><code>http://localhost/pcm/public/index.php</code></pre>

<hr>

<h4>Option B: PHP Built-in Server</h4>

<p>From the project root:</p>

<pre><code>php -S localhost:8000 -t public</code></pre>

<p>Then open:</p>

<pre><code>http://localhost:8000</code></pre>

<hr>

<h3>6. Default Admin Login</h3>

<ul>
    <li><strong>Username:</strong> admin</li>
    <li><strong>Password:</strong> admin</li>
</ul>

<p>
(Default credentials are for development/demo purposes only.)
</p>

<hr>

<h2>Setup Complete</h2>

<p>
The application is now ready to use.
</p>
