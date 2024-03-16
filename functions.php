<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"])) {
    // Verificar qual ação foi solicitada
    $acao = $_POST["acao"];
    if ($acao == "criar_time") {
        // Metodo criar time
        if (isset($_POST["nome"]) && !empty($_POST["nome"])) {
            $nome = $_POST["nome"];
            $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : null;
            $query = "INSERT INTO times (nome, cidade) VALUES ('$nome', '$cidade')";
            if ($db->query($query)) {
                header("Location: times.php");
                exit();
            } else {
                echo "Erro ao criar time.";
            }
        } else {
            echo "Nome do time é obrigatório.";
        }
    } elseif ($acao == "criar_partida") {
        // Metodo criar partida
        if (isset($_POST["time_casa"], $_POST["time_visitante"], $_POST["gols_time_casa"], $_POST["gols_time_visitante"])) {
            $time_casa_id = $_POST["time_casa"];
            $time_visitante_id = $_POST["time_visitante"];
            $gols_time_casa = $_POST["gols_time_casa"];
            $gols_time_visitante = $_POST["gols_time_visitante"];
            // Verificar resultado partida
            if ($gols_time_casa > $gols_time_visitante) {
                $resultado_casa = 'vitoria';
                $resultado_visitante = 'derrota';
            } elseif ($gols_time_casa < $gols_time_visitante) {
                $resultado_casa = 'derrota';
                $resultado_visitante = 'vitoria';
            } else {
                $resultado_casa = 'empate';
                $resultado_visitante = 'empate';
            }
            // Inserir partida no bd
            $query = "INSERT INTO partidas (time_casa_id, time_visitante_id, gols_time_casa, gols_time_visitante) VALUES ($time_casa_id, $time_visitante_id, $gols_time_casa, $gols_time_visitante)";
            if ($db->query($query)) {
                // Atualizar times jogam em casa
                $query_update_times = "UPDATE times SET partidas_jogadas = partidas_jogadas + 1";
                if ($resultado_casa == 'vitoria') {
                    $query_update_times .= ", vitorias = vitorias + 1";
                } elseif ($resultado_casa == 'empate') {
                    $query_update_times .= ", empates = empates + 1";
                } else {
                    $query_update_times .= ", derrotas = derrotas + 1";
                }
                $query_update_times .= " WHERE id = $time_casa_id";
                $db->query($query_update_times);

                // Atualizar times visitantes
                $query_update_times_visitantes = "UPDATE times SET partidas_jogadas = partidas_jogadas + 1";
                if ($resultado_visitante == 'vitoria') {
                    $query_update_times_visitantes .= ", vitorias = vitorias + 1";
                } elseif ($resultado_visitante == 'empate') {
                    $query_update_times_visitantes .= ", empates = empates + 1";
                } else {
                    $query_update_times_visitantes .= ", derrotas = derrotas + 1";
                }
                $query_update_times_visitantes .= " WHERE id = $time_visitante_id";
                $db->query($query_update_times_visitantes);

                header("Location: classificacao.php");
                exit();
            } else {
                echo "Erro ao criar partida.";
            }
        } else {
            echo "Dados da partida incompletos.";
        }
    } elseif ($acao == "excluir_time") {
        // Metodo excluir time
        if (isset($_POST["time_id"])) {
            $time_id = $_POST["time_id"];
            $query = "DELETE FROM times WHERE id = $time_id";
            if ($db->query($query)) {
                header("Location: times.php");
                exit();
            } else {
                echo "Erro ao excluir o time.";
            }
        } else {
            echo "ID do time não especificado.";
        }
    } elseif ($acao == "editar_time") {
        // Metodo editar time
        if (isset($_POST["time_id"], $_POST["nome"], $_POST["cidade"])) {
            $time_id = $_POST["time_id"];
            $nome = $_POST["nome"];
            $cidade = $_POST["cidade"];
            $query = "UPDATE times SET nome = '$nome', cidade = '$cidade' WHERE id = $time_id";
            if ($db->query($query)) {
                header("Location: times.php");
                exit();
            } else {
                echo "Erro ao editar o time.";
            }
        } else {
            echo "Dados do time incompletos.";
        }
    }elseif ($acao == "excluir_partida") {
        // Metodo excluir partida
        if (isset($_POST["partida_id"])) {
            $partida_id = $_POST["partida_id"];
            $query = "DELETE FROM partidas WHERE id = $partida_id";
            if ($db->query($query)) {
                header("Location: partidas.php");
                exit();
            } else {
                echo "Erro ao excluir partida.";
            }   
        }


    } elseif ($acao == "editar_partida") {
        // Método editar partida
        if (isset($_POST["partida_id"], $_POST["gols_time_casa"], $_POST["gols_time_visitante"])) {
            $partida_id = $_POST["partida_id"];
            $gols_time_casa = $_POST["gols_time_casa"];
            $gols_time_visitante = $_POST["gols_time_visitante"];
            $query = "UPDATE partidas SET gols_time_casa = $gols_time_casa, gols_time_visitante = $gols_time_visitante WHERE id = $partida_id";
            if ($db->query($query)) {
                header("Location: partidas.php");
                exit();
            } else {
                echo "Erro ao editar partida.";
            }
        }
    }

}

?>
