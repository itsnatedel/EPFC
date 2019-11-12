<!DOCTYPE html>
<html>
<body>
<?php
echo <<<EOL
    <h1>PHP Echo Statement</h1>
    The echo statement can be used with or without parentheses: echo or echo().
    <h3>Display some text</h3>
EOL;
echo "This is some text using the echo statement</br>";
echo "Hello PHP!</br>";
echo "This", " is ", "a ", "line ", "with multiple", " paramaters.</br>";  

echo "<h3>Display some variables</h3>";
echo "The following example shows how to output text and variables with the echo statement:</br>";
$texte1 = "Oh les gars!";
$texte2 = "Moi, je m'en fous.";
echo $texte1," ", $texte2;

echo <<<EOL
    <h1>PHP Print Statement</h1>
    The print statement can be used with or without parentheses: print or print().</br>
    The text can contain HTML markup </br>
EOL;
print("Proximus c'est tous des mafieux</br>");
print "Braaaa cortex 91 les pyramides";
?>
</body>
</html>
