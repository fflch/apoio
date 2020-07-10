## Pacotes Básicos

    apt-get -y install apache2 php7.0 libapache2-mod-php7.0
    apt-get -y install  php-gd php-dom php-xml php-gd php-interbase php-mbstring php-curl php-fpdf
    apt-get -y install firebird2.5-super # colocar a senha
    dpkg-reconfigure firebird2.5-super # colocar novamente a senha definida anteriormente

## Instruções de uso:

O sistema utiliza alguns frameworks/plugins externos. 

## Smarty

Baixar a biblioteca do [smarty](http://www.smarty.net) versão __3.1__ e descompactar no diretório **/usr/local/lib/php/smarty/**.

Alterar o grupo e dar permissão de escrita para o usuário do Servidor Web nos seguintes diretórios:

    templates/tplc  
    templates/tplcache  
    votacao/templates/tplc  
    votacao/templates/tplcache

## JQuery

Baixar o framework JQuery e alguns plugins do mesmo, e colocá-los no diretório **/js**.

    jquery-1.6.1.min.js  
    jquery-ui-1.8.13.custom.js  
    jquery.ui.autocomplete.js  
    jquery.ui.core.js  
    jquery.ui.datepicker-pt-BR.js  
    jquery.ui.position.js  
    jquery.ui.widget.js

O plugin jquery-ui-1.8.13.custom.js e jquery.ui.datepicker-pt-BR.js possui um arquivo .css, bem como um pasta de imagens, colocá-lo no diretório **/css/start/**.

## FPDF

Baixar a biblioteca do [fpdf](http://www.fpdf.org/) versão __1.81__ e descompactar no diretório **/usr/local/lib/php/fpdf**. 

## PHPASS - PHP password hashing

Baixar o [phpass](http://www.openwall.com/phpass/), renomear o arquivo de PasswordHash.php para PasswordHash.inc.php e colocá-lo no diretório **/includes**.

Utilize o **phpass** para gerar um hashing da senha para ser adicionado no banco de dados, depois insira o usuário e a senha(hashing) através de um cliente do bd. Após isso você pode fazer o login no sistema.

## Configurar a senha do banco de dados

    cp includes/modelo.confconexao.inc.php includes/confconexao.inc.php
