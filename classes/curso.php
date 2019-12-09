<?php

require_once 'db.php';

class Curso{
    private $nome;
    private $descricao;
    private $grau;
    private $carga;
    private $imagem;

    // Metodos Setters
    private function setNome($n){ 
        $this->nome = $n;
    }

    private function setDescricao($d){
        $this->descricao = $d;
    }

    private function setGrau($g){
        $this->grau = $g;
    }

    private function setCarga($c){
        $this->carga = $c;
    }

    private function setImagem($i){
        $this->imagem = $i;
    }

    //Metodos Getters
    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getGrau(){
        return $this->grau;
    }

    public function getCarga(){
        return $this->carga;
    }

    public function getImagem(){
        return $this->imagem;
    }

    //Cadastrar curso
    protected function cadastrarCurso(){
        //Instaciar banco
        $banco = new Banco();
        //Query
        $sql = "insert into cursos (nome, descricao, grau, carga_horaria, imagem, dt_lancamento) values 
        ('".$this->getNome()."', '".$this->getDescricao()."', '".$this->getGrau()."', '".$this->getCarga()."'
        , '".$this->getImagem()."', sysdate());";
        //Preparar query
        $insert = $banco->connect()->prepare($sql);
        //Executar query
        $insert->execute();
    }

    //Alterar Curso
    public function updateCurso($icon, $i){
        //Instanciar Banco
        $banco = new Banco();
        //Query
        $sql = "update cursos set nome = '".$this->getNome()."', descricao = '".$this->getDescricao()."',  
        grau = '".$this->getGrau()."', carga_horaria = '".$this->getCarga()."' where id_curso = '$i';";
        //Preparar Query
        $update = $banco->connect()->prepare($sql);
        //Executar Query
        $update->execute();
    }

    //Deletar Curso
    public function deleteCurso($i){
        //instanciar curso
        $banco = new Banco();
        //apagar todos os alunos inscritos 
        $sql = "delete from aluno_cursos where Id_curso = '$i';";
        //Preparar Query
        $truncate = $banco->connect()->prepare($sql);
        //Execute query
        $truncate->execute();

        $sqlDel = "delete from cursos where id_curso = '$i';";
        //Preparar Query
        $delete = $banco->connect()->prepare($sqlDel);
        //Executar Query
        $delete->execute();

        echo("<script>alert('Curso deletado com Sucesso!'); window.location = '../admin_cursos.php?f='</script>");
    }

    //Validação
    public function validarCurso($no, $desc, $gr, $cg, $img){
        //instaciar Banco
        $banco = new Banco();

        //array de Erros, se houver erros de validação, eles serão inseridos dentro do array
        $erros = [];
        //Se o nome for vazio
        if(empty($no)){
            $erros[] = "Nome do Curso inválido";
        }
        //descrição for vazio
        if(empty($desc)){
            $erros[] = "Descrição Inválida";
        }
        //se a carga horária estiver vazia ou for menor ou igual a zero
        if(empty($cg) || $cg <= 0){
            $erros[] = "a Carga horária deve ser maior que 0";
        }
        //Se existir erros
        if($erros){
            //Mostre cada erro
            foreach($erros as $erro){
                echo("<script>alert('".$erro."')</script>");
            }
            echo("<script>history.go(-1)</script>");
        }

        //Se não, cadastre o curso
        else{
            $this->setNome($no);
            $this->setDescricao($desc);
            $this->setGrau($gr);
            $this->setCarga($cg);
            //Salvar caminho para cadastrar no banco de dados
            $this->setImagem($img);
            $this->cadastrarCurso();
            echo("<script>alert('Curso cadastrado com Sucesso!');window.location = '../novo_curso.php'</script>");
        }
    }

    //Listar Cursos disponiveis
    public function cursos($p){
        //Instanciar classe do Banco de dados
        $banco = new Banco();
        //Variavel '$sql' Global para poder funcionar em todas as condições
        $sql;
        //Se o parametro for vazio, selecione todos os cursos
        if(empty($p)){
            //Query
            $sql = "select *from cursos order by id_curso desc;";
        }
        //se Houver pesquisa (Parâmetros) faça o select de acordo com o filtro
        if(isset($p)){
            //Query
            $sql = "select *from cursos where nome like '%$p%';";
        }
        //Selecione os cursos de acordo com o grau
        if($p == "basico" || $p == "intermediario" || $p == "avancado"){
            //Query
            $sql = "select *from cursos where grau = '$p' order by id_curso desc;";
        }

        /* Selecionar por carga horaria */
        if($p == "20"){
            //Query
            $sql = "Select *from cursos where carga_horaria between 20 and 50 order by carga_horaria;";
        }

        if($p == "50"){
            //Query
            $sql = "Select *from cursos where carga_horaria between 50 and 90 order by carga_horaria;";
        }

        if($p == "90"){
            //Query
            $sql = "Select *from cursos where carga_horaria > 90 order by carga_horaria;";
        }

        /* filtro por data */
        if($p == "asc" || $p = "desc"){
            $sql = "select *from cursos order by id_curso $p;";
        }

        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //executar query
        $select->execute();
        //salvar os resultados encontrados
        $resultados = $select->fetchAll();
        
        //Pegar a sessão do aluno lgado
        if(isset($_SESSION['aluno_logado'])){
            $aluno = $_SESSION['aluno_logado'];
            //Pegar o id
            $sqlId = "Select id_aluno from aluno where id_aluno = '$aluno';";
            //Preparar Query
            $select = $banco->connect()->prepare($sqlId);
            //executar query
            $select->execute();
            //pegar registro do aluno
            $resultado = $select->fetchAll();
            foreach($resultado as $row){
                //Selecionar o id do aluno logado
                $idAluno = $row['id_aluno'];
            }
            $data = date("Y.m.d");
        } 
        //Se o resultado for maior que zero
        if(count($resultados) > 0){
            //Pegue cada campo desejado da tabela e mostre
            foreach($resultados as $row){
                $idCurso = $row['id_curso'];
                $curso = $row['nome'];
                $descricao = $row['descricao'];
                $grau = $row['grau'];
                $carga = $row['carga_horaria'];
                $icone = $row['imagem'];
                
                //se existir sessão o aluno poderá se inscrever no curso
                if(isset($idAluno)){
                    echo("<form action='models/iniciar.php' method='POST'><input type='hidden' name='id_a' value='$idAluno'>
                    <input type='hidden' name='id_c' value='$idCurso'><input type='hidden' name='inicio' value='$data'>
                    <div class='resultado'><img src='admin/img_cursos/".$icone."' id='curso-icon'>
                    <span id='curso-nome'>".$curso."</span><hr><p id='grade'>O que você verá neste Módulo: </p>
                    <small id='descricao'>".$descricao."</small><hr><p id='carga'>Carga Horária: ".$carga." hrs
                    <span id='grau'>Grau: ".$grau."</span></p></div>
                    <span class='inscrever-curso'><button type='submit' class='btn-inscrever'>se Inscrever no Curso</button></span></form><br>");
                }
                //Se não existir, ele será redirecionado a tela de Login
                else{
                    echo("<div class='resultado'><img src='admin/img_cursos/".$icone."' id='curso-icon'>
                    <span id='curso-nome'>".$curso."</span><hr><p id='grade'>O que você verá neste Módulo: </p>
                    <small id='descricao'>".$descricao."</small><hr><p id='carga'>Carga Horária: ".$carga." hrs
                    <span id='grau'>Grau: ".$grau."</span></p></div>
                    <a href='entrar.php'><span class='inscrever-curso'><button type='button' class='btn-inscrever'>se Inscrever no Curso</button>
                    </span></a><br>");
                }
            }
        }

        else{
            echo("Não a cursos disponiveis nesse filtro no momento");
        }
    }

    //Saber a quantidade de inscritos de cada curso e a porcentagem
    public function qtdinscritos(){
        //Instanciar banco
        $banco = new Banco();
        //Query
        $sql = "select id_curso, nome from cursos;";
        //Preparar Query
        $cursos = $banco->connect()->prepare($sql);
        //executar Query
        $cursos->execute();
        //guardar o numero de cursos cadastrados
        $resultados = $cursos->fetchAll();
        
        if(count($resultados) > 0){
            //Para cada curso
            foreach($resultados as $row){
                //guardar Id do curso
                $idCurso = $row['id_curso'];
                $nome = $row['nome'];
                //variavel $i recebe o id do curso, enquanto for menor que o numero de cursos adicione mais um 
                for($i = $idCurso; $i <= $idCurso; $i++){
                    //Query para contar quantos alunos estão inscritos em cada curso
                    $sql = "select count(Id_aluno) from aluno_cursos where Id_curso = '$idCurso';";
                    //Preparar Query
                    $cursos = $banco->connect()->prepare($sql);
                    //executar Query
                    $cursos->execute();
                    //Salvar os valores
                    $resultado = $cursos->fetchAll();
                    //para cada resultado guarde o total
                    foreach($resultado as $total){
                        //guardar o total
                        $tot = $total['count(Id_aluno)'];
                    }
                }
                //pegar a quantidade de alunos
                $sql = "select count(id_aluno) from aluno;";
                //Preparar Query
                $select = $banco->connect()->prepare($sql);
                //Executar Query
                $select->execute();
                //Guardar o total de alunos inscritos
                $qtdAlunos = $select->fetchAll();
                foreach($qtdAlunos as $total){
                    $tot_alunos = $total['count(id_aluno)'];
                }
//o Percentual é 100 X o total de alunos cadastrados no curso, dividido pelo numero de pessoas inscritas na instituição
                $percentual = 100 * $tot / $tot_alunos;
                //Arredondar numeros com virgula
                echo("<tr class='col'><td class='row'>".$nome."</td><td class='row'>".$tot."</td>
                <td class='row'>".$percentual."%</td></tr>");
            }
            echo("<p>Total de Alunos cadastrados na Joytec: ".$tot_alunos."</p>");
        }
    }

    //Pegar os 2 cursos lançados recentemente
    public function novosCursos(){
        //Insatanciar banco
        $banco = new Banco();
        //buscar os dois primeiros cursos lançados mais recentes
        $sql = "Select *from cursos order by id_curso desc LIMIT 2";
        //Preparar Query
        $lancamentos = $banco->connect()->prepare($sql);
        //Executar query
        $lancamentos->execute();
        $resultado = $lancamentos->fetchAll();
        //Se houver lançamentos
        if(count($resultado) > 0){
            foreach($resultado as $row){
                //Converter data no formato brasileiro
                $lancamento = date("d/m/Y", strtotime($row['dt_lancamento']));
                $nome = $row['nome'];
                echo("<strong id='c-data'>".$lancamento."</strong> - <small id='c-nome'>".$nome."</small><br><br>");
            }
        }
        //Se nao houver nenhum curso mostre essa mensagem
        else{
            echo("Nenhum Curso divulgado. Em breve estaremos lançando novos Cursos,
            continue acompanhando nosso Site!");
        }
    }

    public function todosLancamentos(){
        //Instanciar banco 
        $banco = new Banco();
        //pegar todos os lançamento da tabela de cursos
        $sql = "Select *from cursos order by id_curso desc;";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        //Pegar todos os registros
        $resultados = $select->fetchAll();
        //Se houver cursos
        if(count($resultados) > 0){
            foreach($resultados as $row){
                //Converter data no formato brasileiro
                $dt_lancamento = date("d/m/Y", strtotime($row['dt_lancamento']));
                $curso = $row['nome'];
                echo("<strong id='c-data'>".$dt_lancamento."</strong> - <small id='c-nome'>".$curso."</small><br><br>");
            }
        }

        else{
            echo("<p>Não há cursos lançados no momento</p>");
        }
    }

    public function dadosCurso($i){
        //Instanciar Banco
        $banco = new Banco();
        //Query
        $sql = "select *from cursos where id_curso = '$i';";
        //Preparar Query
        $select = $banco->connect()->prepare($sql);
        //Executar Query
        $select->execute();
        $resultado = $select->fetchAll();
        //Se o curso for encontrado
        if(count($resultado) > 0){
            foreach($resultado as $row){
                $id_curso = $row['id_curso'];
                $nome = $row['nome'];
                $descricao = $row['descricao'];
                $grau = $row['grau'];
                $carga = $row['carga_horaria'];
            }
        //Armazenando os valores do banco nos setters, para os getters mostrarem como eles estao cadastrados
            $this->setNome($nome);
            $this->setDescricao($descricao);
            $this->setGrau($grau);
            $this->setCarga($carga);
        }

        else{
            echo("Curso não encontrado ou Inexistente");
        }
    }

    //Validar as alterações
    public function validarEdicao($id_c, $no, $desc, $cg, $gr, $icon){
        //array de Erros, se houver erros de validação, eles serão inseridos dentro do array
        $erros = [];
        //Se o nome for vazio
        if(empty($no)){
            $erros[] = "Nome do Curso inválido";
        }
        //descrição for vazio
        if(empty($desc)){
            $erros[] = "Descrição Inválida";
        }
        //se a carga horária estiver vazia ou for menor ou igual a zero
        if(empty($cg) || $cg <= 0){
            $erros[] = "a Carga horária deve ser maior que 0";
        }
        //Se existir erros
        if($erros){
            //Mostre cada erro
            foreach($erros as $erro){
                echo("<script>alert('".$erro."')</script>");
            }
            echo("<script>history.go(-1)</script>");
        }
 
        //Se não, salve as alterações feitas no curso
        else{
            $this->setNome($no);
            $this->setDescricao($desc);
            $this->setGrau($gr);
            $this->setCarga($cg);
            //Atualize as informações
            $this->updateCurso($id_c);
        }
    }
}

?>