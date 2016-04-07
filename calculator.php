<?php
//by xpyctum
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

ini_set('display_errors',false);

class Calculator{ //Класс
    protected $operators = [];
    protected $expressions = [];

    /**
     * Считывать оператор
     * @param OperatorInterface $operator
     */
    public function addOperator(OperatorInterface $operator) {
        $this->operators[$operator->getToken()] = $operator;
    }
    /**
     * Считывает строку и делаем массив
     *
     * @return
     */
    public function calculate($input){
        $this->expressions = explode(' ', $input);
        $maxPrecedence = $this->getMaxPrecedence();
        for($precedenceIndex = $maxPrecedence; $precedenceIndex >= 0; $precedenceIndex--) {
            $precedenceList = $this->getPrecedenceOperatorArray($precedenceIndex);
            $this->calculateOperators($precedenceList);
        }
        // The result
        return $this->expressions[0];
    }
    /**
     * Получить процедуру. Умножение.
     *
     * @return int
     */
    protected function getMaxPrecedence(){
        $maxPrecedence = 0;
        foreach($this->operators as $operator) {
            /** @var $operator OperatorInterface */
            if($operator->getPrecedence() > $maxPrecedence) {
                $maxPrecedence = $operator->getPrecedence();
            }
        }
        return $maxPrecedence;
    }
    /**
     * Получить массив
     *
     * @param  Int
     * @return array
     */
    protected function getPrecedenceOperatorArray($precedence){
        $precedenceOperatorArray = array();
        foreach($this->operators as $operator) {
            /** @var $operator OperatorInterface */
            if($operator->getPrecedence() == $precedence) {
                $precedenceOperatorArray[$operator->getToken()] = $operator;
            }
        }
        return $precedenceOperatorArray;
    }
    /**
     * Подсчитать операторы
     * @param array
     */
    protected function calculateOperators(Array $operators)
    {
        foreach($this->expressions as $index => &$part) {
            if( ! array_key_exists($part, $operators) ) {
                continue;
            }
            $operator = $operators[$part];
            // Calculate
            $base = $this->expressions[$index-1];
            $subject = $this->expressions[$index+1];
            /** @var $operator OperatorInterface */
            $sum = $operator->process($base, $subject);
            // Replace expression
            $this->replaceExpressionWithSum($index, $sum);
        }
    }
    /**
     * Заменить значения
     *
     * @param  Int
     * @param  Float
     */
    protected function replaceExpressionWithSum($index, $sum){
        $this->expressions[$index-1] = null;
        $this->expressions[$index+1] = null;
        $this->expressions[$index] = $sum;
        $this->expressions = array_values(array_filter($this->expressions, 'strlen'));
    }

    public function prepareCalc(){
        $this->addOperator(new Addition());
        $this->addOperator(new Division());
        $this->addOperator(new Modular());
        $this->addOperator(new Multiplication());
        $this->addOperator(new Subtraction());
    }

}
class Colors extends Calculator{
     public static $FORMAT_BOLD = "\x1b[1m";
     public static $FORMAT_OBFUSCATED = "";
     public static $FORMAT_ITALIC = "\x1b[3m";
     public static $FORMAT_UNDERLINE = "\x1b[4m";
     public static $FORMAT_STRIKETHROUGH = "\x1b[9m";
     public static $FORMAT_RESET = "\x1b[m";
     public static $COLOR_BLACK = "\x1b[38;5;16m";
     public static $COLOR_DARK_BLUE = "\x1b[38;5;19m";
     public static $COLOR_DARK_GREEN = "\x1b[38;5;34m";
     public static $COLOR_DARK_AQUA = "\x1b[38;5;37m";
     public static $COLOR_DARK_RED = "\x1b[38;5;124m";
     public static $COLOR_PURPLE = "\x1b[38;5;127m";
     public static $COLOR_GOLD = "\x1b[38;5;214m";
     public static $COLOR_GRAY = "\x1b[38;5;145m";
     public static $COLOR_DARK_GRAY = "\x1b[38;5;59m";
     public static $COLOR_BLUE = "\x1b[38;5;63m";
     public static $COLOR_GREEN = "\x1b[38;5;83m";
     public static $COLOR_AQUA = "\x1b[38;5;87m";
     public static $COLOR_RED = "\x1b[38;5;203m";
     public static $COLOR_LIGHT_PURPLE = "\x1b[38;5;207m";
     public static $COLOR_YELLOW = "\x1b[38;5;227m";
     public static $COLOR_WHITE = "\x1b[38;5;231m";
}
class PLog extends Colors{
    public function log($text){
        echo $text."\n".Colors::$FORMAT_RESET;
    }
}
class ConsoleQuestion extends Calculator{
    public function readline(){
        return rtrim(fgets(STDIN));
    }
}

$log = new Plog();
$colors = new Colors();
$s = new Strings();
$calc = new Calculator();
$st = new Settings();
$calc->prepareCalc();
$log->log(Colors::$COLOR_LIGHT_PURPLE.$s->get()["start"]);
$void = $st->get()["infinity"];
if(!$void){
    $void = $st->get()["loops"];
}
    while ($void) {
        $line = new ConsoleQuestion();
        $prompt = Colors::$COLOR_AQUA . $s->get()["arifm_start"];
        $log->log($prompt);
        $answer = $line->readline();
        if ($answer == "quit") exit;
        if ($answer == "") continue;
        $c = $calc->calculate($answer);
        if ($c <= 1 and $c >= 0) {
            $log->log(Colors::$COLOR_GREEN . $s->get()["result"] . $answer . " = " . $c);
        } else if ($c < 0) {
            $log->log(Colors::$COLOR_RED . $s->get()["small_result"]);
        } else if ($c > 0) {
            $log->log(Colors::$COLOR_RED . $s->get()["big_result"]);
        }
    }
    sleep($st->get()["pause_before_exit"]);

