<?php
//by xpyctum
include("strings.php");
class Calculator{ //Класс
    private $number = [];

    public function plus(){
        return array_sum($this->getNumbers());
    }

    public function minus(){
        $numbers = $this->getNumbers(); $result = $numbers[0];
        for($x=0;$x<=count($numbers);$x++){
            if($this->getNextNumber($x+1)){
                $next = $this->getNextNumber($x+1);
                $result = $result - $next;
            }
        }
        return $result;
    }

    public function sqrt(){
        $numbers = $this->getNumbers(); $result = 0; $last = 0;
        for($x=0;$x<=count($numbers);$x++){ //Цикл, который будет всё считать.
            if($x == 0){
                $result = sqrt($numbers[$x]);
            }else {
                if ($this->getNextNumber($x + 1)) {
                    $next = $this->getNextNumber($x + 1);
                    $result = sqrt();
                }
            }
        }
        return $result;
    }

    public function sqr(){ //Функция - (будет квадрат)
        $numbers = $this->getNumbers(); $result = 0; $last = 0;
        for($x=0;$x<=count($numbers);$x++){ //Цикл, который будет всё считать.
            if($x == 0){
                $result = $numbers[$x] * $numbers[$x];
            }else {
                if ($this->getNextNumber($x + 1)) {
                    $next = $this->getNextNumber($x + 1);
                    $result = $result * $next;
                }
            }
        }
        return $result;
    }

    public function division(){ //Функция - (будет деление)
        $numbers = $this->getNumbers(); $result = $numbers[0];
        for($x=0;$x<=count($numbers);$x++){ //Цикл, который будет всё считать.
            if($this->getNextNumber($x+1)){
                $next = $this->getNextNumber($x+1);
                $result = $result / $next;
            }
        }
        return $result;
    }

    public function multiplication(){ //Функция - (будет умножение)
        $numbers = $this->getNumbers(); $result = $numbers[0];
        for($x=0;$x<=count($numbers);$x++){ //Цикл, который будет всё считать.
            if($this->getNextNumber($x+1)){
                $next = $this->getNextNumber($x+1);
                $result = $result * $next;
            }
        }
        return $result;
    }

    /**
     * Получает следующее значение из массива.
     * @param $key
     * @return null|int
     */
    public function getNextNumber(/* int */ $key){
        if(isset($this->getNumbers()[$key])){
            return $this->getNumbers()[$key];
        }
        return null;
    }

    /**
     * @param array $number
     */
    public function setNumbers($number){ //Установить в массив цифры
        $this->number = $number; //Сохраним цифры в локальную переменную
    }

    /**
     * @param $number
     */
    public function addNumber($number){ //ДОБАВИТЬ в массив цифру
        $this->number[] = $number; //Сохраним цифру в локальный массив.
    }

    /**
     * @return array
     */
    public function getNumbers(){ //Получаем номера
        return $this->number; //Из класса
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
$log->log(Colors::$COLOR_LIGHT_PURPLE.$s->get()["start"]);

$line = new ConsoleQuestion();
$prompt = Colors::$COLOR_AQUA.$s->get()["arifm_start"];
$log->log($prompt);
$answer = $line->readline();
$log->log(Colors::$COLOR_GREEN.$s->get()["arifm_header_list"]);
foreach(explode(",",$answer) as $i){
    $log->log($s->get()["arifm_list_item"].$i);
    $calc->addNumber($i);
}
$log->log($calc->sqr());


sleep(25);