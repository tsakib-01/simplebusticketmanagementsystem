<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>About Us</h1>
        <nav>
            <a href="#mission">Our Mission</a> |
            <a href="#team">Our Team</a> |
            <a href="#contact">Contact Us</a>
        </nav>
    </header>

    <main>
        <section id="mission">
            <h2>Our Mission</h2>
            <p>It is very clear that we want to represenat the basic use of Php and Mysql, in creating a beautiful design and robustic easy to use navigate for users and giving a seamless experience that enhances user engagement. </p>
        </section>

        <section id="team">
            <h2>Our Team</h2>
            <div class="team-member">
            
                <h3>Tasnim Sakib</h3>
                <p>Frontend Developer</p>
            </div>
            <div class="team-member">
                <h3>MD. Zakir Hossan</h3>
                <p>Backend Developer</p>
            </div>
        </section>
    </main>

      
    <footer style="background-color: black; color:white;">
        <p>
                        <i class="far fa-copyright"></i> <?php echo date('Y');?> - Simple Bus Ticket Management System
                        </p>
        </footer>




    

<style>
  /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic styling */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1em 0;
}

header h1 {
    margin: 0;
    font-size: 2em;
}

nav {
    margin-top: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
}

main {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
}

section {
    margin-bottom: 30px;
}

section h2 {
    color: #333;
    font-size: 1.8em;
    margin-bottom: 10px;
}

section p {
    color: #666;
}

.team-member {
    text-align: center;
    margin-bottom: 20px;
}

.team-member img {
    width: 150px;
    border-radius: 50%;
    margin-bottom: 10px;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

  </style>
</body>
</html>

