<?php
    // Correção do cabeçalho CORS para permitir acesso somente do domínio especificado
    header('Access-Control-Allow-Origin: *');
    
    // // Cabeçalhos para permitir métodos específicos e cabeçalhos durante a requisição
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Credentials: true');
?>