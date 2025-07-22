<?php
// controllers/ProdutoController.php
class ProdutoController {
    public function index() {
        $produtos = Produto::listar();
        include 'views/produtos/index.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto = new Produto();
            $produto->id = $_POST['id'] ?? null;
            $produto->nome = $_POST['nome'];
            $produto->preco_base = $_POST['preco_base'];
            $produto->descricao = $_POST['descricao'] ?? '';

            if ($produto->id) {
                $produto->atualizar();
            } else {
                $produto->id = $produto->criar();
            }

            // Processar variações
            if (isset($_POST['variacoes'])) {
                foreach ($_POST['variacoes'] as $variacaoData) {
                    $variacao = new Variacao();
                    $variacao->id = $variacaoData['id'] ?? null;
                    $variacao->produto_id = $produto->id;
                    $variacao->nome = $variacaoData['nome'];
                    $variacao->preco_adicional = $variacaoData['preco_adicional'];
                    $variacao->estoque = $variacaoData['estoque'];
                    $variacao->salvar();
                }
            }

            header('Location: /produto');
            exit;
        }
    }

    public function editar() {
        $id = $_GET['id'] ?? 0;
        $produto = Produto::buscarPorId($id);
        $variacoes = Variacao::buscarPorProduto($id);
        include 'views/produtos/form.php';
    }

    public function comprar() {
        $id = $_GET['id'] ?? 0;
        $produto = Produto::buscarPorId($id);
        $variacoes = Variacao::buscarPorProduto($id);
        include 'views/produtos/comprar.php';
    }
}
?>