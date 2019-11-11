<!DOCTYPE html>
<html>
<body>
<?php
//To create a var, simply write $varname
$txt= "'Hello World!'"; //This var will hold text
$x = 10; //This var will hold an integer
$y = 3.14; //This var will hold a float 
$resultat= $x*$y;
echo "My first PHP file said " . $txt . " but I can also do maths : " . $x . " * "  . $y . " = " . $resultat . "!</br>";

echo <<<EOL
</br>
Those are some rules for naming variables in PHP </br>
>A variable starts with the $ sign, followed by the name of the variable </br>
>A variable name must start with a letter or the underscore character </br>
>A variable name cannot start with a number </br>
>A variable name can only contain alpha-numeric characters and underscores (A-z, 0-9, and _ ) </br>
>Variable names are case-sensitive ($ age and $ AGE are two different variables) </br>
EOL;
?>
</body>
</html>
