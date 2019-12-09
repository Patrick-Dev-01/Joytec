<?php

//Arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'helper.php';

class Administrador extends Helper{
    //Encapsulando
    private $nome;
    private $sobrenome;
    private $senha;
    private $email;

    //metodos Setters
    private function setNome($n){
        $this->nome = $n;
    }

    private function setSobrenome($sb){
        $this->sobrenome = $sb;
    }

    private function setSenha($s){
        $this->senha = $s;
    }

    private function setEmail($e){
        $this->email = $e;
    }

    //Metodos Getters
    protected function getNome(){
        return $this->nome;
    }

    protected function getSobrenome(){
        return $this->sobrenome;
    }

    protected function getSenha(){
        return $this->senha;
    }

    protected function getEmail(){
        return $this->email;
    }

    //Cadastrar admin
    private function cadastrarAdmin(){
        //Instanciar banco
        $banco = new Banco();
        //Query
        $sql = "insert into administrador (nome, sobrenome, senha, email, dt_admissao) values ('".$this->getNome()."', 
        '".$this->getSobrenome()."', '".$this->getSenha()."', '".$this->getEmail()."', sysdate());";
        //Preparar Query
        $insert = $banco->connect()->prepare($sql);
        //Executar QUery
        $insert->execute();
    }

    //validar Admin
    public function validarAdmin($no, $so, $se, $em){
        //Array de Erros
        $erros = [];
        //Instanciar banco
        $banco = new Banco();
        //Query
        $sql = "select email from administradores where email = '$em';";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        $resultado = $select->fetchAll();
        //Se o email ja estiver cadastrado
        if(count($resultado) > 0){
            $erros[] = "Este Email ja está cadastrado";
        }
        //Se o nome estiver vazio
        if(empty($no)){
            $erros[] = "Nome Inválido";
        }
        //Se o sobrenome estiver vazio
        if(empty($so)){
            $erros[] = "Sobrenome Inválido";
        }
        //Se a senha for vazia ou menor que 3 caracteres
        if(empty($se) || strlen($se) < 3){
            $erros[] = "a Senha deve conter no minimo 3 caracteres";
        }
        //Se o email estiver vazio
        if(empty($em)){
            $erros[] = "Email Inválido";
        }
        //Se existir erros
        if($erros){
            //Mostre cada um
            foreach($erros as $erro){
                echo("<script>alert('".$erro."')</script>");
            }
            echo("<script>history.go(-1)</script>");
        }


        //Se todos forem validados
        else{
            $this->setNome($no);
            $this->setSobrenome($so);
            $this->setEmail($em);
            //Gerar o hash da senha
            $senhaSegura = password_hash($se, PASSWORD_DEFAULT);
            $this->setSenha($senhaSegura);
            $this->cadastrarAdmin();
            header("location: ../home_admin.php");
        }
    }

    //login do administrador (Login),(pass = senha)
    public function loginAdmin($l, $pass){
        //Instanciar Banco
        $banco = new Banco();
        //Query
        $sql = "Select *from administrador where email = '$l';";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Excutar query
        $select->execute();
        $resultado = $select->fetchAll();
        //Se o administrador existir 
        if(count($resultado) > 0){
            foreach($resultado as $row){
                $id = $row['id_admin'];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $senha = $row['senha'];
            }
            //Comparar o hash da senha
            if(password_verify($pass, $senha)){
                session_start();
                $_SESSION['admin'] = $id;
                header("location: ../home_admin.php");
            }
            //Se o hash não bater com a senha
            else{
                echo("<script>alert('Usuario ou Senha Incorretos');history.go(-1)</script>");
            }
        }
        //Se ele não achar o email
        else{
            echo("<script>alert('Usuario ou Senha Incorretos');history.go(-1)</script>");
        }
    }

    //ficha do admin
    public function fichaAdmin($id){
        $banco = new Banco();
        //Query
        $sql = "Select *from administrador where id_admin = '$id';";
        //Preparar query
        $select = $banco->connect()->prepare($sql);
        //Excutar Query
        $select->execute();
        //pegar dados
        $resultados = $select->fetchAll();

        foreach($resultados as $row){
            $nome = $row['nome'];
            $sobrenome = $row['sobrenome'];
            //Converter no formato brasileiro
            $admissao = date("d/m/Y", strtotime($row['dt_admissao']));
            echo("<span class='dados'><small class='info-admin'>Administrador(a):</small>
            <strong id='admin-nome'>".$nome." ".$sobrenome."</strong></span><br>
            <span id='dt-admissao'>Data de Admissão: ".$admissao."</span>
            <a href='./models/logout.php'><img src='img_admin/encerrar_sessao.png' id='enc'></a>");
        }
    }

    //listar os cursos na pagina do administrador
    public function listarCursos($f){
        //Instanciar Banco
        $banco = new Banco();
        //variavel global $sql para funcionar em todas as condições 
        $sql;

        //se o parametro for vazio selecione todos os cursos 
        if(empty($f)){
            $sql = "select *from cursos;";
        }
        //Se filtrar por grau, selecione de acordo com o grau selecionado
        if($f == "basico" || $f == "intermediario" || $f == "avancado"){
            $sql = "select *from cursos where grau = '$f';";
        }

    /* filtro por carga horaria */

        //Entre 20 e 40 horas
        if($f == 20){
            $sql = "select *from cursos where carga_horaria between 20 and 40;";
        }
        //Entre 50 e 80 horas
        if($f == 40){
            $sql = "select *from cursos where carga_horaria between 50 and 80;";
        }
        //mais que 80 horas
        if($f == 80){
            $sql = "select *from cursos where carga_horaria > 80;";
        }

        //por data 
        if($f == "asc" || $f == "desc"){
            $sql = "select *from cursos order by id_curso $f;";
        }

        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        //Guardar os resultados
        $resultados = $select->fetchAll();
        //Se existir cursos
        if(count($resultados) > 0){
            foreach($resultados as $row){
                $id_curso = $row['id_curso'];
                $curso = $row['nome'];
                $descricao = $row['descricao'];
                $grau = $row['grau'];
                $carga = $row['carga_horaria'];
                $icone = $row['imagem'];
                //Converter a data em formato brasileiro
                $lancamento = date("d/m/Y", strtotime($row['dt_lancamento']));
                //Exiba cada um dos cursos de acordo com a pesquisa
                echo("<div class='resultado'><img src='img_cursos/".$icone."' id='curso-icon'>
                <span id='curso-nome'>".$curso."</span><hr><p id='grade'>O que você verá neste Módulo: </p>
                <small id='descricao'>".$descricao."</small><hr><p id='carga'>Carga Horária: ".$carga." hrs
                <span id='grau'>Grau: ".$grau."</span></p></div>
                <span class='editar-curso'><a href='edit_curso.php?id=$id_curso'>
                <button type='button' class='btn-editar'>Editar Curso</button></a></span>
                <span class='deletar-curso'><a href='models/delete_curso.php?id_c=$id_curso'><button type='button' class='btn-deletar'>Deletar Curso</button>
                </a></span><br>");
            }
        }
        //se nao existir cursos
        else{
            echo("Não a cursos disponíveis");
        }
    }

    public function logoutAdmin(){
        //encerra sessão
        unset($_SESSION['admin']);
        header("location: ../login_admin.html");
    }

    //Mostrar todas as duvidas dos usuarios
    public function duvidas($d){
        //instanciar Banco
        $banco = new Banco();
        // se o filtro for vazio selecione todas duvidas
        if(empty($d)){
            $sql = "select *from duvidas as d join aluno as a where d.ID_aluno = a.id_aluno order by d.id desc;";
        }

        if(isset($_SESSION['admin'])){
            $id_admin = $_SESSION['admin'];
        }
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        // Executar Query
        $select->execute();
        //Armazenar os resultados
        $resultados = $select->fetchAll();
        //Se houver resultados mostre
        if(count($resultados) > 0){
            foreach($resultados as $row){
                $duvida = $row['id'];
                $id_aluno = $row["id_aluno"];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $titulo = $row['titulo'];
                $texto = substr($row['texto'], 0, 255);
                //Converter a data no formato brasileiro
                $data = date("d/m/Y", strtotime($row['dt']));
                
                echo("<div class='duvida'><h3>".$nome." ".$sobrenome."</h3><hr><h2>".$titulo."</h2><hr><p>Postado em: ".$data."</p>
                <span id='topico'><a href='topico.php?t=$duvida&a=$id_aluno'>
                <button type='button' id='btn-topico'>Ver Mais</button></span></a></div><br><br>");
            }
        }
        //Se não houver duvidas no filtro
        else{
            echo("Não há duvidas nesse filtro");
        }
    }

    //topico da duvida
    public function topico($d, $a){
        //Instanciar Banco
        $banco = new Banco();
        // Query
        $sql = "Select *from duvidas as d join aluno as a where d.id = '$d' and d.ID_aluno = '$a' and d.ID_aluno = a.id_aluno;";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar
        $select->execute();
        $topico = $select->fetchAll();
        //Se existir o topico
        if(count($topico) > 0){
            foreach($topico as $row){
                $duvida = $row['id'];
                $id_aluno = $row["id_aluno"];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $titulo = $row['titulo'];
                $texto = $row['texto'];
                //Converter a data no formato brasileiro
                $data = date("d/m/Y", strtotime($row['dt']));

                echo("<br><span><div class='nome'><small id='user-nome'>".$nome." ".$sobrenome."</small></div></span>
                <div class='duvida'><h2>".$titulo."</h2><p>".$texto."</p><hr><p>Postado em: ".$data."</p></div><hr>");
            }
        }
    }
    //Respostas dos administradores
    public function respostaAdmin($r, $id_d, $id_admin){
        //instanciar Banco
        $banco = new Banco();
        //Array de erros
        $erros = [];
        //Se o a resposta estiver vazia 
        if(empty($r)){
            $erros[] = "A resposta esta vazia!";
        }
        //se existir erros
        if($erros){
            foreach($erros as $erro){
                echo("<script>alert('".$erro."')</script>");
            }
            echo("<script>history.go(-1)</script>");
        }
        //se não, execute 
        else{
            //Query
            $sql = "insert into respostas (resposta, Id_duvida, Id_admin, dt_resposta) values ('$r', '$id_d', '$id_admin', sysdate());";
            //Preparar Query
            $responder = $banco->connect()->prepare($sql);
            //Executar Query
            $responder->execute();
            echo("<script>history.go(-1)</script>");
        }
    }
}

?>