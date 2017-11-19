<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    $form_token = md5(uniqid('auth, true'));
    $_SESSION['form_token'] = $form_token;
?>

<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        
        <link rel="stylesheet" type="text/css" href="stylesheets/reset.css" title="Variant Duo"  />
        <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" title="Variant Duo" />
    </head>
    <body>
        
         <div id="wrap">
             
             <h1><a href="index.html">Tasty Recipes</a></h1>
                <p class="slogan">En webbsida med dina favoritrecept</p>

                <div id="menu">

                        <p class="menulinks">
                        <strong class="hide">Huvudmeny:</strong>
                        <a class="menulink " href="index.html">Hem</a><span class="hide"> | </span>
                        <a class="menulink" href="pannkakor.html">Pannkakor</a><span class="hide"> | </span>
                        <a class="menulink" href="köttbullar.html">Köttbullar</a><span class="hide"> | </span>
                        <a class="menulink" href="kalender.html">Kalender</a><span class="hide"> | </span>
                        <a class="menulink active" href="login.html">Login</a><span class="hide"> | </span>
                        </p>
                </div>
        
             <div id="content">
                <form action="#">
                          <label>Användarnamn:</label>
                          <input type="text" placeholder="Enter Username" name="tasty_username" required maxlength="20" /> <br />

                          <label>Lösenord:</label>
                          <input type="password" placeholder="Enter Password" name="tasty_password" required maxlength="40" />
                          <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                          <input type="submit" value="Logga in" />
                          <!--
                          <input type="checkbox" checked="checked"> Remember me

                          <button type="button" class="cancelbtn">Cancel</button>
                          <span class="psw">Forgot <a href="#">password?</a></span> -->
                </form> 
             </div>
                
                
                <footer>
                <p class="footer">Copyright &copy; 2017 <a href="index.html">Monde Mampe</a><br />
                </p>
                </footer>
         
         </div>
    
    </body>
</html>

