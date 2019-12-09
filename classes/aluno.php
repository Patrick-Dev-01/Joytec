<?php

require_once 'db.php';
require_once 'helper.php';

class Aluno extends Helper{
    private $rg;
    private $cpf;
    private $nome;
    private $sobrenome;
    private $dt_nascimento;
    private $senha;
    private $email;
    
    //Metodos Setters (vão receber os valores)
    private function setRg($r){
        $this->rg = $r;
    }

    private function setCpf($cpff){
        $this->cpf = $cpff;
    }

    private function setNome($n){
        $this->nome = $n;
    }
    
    private function setSobrenome($sn){
        $this->sobrenome = $sn;
    }

    private function setNascimento($na){
        $this->dt_nascimento = $na;
    }

    private function setSenha($senhaSegura){
        $this->senha = $senhaSegura;
    }

    private function setEmail($e){
        $this->email = $e;
    }

    //Metodos Getteres (vai retorna os Valores)
    protected function getRg(){
        return $this->rg;
    }

    protected function getCpf(){
        return $this->cpf;
    }

    protected function getNome(){
        return $this->nome;
    }

    protected function getSobrenome(){
        return $this->sobrenome;
    }

    protected function getNascimento(){
        return $this->dt_nascimento;
    }

    protected function getSenha(){
        return $this->senha;
    }

    protected function getEmail(){
        return $this->email;
    }

    //função para cadastrar aluno
    protected function cadastrar(){
        //Instanciar a classe do banco
        $banco = new Banco();

        //Query para cadastrar o aluno 
        $sql = "insert into aluno (rg, cpf, nome, sobrenome, dt_nascimento, senha, email) 
        values ('".$this->getRg()."', '".$this->getCpf()."', '".$this->getNome()."', '".$this->getSobrenome()."', 
        '".$this->getNascimento()."', '".$this->getSenha()."', '".$this->getEmail()."');";
        
        //Preparar a Query
        $insert = $banco->connect()->prepare($sql);
        //executar a Query
        $insert->execute(); 
    }

    //Validação 
    public function validar($r, $cpff, $n, $sn, $na, $s, $e){
        //Instanciar a classe do banco
        $banco = new Banco();

        //Array de erros, todos os erros serão colocados dentro do vetor e exibidos posteriormente
        $erros = [];

        //Verificar se o RG ja esta cadastrado 
        $sqlRg = "Select rg from aluno where rg = '$r';";
        //Preparar query
        $selectRg = $banco->connect()->prepare($sqlRg);
        //executar query
        $selectRg->execute();
        //pegar todos os resultados
        $resultadoRg = $selectRg->fetchAll();

        //Se o resultado for maior que zero, o RG ja foi cadastrado
        if(count($resultadoRg) > 0){
            $erros[] = "esse RG ja está Cadastrado";
        }

        //Verificar se o CPF ja foi Cadastrado
        $sqlCpf = "Select cpf from aluno where cpf = '$cpff';";
        //Preparar query
        $selectCpf = $banco->connect()->prepare($sqlCpf);
        //executar query
        $selectCpf->execute();
        //pegar resultados
        $resultadoCpf = $selectCpf->fetchAll();

        //Se o resultado for maior que zero, o CPF ja foi cadastrado
        if(count($resultadoCpf) > 0){
            $erros[] = "Esse CPF ja está Cadastrado";
        }

        //se o RG tiver menos ou mais de 8 digitos ou Vazio 
        if(strlen($r) < 9 || strlen($r) > 9 || empty($r)){
            $erros[] = "o RG precisa ter 8 digitos";
        }

        //Se o CPF tiver menos ou mais de 11 digitos ou vazio
        if(strlen($cpff) < 11 || strlen($cpff) > 11 || empty($cpff)){
            $erros[] = "o CPF precisa ter 11 digitos";
        }
        
        //Se o nome estiver vazio
        if(empty($n)){
            $erros[] = "Nome inválido";
        }

        //Se o sobrenome estiver vazio
        if(empty($sn)){
            $erros[] = "Sobrenome inválido";
        }
    
        //Se a data de nascimento for nula
        if($na == null || $na > 2019){
            $erros[] = "Data de Nascimento Inválida";
        }
    
        //Se a senha for vazia ou menor que 3 caracteres
        if(strlen($s) < 3){
            $erros[] = "a Senha deve conter no minimo 3 caracteres";
        }

        //Se email for vazio
        if(strlen($e) == 0){
            $erros[] = "Email Inválido";
        }

        //Se houver erros
        if($erros){
            //para cada erro dentro do array, mostre cada um que existir
            foreach($erros as $erro) {
                echo("<script>alert('".$erro."')</script>");
            }
            echo("<script>history.go(-1)</script>");
        }
        
        //Se todos os dados forem validados
        else{
            $this->setRg($r);
            $this->setCpf($cpff);
            $this->setNome($n);
            $this->setSobrenome($sn);
            $this->setNascimento($na);
            //gerar o Hash da senha
            $senhaSegura = password_hash($s, PASSWORD_DEFAULT);
            $this->setSenha($senhaSegura);
            $this->setEmail($e);
            $this->cadastrar();
            //Alerta de sucesso de cadastrado
            echo("<script>alert('Inscrição feita com sucesso!');window.location = '../home.php'</script>");
        }
    }

    //login
    public function login($c, $se){
        //Instanciar a classe do banco
        $banco = new Banco();
        //Query        
        $sql = "Select id_aluno, cpf, nome, sobrenome, senha, email from aluno where cpf = '$c';";
        //Preparar Query
        $login = $banco->connect()->prepare($sql);
        //executar query
        $login->execute();
        
        //Se existir o CPF digitado, compare a senha com o hash
        if(count($login) > 0){
            //Para cada campo da tabela aluno mostre: 
            foreach($login as $row){
                $aluno = $row['id_aluno'];
                $alunoNome = $row['nome'];
                $alunoSobrenome = $row['sobrenome'];
                $senha_db = $row['senha'];
                $alunoEmail = $row['email'];
            }
            if(password_verify($se, $senha_db)){
            //inicia a sessão
                session_start();
                $_SESSION['aluno_logado'] = $aluno;
                $_SESSION['aluno_nome'] = $alunoNome;
                $_SESSION['aluno_sobrenome'] = $alunoSobrenome;
                $_SESSION['aluno_email'] = $alunoEmail;
                header("location: ../home.php");
            }

            else{
                echo("<script>alert('CPF ou Senha Incorretos');history.go(-1)</script>");
            }
        }
    }

    //se Inscrever no curso desejado
    public function inscreverCurso($a, $c, $d){
        $banco = new Banco();
        //verificar se o aluno já se inscreveu nesse curso
        $sqlVerify = "Select *from aluno_cursos where Id_aluno = '$a' and Id_curso = '$c';";
        //Preparar Query
        $verificar = $banco->connect()->prepare($sqlVerify);
        //Executar Query
        $verificar->execute();
        //resultado da verificação
        $resultado = $verificar->fetchAll();
        //Se ele ja estiver inscrito mostre a mensagem 
        if(count($resultado) > 0){
            echo("<script>alert('Você ja se inscreveu nesse Curso!');history.go(-1)</script>");
        }
        //se não, realize a inscrição
        else{
            $sql = "insert into aluno_cursos (Id_aluno, Id_curso, dt_inicio) values ('$a', '$c', '$d');";
            $iniciar = $banco->connect()->prepare($sql);
            $iniciar->execute();
            echo("<script>alert('Você se inscreveu no curso');history.go(-1)</script>");
        }
    }

    //Deslogar da conta
    public function logout(){
        //Finalizar a sessão
        unset($_SESSION['aluno_logado']);
        header("location: home.php");
    }
    
    //Ficha do Aluno
    public function infoAluno($id){
        //Instanciar Banco
        $banco = new Banco();
        //Selecionar as informações do Aluno
        $sql = "Select *from aluno where id_aluno = '$id';";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        //Pegar os dados
        $dados = $select->fetchAll();
        foreach($dados as $row){
            //Colocar no formato padrão do RG
            $rg_1 = substr($row['rg'], 0, 2);
            $rg_2 = substr($row['rg'], 2, 3);
            $rg_3 = substr($row['rg'], 5, 3);
            $rg_4 = substr($row['rg'], 8, 1);
            //Guardar em uma variavel com o formato pronto
            $rg = "".$rg_1.".".$rg_2.".".$rg_3."-".$rg_4;
            //Colocar no formato padrão do CPF
            $cpf_1 = substr($row['cpf'], 0, 3);
            $cpf_2 = substr($row['cpf'], 3, 3);
            $cpf_3 = substr($row['cpf'], 6, 3);
            $cpf_4 = substr($row['cpf'], 9, 2);
            //Guardar em uma variavel com o formato pronto
            $cpf = "".$cpf_1.".".$cpf_2.".".$cpf_3."-".$cpf_4;
            //Outros dados
            $nome = $row['nome'];
            $sobrenome = $row['sobrenome'];
            //converter a data em formato brasileiro (dia, mês e ano)
            $nascimento = date("d/m/Y", strtotime($row['dt_nascimento']));
            $email = $row['email'];
        }
        //mostrar os dados
        echo("<hr><tr><td>Nome do Aluno</td><td>$nome $sobrenome</td></tr>
        <tr><td>RG</td><td>$rg</td></tr>
        <tr><td>CPF</td><td>$cpf</td></tr>
        <tr><td>Data de Nascimento</td><td>$nascimento</td></tr>
        <tr><td>Email</td><td>$email</td></tr>");
    }

    //cursos que aluno esta estudando
    public function cursosPendentes($id_aluno){
        //Instanciar banco
        $banco = new Banco();
        //selecionar todos os cursos que o aluno logado esta fazendo
        $sql = "Select *from cursos join aluno_cursos where aluno_cursos.Id_aluno = '$id_aluno' and 
        aluno_cursos.Id_curso = cursos.id_curso;";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        //guardar 
        $resultados = $select->fetchAll();
        //Se os resultados for maior que zero
        if(count($resultados) > 0){
            echo("<h3>Cursos em que você se inscreveu:</h3>");
            //Mostre os cursos
            foreach($resultados as $row){
                $id_curso = $row['id_curso'];
                $curso = $row['nome'];
                $descricao = $row['descricao'];
                $carga = $row['carga_horaria'];
                $grau = $row['grau'];
                $icone = $row['imagem'];

                echo("<div class='resultado'><img src='admin/img_cursos/".$icone."' id='curso-icon'>
                <span id='curso-nome'>".$curso."</span><hr><p id='grade'>O que você verá neste Módulo: </p>
                <small id='descricao'>".$descricao."</small><hr><p id='carga'>Carga Horária: ".$carga." hrs
                <span id='grau'>Grau: ".$grau."</span></p></div>
                <span class='cancelar-curso'><form action='models/cancelar.php' method='GET'>
                <input type='hidden' name='id_c' value='$id_curso'><input type='hidden' name='id_a' value='$id_aluno'>
                <button type='submit' class='btn-cancelar'>Cancelar Inscrição</button></span>
                </form><br>");
                
            }
        }
        //Mostrar essa mensagem cso o aluno não esta cadatrado em nenhum curso
        else{
            echo("Você não está inscrito em nenhum curso no momento.");
        }
    }

    //Cancelar inscrição
     public function cancelarInscricao($id_c, $id_a){
        //Instanciar Banco
        $banco = new Banco();
        //Query
        $sql = "delete from aluno_cursos where Id_curso = '$id_c' and Id_aluno = '$id_a';";
        //Preparar Query
        $delete = $banco->connect()->prepare($sql);
        //Executar Query
        $delete->execute();

        echo("<script>alert('Inscrição cancelada com sucesso');window.location = '../ficha.php';</script>");
    }

    //Enviar duvida do aluno para a administração
    public function enviarDuvida($t, $d, $id){
        //instanciar Banco
        $banco = new Banco();
        //Array de erros
        $erros = [];
        //Se nÃo existir sessão, o usuario não podera enviar a duvida
        if(!isset($_SESSION['aluno_logado'])){
            echo("<script>alert('Você precisa estar logado para enviar uma duvida');history.go(-1)</script>");
        }
        //Se existir, validar os campos
        else{
            //Se o titulo e a descrição estiverem vazios
            if(empty($t)){
                $erros[] = "destaque a sua duvida";
            }
            //Se existir erros de validação mostre cada um
            if($erros){
                foreach($erros as $erro){
                    echo("<script>alert('".$erro."')</script>");
                }
                echo("<script>history.go(-1)</script>");
            }
            //Se não houver erros
            else{
                //Query
                $sql = "insert into duvidas (titulo, texto, dt, ID_aluno) values ('$t', '$d', sysdate(), '$id');";
                //Preparar Query
                $duvida = $banco->connect()->prepare($sql);
                //Executar Query
                $duvida->execute();
                //Sucesso
                echo("<script>alert('Duvida enviada com sucesso!');window.location = '../contato.php';</script>");
            }
        }
    }

    //o aluno poderá consultar todas duvidas que ele enviou
    public function minhasDuvidas($id){
        //Instanciar banco 
        $banco = new Banco();
        //Query
        $sql = "select *from duvidas as d join aluno as a where d.ID_Aluno = '$id' and d.ID_Aluno = a.id_aluno;";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        $resultados = $select->fetchAll();
        //Se houver duvidas deste aluno
        if(count($resultados) > 0){
            foreach($resultados as $row){
                $id_duvida = $row['id'];
                $titulo = $row['titulo'];
                $texto = $row['texto'];
                $data = date("d/m/Y", strtotime($row['dt']));

                echo("<div class='duvida'><h2>".$titulo."</h2><hr><p>".$texto."</p><hr><span id='data'>Data: ".$data."</span>
                <a href='respostas.php?id_d=$id_duvida'><span id='respostas'><button type='button' class='btn-respostas'>Ver Respostas</button></a>
                </span></div>");
            }
        }
        //se o aluno não estiver duvidas deixe em branco
        else{
            echo("");
        }
    }

    //Exibi todas as resposta dos administradores referente a duvida
    public function duvida($id_duvida){
        //Instanciar Banco
        $banco = new Banco();
        //Query
        $sql = "select *from duvidas as d where d.id = '$id_duvida';";
        //preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        $duvida = $select->fetchAll();
        //Se a duvida ainda existir
        if($duvida){
            foreach($duvida as $row){
                $titulo = $row['titulo'];
                $texto = $row['texto'];
                $data = date("d/m/Y", strtotime($row['dt']));
            }
            echo("<br><div class='duvida'><h2>".$titulo."</h2><hr><p>".$texto."</p></div><hr>");
        }
    }
}


?>