@echo off
TITLE Calculator
cd /d %~dp0
if exist bin\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)

if exist calculator.php (
	set FILE=calculator.php
) else (
	echo "Couldn't find a valid Calculator installation"
	pause
	exit 1
	)
)

if exist bin\mintty.exe (
	start "" bin\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="Consolas" -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "Calculator" -w max %PHP_BINARY% %FILE% --enable-ansi %*
) else (
	%PHP_BINARY% -c bin\php %FILE% %*
)
