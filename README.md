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

$calc = new Calculator();
$calc->prepareCalc(); //Add Operators

while (true) {
  $f = fopen( 'php://stdin', 'r' );
  $answer = rtrim(fgets($f)); //Writed by user
  if (strtolower($answer) == "quit") exit; //Quit, if user write "quit" in console
}
```
