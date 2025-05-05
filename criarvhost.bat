@echo off
set /p domain=Digite o nome do domínio (ex: projeto.test):
set /p path=Digite o caminho da pasta do projeto (ex: C:\laragon\www\projeto):

:: Adiciona ao arquivo hosts
echo.
echo Adicionando %domain% ao arquivo hosts...
echo 127.0.0.1    %domain%>> %SystemRoot%\System32\drivers\etc\hosts

:: Cria Virtual Host no Laragon
set apacheVhosts=C:\laragon\etc\apache2\sites-enabled\%domain%.conf

(
echo ^<VirtualHost *:80^>
echo     ServerName %domain%
echo     DocumentRoot "%path%"
echo     ^<Directory "%path%"^>
echo         Options Indexes FollowSymLinks
echo         AllowOverride All
echo         Require all granted
echo     ^</Directory^>
echo ^</VirtualHost^>
) > "%apacheVhosts%"

:: Reinicia Apache (pelo Laragon)
echo.
echo Reiniciando Apache...
cd /d C:\laragon
start "" laragon.exe reload

echo.
echo Tudo pronto! Acesse http://%domain%
pause
