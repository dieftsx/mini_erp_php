<?php
// models/Variacao.php
class Variacao extends BaseModel {
    public $id;
    public $produto_id;
    public $nome;
    public $preco_adicional;
    public $estoque;

    public function salvar() {
        if ($this->id) {
            return $this->query(
                "UPDATE variacoes SET nome = ?, preco_adicional = ?, estoque = ? WHERE id = ?",
                [$this->nome, $this->preco_adicional, $this->estoque, $this->id]
            );
        } else {
            $stmt = $this->query(
                "INSERT INTO variacoes (produto_id, nome, preco_adicional, estoque) VALUES (?, ?, ?, ?)",
                [$this->produto_id, $this->nome, $this->preco_adicional, $this->estoque]
            );
            return $stmt ? $stmt->insert_id : false;
        }
    }

    public static function buscarPorProduto($produto_id) {
        $model = new self();
        $stmt = $model->query("SELECT * FROM variacoes WHERE produto_id = ?", [$produto_id]);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function buscarPorId($id) {
        $model = new self();
        $stmt = $model->query("SELECT * FROM variacoes WHERE id = ?", [$id]);
        return $stmt->get_result()->fetch_object();
    }

    public function atualizarEstoque($quantidade) {
        return $this->query(
            "UPDATE variacoes SET estoque = estoque + ? WHERE id = ?",
            [$quantidade, $this->id]
        );
    }
}
?>