<?php
// models/Cupom.php
class Cupom extends BaseModel {
    public $id;
    public $codigo;
    public $desconto_percentual;
    public $valor_minimo;
    public $data_validade;
    public $ativo = 1;

    public function salvar() {
        if ($this->id) {
            return $this->query(
                "UPDATE cupons SET codigo = ?, desconto_percentual = ?, valor_minimo = ?, data_validade = ?, ativo = ? WHERE id = ?",
                [$this->codigo, $this->desconto_percentual, $this->valor_minimo, $this->data_validade, $this->ativo, $this->id]
            );
        } else {
            $stmt = $this->query(
                "INSERT INTO cupons (codigo, desconto_percentual, valor_minimo, data_validade, ativo) VALUES (?, ?, ?, ?, ?)",
                [$this->codigo, $this->desconto_percentual, $this->valor_minimo, $this->data_validade, $this->ativo]
            );
            return $stmt ? $stmt->insert_id : false;
        }
    }

    public static function buscarPorCodigo($codigo) {
        $model = new self();
        $stmt = $model->query("SELECT * FROM cupons WHERE codigo = ? AND ativo = 1", [$codigo]);
        return $stmt->get_result()->fetch_object();
    }

    public static function listarAtivos() {
        $model = new self();
        $result = $model->query("SELECT * FROM cupons WHERE ativo = 1");
        return $result->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>