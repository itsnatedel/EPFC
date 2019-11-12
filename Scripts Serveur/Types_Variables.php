<!DOCTYPE html>
<html>
<body>
<h1>PHP Data Types</h1>

<p>Variables can store data of different types, and different data types can do different things.</p>

<p>PHP supports the following data types:</p>
<ol>
    <li>String</li>
    <li>Integer</li>
    <li>Float (floating point numbers - also called double)</li>
    <li>Boolean</li>
    <li>Array</li>
    <li>Object</li>
    <li>NULL</li>
</ol>

<?php 
echo <<<EOL
    <h3>PHP String</h3>
    A string can be any text inside quotes. You can use single or double quotes:</br>
EOL;
$a = "This variable and the following one contain text. ";
$b = "This makes them string variables";
echo $a, $b;
echo <<<EOL
    <h3>PHP Integer</h3>
    An integer data type is a non-decimal number between -2,147,483,648 and 2,147,483,647.<br/>
    Rules for integers:</br>
    <ul>
        <li>An integer must have at least one digit</li>
        <li>An integer must not have a decimal point</li>
        <li>An integer can be either positive or negative</li>
        <li> Integers can be specified in: decimal (base 10), hexadecimal (base 16), octal (base 8), or binary (base 2) notation</li>
    </ul>
    In the following example 'c' is an integer. <b>The PHP var_dump() function</b> returns the data type and value</br>
EOL;
$c = 45340;
var_dump($c);

echo <<<EOL
    <h3>PHP Float</h3>
    A float (floating point number) is a number with a decimal point or a number in exponential form.</br>
    In the following example 'd' is a float. The PHP var_dump() function returns the data type and value:
EOL;
$d = 3.141592653589793;
var_dump($d);

echo <<<EOL
    <h3>PHP Boolean</h3>
    A Boolean represents two possible states: TRUE or FALSE.</br>
    Booleans are often used in conditional testing.</br>
    In this example, e will be set to true and f to false</br>
EOL;
$e = true;
$f = false;
var_dump($e);
var_dump($f);

echo <<<EOL
    <h3>PHP Array</h3>
    An array stores multiple values in one single variable.</br>
EOL;
$profs = array("Verbist", "Dessy", "Puth", "L'Hoest");
var_dump($profs);

echo <<<EOL
    <h3>PHP Objects</h3>
    An object is a data type which stores data and information on how to process that data.</br>
    In PHP, an object must be explicitly declared.</br>
    First we must declare a class of object. For this, we use the class keyword.</br>
EOL;

class Fruit {
    function Fruit() {
        $this->model ="Fraise";
    }
}

//Create an object 
$Pomme = new Fruit();

//Show that object's properties 
echo $Pomme->model;

echo <<<EOL
    <h3>PHP NULL Value</h3>
    Null is a special data type which can have only one value: NULL.</br>
    A variable of data type NULL is a variable that has no value assigned to it.</br>
    If a variable is created without a value, it is automatically assigned a value of NULL.</br>
    Variables can also be emptied by setting the value to NULL:</br>
EOL;
$g = "Hello I will be emptied in the next line";
echo $g;
$g = null;
var_dump($g);
?>
</body>
</html>
