<!DOCTYPE html>
<html>
<body>
<h3>The scope of a variable is the part of the script where the variable can be referenced/used.</h3>

<p>PHP has three different variable scopes: <p>
<ul>
    <li>local</li>
    <li>global</li>
    <li>static</li>
</ul>

<?php
echo "<h1>Global Scope</h1>";
$x = 10; //This is a var in the global scope, accessible from anywhere in the code

function myError() {
    //Using the var $x in this function will result in an ERROR as it is unknown to the function
    echo "<p>The variable x inside the function is : $x</p>"; 
}

myError(); //This will call the function (call a function = to run it)

echo "<p>The variable x outside the function is : $x</p>";

echo "<h1>Local Scope</h1>";
function myLocalVar() {
    $y = "Local Variable"; //This variable is local to the function but unknown to the outside of the function
    echo "This variable is a $y inside its function";
}

myLocalVar();

echo "The variable y outside the function is $y ";

echo <<<EOL
<h3>The 'GLOBAL' keyword </h3>
The global keyword is used to access a global variable from within a function. </br>
To do this, use the global keyword before the variables </br>
</br>
EOL;

$cinq = 5;
$dix = 10;

function MyCalcul() {
    global $cinq, $dix, $resultat; //the global keyword makes the variables global.
    $resultat = $cinq + $dix;
    echo "The variable cinq and dix in the function equal $cinq and $dix </br>";
}

myCalcul();
echo "$cinq + $dix = $resultat </br>"; //Resultat is now known to the entire file as it has been made global

echo <<<EOL
<h3>Static Keyword</h3>
Normally, when a function is completed/executed, all of its variables are deleted. However, sometimes we want a local variable NOT to be deleted. </br>
To do this, use the static keyword when you declare the variable </br>
EOL;

function myStaticVar() {
    static $p = 0;
    echo "$p </br>";
    $p++;
}
echo "</br>The value of p is known outside its function and will not be deleted: </br>";
myStaticVar(); //p+=1
myStaticVar(); 
myStaticVar();
myStaticVar();
?>

</body>
</html>
