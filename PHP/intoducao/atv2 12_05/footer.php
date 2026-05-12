        <!-- Rodapé da página removido conforme solicitado -->
        </div>
    </main>

    <!-- Script para funcionalidade do tema -->
    <script>
        // Função para aplicar tema dinamicamente
        function aplicarTema(tema) {
            document.body.setAttribute('data-theme', tema);
        }

        // Aplicar tema inicial baseado na configuração PHP
        aplicarTema('<?php echo $tema_atual ?? 'light'; ?>');

        // Escutar mudanças no select de tema para mudança imediata
        document.addEventListener('DOMContentLoaded', function() {
            const selectTema = document.querySelector('select[name="tema"]');
            if (selectTema) {
                selectTema.addEventListener('change', function() {
                    aplicarTema(this.value);
                });
            }
        });
    </script>

</body>
</html>