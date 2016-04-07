# MyCalculator
Small CLI calculator

Prewiew PHP
```php
//Yes, i know about bad code. But... I don't have a lot of time for this
use Calculator\Operator\Division;
use Calculator\Operator\Modular;
use Calculator\Operator\Multiplication;
use Calculator\Operator\Subtraction;

include("strings.php");
include("settings.php");

include("Operators/OperatorInterface.php");
include("Operators/AbstractOperator.php");
include("Operators/Addition.php");
include("Operators/Division.php");
include("Operators/Modular.php");
include("Operators/Multiplication.php");
include("Operators/Subtraction.php");


$log = new Plog();
$colors = new Colors();
$s = new Strings();
$calc = new Calculator();
$st = new Settings();
$calc->prepareCalc(); //Add Operators

while (true) {
  $line = new ConsoleQuestion();
  $answer = $line->readline(); //Writed by user in command line
  if ($answer == "quit") exit;
}
```
