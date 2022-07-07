<?php

spl_autoload_register(function (string $nomeCompletoDaClasse) {
  $basePath = __DIR__ . DIRECTORY_SEPARATOR."api\\";

  $caminhoArquivo = str_replace('api\\', $basePath, $nomeCompletoDaClasse);
 
  $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo); // DIRECTORY_SEPARATOR is a default constant of PHP
  $caminhoArquivo .= '.php';

  if (file_exists($caminhoArquivo)) {
    require_once $caminhoArquivo;
  } else {
    echo "Caminho \"$caminhoArquivo\" não encontrado!";
    exit();
  }
});
