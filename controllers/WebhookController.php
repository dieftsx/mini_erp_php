<?php
// controllers/WebhookController.php
class WebhookController {
    public function status() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if (isset($data['id'], $data['status'])) {
            Pedido::atualizarStatus($data['id'], $data['status']);
        }
        
        http_response_code(200);
        echo json_encode(['success' => true]);
    }
}
?>