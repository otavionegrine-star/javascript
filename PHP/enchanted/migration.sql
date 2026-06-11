-- Migração: Adicionar campos de endereço separados à tabela alugar_personagem
-- Execute este arquivo SQL para atualizar o banco de dados

ALTER TABLE alugar_personagem
DROP COLUMN IF EXISTS local_festa,
ADD COLUMN cidade VARCHAR(255),
ADD COLUMN bairro VARCHAR(255),
ADD COLUMN rua VARCHAR(255),
ADD COLUMN numero VARCHAR(4);

-- Se quiser adicionar restrição de NOT NULL depois de migrar os dados:
-- ALTER TABLE alugar_personagem
-- ALTER COLUMN cidade SET NOT NULL,
-- ALTER COLUMN bairro SET NOT NULL,
-- ALTER COLUMN rua SET NOT NULL,
-- ALTER COLUMN numero SET NOT NULL;
