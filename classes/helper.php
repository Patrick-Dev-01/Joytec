<?php

// a classe HELPER ajudará a reutilizar alguns codigos se possivel

class Helper{
    //exibir todas as respostas dos administradores
    public function respostas($id_d){
        //instanciar banco
        $banco = new Banco();
        //exibir as respostas referentes a esta duvida
        $sql = "select *from respostas as r join duvidas as d join administrador as ad where r.Id_duvida = '$id_d' 
        and r.id_duvida = d.id and r.Id_admin = ad.id_admin order by id_resposta";
        //preparar Query
        $respostas = $banco->connect()->prepare($sql);
        //Query
        $respostas->execute();
        $resultados = $respostas->fetchAll();
        //se houverem respostas dos administradores
        if(count($resultados) > 0){
            foreach($resultados as $row){
                $nomeAdmin = $row['nome'];
                $sobrenomeAdmin = $row['sobrenome'];
                $resposta = $row['resposta'];
                $data = date("d/m/Y", strtotime($row['dt_resposta']));
                echo("<span id='nome-adm'><div id='adm'>".$nomeAdmin."<br>".$sobrenomeAdmin."</div><br><small>Administrador(a)</small>
                </span><div class='resposta'><p>".$resposta."</p><hr><p><strong>@Equipe da Joytec: </strong>".$data."</p></div><br>
                <br><hr>");
            }
        }

        else{
            echo("Esta duvida ainda não foi respondida");
        }
    }
}

?>