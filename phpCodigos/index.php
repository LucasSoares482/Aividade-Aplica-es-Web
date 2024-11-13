<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Clientes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f0f2f5;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #1a73e8;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #1a73e8;
            color: white;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .sucesso {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .filtro {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .btn {
            background-color: #1a73e8;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #1557b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Clientes</h1>
        
        <?php
        require_once 'conexao.php';
        
        $filtroIdade = isset($_GET['filtro']) && $_GET['filtro'] === 'adultos';
        
        echo "<div class='filtro'>";
        echo "<a href='index.php' class='btn'>Todos os Clientes</a> ";
        echo "<a href='index.php?filtro=adultos' class='btn'>Maiores de 18</a>";
        echo "</div>";
        
        try {
            $sql = "SELECT * FROM cliente";
            if ($filtroIdade) {
                $sql .= " WHERE idade > 18";
            }
            
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Idade</th><th>Outros campos...</th></tr>";
            
            foreach ($result as $item) {
                echo "<tr>";
                echo "<td>" . $item->id . "</td>";
                echo "<td>" . $item->nome . "</td>";
                echo "<td>" . $item->idade . "</td>";
                echo "<td>...</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            
        } catch(PDOException $e) {
            echo "<div class='erro'>Erro ao consultar dados: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
</body>
</html>