<?php 


	$emailsender = "webmaster@" . $_SERVER[HTTP_HOST];

	 
	/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
	if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
	elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
	else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
	 
	// Passando os dados obtidos pelo formulário para as variáveis abaixo
	$nomeremetente     = $_POST['name'];
	$emailremetente    = trim($_POST['email']);
	$emaildestinatario = "contato@bjtptransportes.com.br";
	// $emaildestinatario = "gabriel@pamajhon.com.br";
	$assunto           = "Contato enviado pelo site por: " . $_POST['name'];	


	$datahora = strftime( '%Y-%m-%d %H:%M:%S', strtotime('now') );

	$mensagemConcatenada = 'Formulário de contato'.'<br/>'; 
	$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
	$mensagemConcatenada .= 'E-mail: '.$_POST['email'].'<br/>'; 
	$mensagemConcatenada .= 'Nome: '.$_POST['name'].'<br/>';
	$mensagemConcatenada .= 'Assunto: '.$_POST['subject'].'<br/>';
	$mensagemConcatenada .= 'Mensagem: '.$_POST['comment'].'<br/>';
	$mensagemConcatenada .= 'Contato feito as: '.$datahora.'<br/>';
	$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
	 
	/* Montando o cabeçalho da mensagem */
	$headers = "MIME-Version: 1.1".$quebra_linha;
	$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
	// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
	$headers .= "From: ".$emailsender.$quebra_linha;
	$headers .= "Return-Path: " . $emailsender . $quebra_linha;
	

	$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
	// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
	 
	/* Enviando a mensagem */
	mail($emaildestinatario, $assunto, $mensagemConcatenada, $headers, "-r". $emailsender);
	echo 1;


?>