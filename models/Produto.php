<?php
// models/Produto.php
class Produto extends BaseModel {
    public $id;
    public $nome;
    public $preco_base;
    public $descricao;

    public function criar() {
        $stmt = $this->query(
            "INSERT INTO produtos (nome, preco_base, descricao) VALUES (?, ?, ?)",
            [$this->nome, $this->preco_base, $this->descricao]
        );
        return $stmt ? $stmt->insert_id : false;
    }

    public function atualizar() {
        return $this->query(
            "UPDATE produtos SET nome = ?, preco_base = ?, descricao = ? WHERE id = ?",
            [$this->nome, $this->preco_base, $this->descricao, $this->id]
        );
    }

    public static function buscarPorId($id) {
        $model = new self();
        $stmt = $model->query("SELECT * FROM produtos WHERE id = ?", [$id]);
        return $stmt->get_result()->fetch_object();
    }

    public static function listar() {
        $model = new self();
        $result = $model->query("SELECT * FROM produtos");
        return $result->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>