<!-- views/layout/footer.php -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Busca de CEP
        document.getElementById('buscarCep').addEventListener('click', function() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length !== 8) return;
            
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('endereco').value = 
                            `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                    }
                });
        });
    </script>
</body>
</html>