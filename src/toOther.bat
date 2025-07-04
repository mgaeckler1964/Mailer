set var=%cd%
echo %var%

if "%var%"=="C:\CRESD\object" goto nix

if "%var%" GTR "E" goto netz

set source=C:\CRESD\Source\Internet\Mailer\src
set target=M:\wwwroot\Mailer

goto end

:netz
set source=M:\wwwroot\Mailer
set target=C:\CRESD\Source\Internet\Mailer\src

:end

mirror -l %source% %target%
explorer %target%

:nix


pause