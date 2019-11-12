<!DOCTYPE html>
<html>
<body>
<h1>PHP String Functions</h1>
<a href="https://www.w3schools.com/php/php_ref_string.asp">Liste des fonctions pour les chaînes de caractères</a>
<?php
echo <<<EOL
<h3>strlen() - Return the Length of a String</h3>
The PHP strlen() function returns the length of a string.</br>
Cette chaîne de caractere contient 50 caracteres! </br>
strlen() output: 
EOL;
echo strlen("Cette chaîne de caractere contient 50 caracteres!");
echo "<hr>";

echo <<<EOL
<h3>str_word_count() - Count Words in a String</h3>
The PHP str_word_count() function counts the number of words in a string. </br>
Cette chaîne de caractere contient 7 mots!</br>
str_word_count() output: 
EOL;
echo str_word_count("Cette chaîne de caractere contient 7 mots!");
echo "<hr>";

echo <<<EOL
<h3>strrev() - Reverse a String</h3>
The PHP strrev() function reverses a string.</br>
Cette chaine de caractere donne "eretcarac ed eniahc etteC" à l'envers!</br>
strrev() output:
EOL;
echo strrev("Cette chaine de caractere");
echo "<hr>";

echo <<<EOL
<h3>strpos() - Search For a Text Within a String</h3>
The PHP strpos() function searches for a specific text within a string.</br>
If a match is found, the function returns the character position of the first match.</br>
If no match is found, it will return FALSE.</br>
Syntax: strpos("text", "textToSearch"); </br> 
As follow: strpos("Hello world!", "world"); -> Returns 6 as the word "world" begins at the 6th character </br>
The count begins at 0. A space is also counted as a position.</br>
strpos() output: 
EOL;
echo strpos("Hello world!", "world");
echo "<hr>";

echo <<<EOL
<h3>str_replace() - Replace Text Within a String</h3>
The PHP str_replace() function replaces some characters with some other characters in a string. </br>
Syntax: str_replace("WordBeingReplaced", "NewWord", "Original Text"); </br>
As follow: str_replace("world", "poucave", "Hello world!"); </br>
EOL;
echo "Hello world!<br/>";
echo str_replace("world", "poucave", "Hello world!");

?>
</body>
</html>
