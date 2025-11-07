<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Branch Directory System</title>
<style>
  
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: radial-gradient(circle at top, #1a001a, #0a0a0a);
        color: #f5f5f5;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

   
    header {
        text-align: center;
        margin-bottom: 40px;
    }
    header h1 {
        font-size: 2.3em;
        color: #b135f0;
        text-shadow: 0 0 20px rgba(177, 53, 240, 0.6);
        margin-bottom: 10px;
    }
    header p {
        font-size: 1rem;
        color: #bbb;
        letter-spacing: 1px;
    }

    
    .menu {
        background: rgba(25, 25, 25, 0.95);
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 0 20px rgba(177, 53, 240, 0.3);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        width: 90%;
        max-width: 550px;
        text-align: center;
    }

    .menu a {
        display: inline-block;
        padding: 12px;
        color: #fff;
        background: linear-gradient(135deg, #b135f0, #ff1e1e);
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        letter-spacing: 0.5px;
        transition: all 0.25s ease;
    }

    .menu a:hover {
        transform: scale(1.07);
        background: linear-gradient(135deg, #ff1e1e, #b135f0);
        box-shadow: 0 0 15px rgba(255, 30, 30, 0.5);
    }

   
    footer {
        margin-top: 50px;
        font-size: 0.85em;
        color: #777;
    }
</style>
</head>
<body>

<header>
    <h1>Student Branch Directory</h1>
    <p>Manage and organize student records efficiently</p>
</header>

<div class="menu">
    <a href="create.php"> Add Student</a>
    <a href="read.php"> View Students</a>
    <a href="read.php"> Update Record</a>
    <a href="read.php"> Delete Record</a>
</div>

<footer>
    &copy; <?= date('Y'); ?> Rol. Co 
</footer>

</body>
</html>
