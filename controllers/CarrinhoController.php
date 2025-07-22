<?php
// controllers/CarrinhoController.php
class CarrinhoController {
    public function adicionar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $variacao_id = $_POST['variacao_id'];
            $quantidade = $_POST['quantidade'];
            
            $variacao = Variacao::buscarPorId($variacao_id);
            
            if ($variacao && $variacao->estoque >= $quantidade) {
                if (!isset($_SESSION['carrinho'])) {
                    $_SESSION['carrinho'] = [];
                }
                
                // Adiciona ou atualiza item no carrinho
                if (isset($_SESSION['carrinho'][$variacao_id])) {
                    $_SESSION['carrinho'][$variacao_id]['quantidade'] += $quantidade;
                } else {
                    $_SESSION['carrinho'][$variacao_id] = [
                        'produto_id' => $variacao->produto_id,
                        'nome' => $variacao->nome,
                        'preco' => $variacao->preco_adicional + Produto::buscarPorId($variacao->produto_id)->preco_base,
                        'quantidade' => $quantidade
                    ];
                }
                
                // Atualiza estoque temporário
                $variacao->estoque -= $quantidade;
            }
            
            header('Location: /carrinho');
            exit;
        }
    }

    public function index() {
        $carrinho = $_SESSION['carrinho'] ?? [];
        $subtotal = $this->calcularSubtotal($carrinho);
        $frete = $this->calcularFrete($subtotal);
        $cupons = Cupom::listarAtivos();
        
        include 'views/carrinho/index.php';
    }

    public function remover() {
        $id = $_GET['id'] ?? 0;
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
        header('Location: /carrinho');
        exit;
    }

    public function finalizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validações e processamento
            $pedido = new Pedido();
            $pedido->subtotal = $_POST['subtotal'];
            $pedido->desconto = $_POST['desconto'] ?? 0;
            $pedido->frete = $_POST['frete'];
            $pedido->total = $_POST['total'];
            $pedido->cep = $_POST['cep'];
            $pedido->endereco = $_POST['endereco'];
            $pedido->email_cliente = $_POST['email'];
            $pedido->criar();
            
            // Enviar e-mail
            $this->enviarEmailConfirmacao($pedido);
            
            // Limpar carrinho
            unset($_SESSION['carrinho']);
            
            include 'views/carrinho/sucesso.php';
        }
    }

    private function calcularSubtotal($carrinho) {
        return array_reduce($carrinho, fn($sum, $item) => $sum + ($item['preco'] * $item['quantidade']), 0);
    }

    private function calcularFrete($subtotal) {
        if ($subtotal > 200) return 0;
        if ($subtotal >= 52 && $subtotal <= 166.59) return 15;
        return 20;
    }

    private function enviarEmailConfirmacao($pedido) {
        // Implementação simplificada
        $to = $pedido->email_cliente;
        $subject = "Confirmação de Pedido #{$pedido->id}";
        $message = "Seu pedido foi confirmado!\nTotal: R$ {$pedido->total}";
        mail($to, $subject, $message);
    }
}
?>