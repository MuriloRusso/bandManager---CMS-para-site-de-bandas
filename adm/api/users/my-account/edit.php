<?php
    include('../../../../public/includes/connect.php');
    include('../../cors.php');
    include('../../../../public/includes/protect.php');
    if(isset($_POST['name']) || isset($_POST['username']) || isset($_POST['email'])):
        $id = $_SESSION['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $sql_code = "SELECT * FROM cad_user WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $user = $sql_query->fetch_object();

        function hasSpacesOrSpecialChars($string) {
            // Expressão regular para verificar espaços ou caracteres especiais
            return preg_match('/[\s\W]/', $string);
        }


        if(strlen($_POST['name']) == 0):
            echo json_encode([
                'message' => 'Nome em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(hasSpacesOrSpecialChars($_POST['username'])):
            echo json_encode([
                'message' => 'Não são permitidos espaços ou caracteres especiais no nome de usuário',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['username']) == 0):
            echo json_encode([
                'message' => 'Nome de Usuário em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['email']) == 0):
            echo json_encode([
                'message' => 'E-mail em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif($id != $_SESSION['id']):
            http_response_code(401);
            echo json_encode([
                'message' => 'Você não pode editar outro usuário!',
                'status' => 401,
            ]);
        else:
            $sql_code = "SELECT * FROM cad_user WHERE username='$username' And id<>$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse nome de usuário',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;

            $sql_code = "SELECT * FROM cad_user WHERE email='$email' And id<>$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;

            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse e-mail',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;

            $sql_code = "UPDATE cad_user SET name='{$name}', username='{$username}', email='{$email}' WHERE id=$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Seus dados foram atualizados com sucesso!',
                'status' => 200,
            ]);

        endif;
    endif;