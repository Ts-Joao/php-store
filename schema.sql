-- ========================================================
-- Script de Criação do Banco de Dados, Tabelas e Trigger
-- Sistema: CRUD de Produtos com Histórico de Alterações
-- ========================================================

CREATE DATABASE IF NOT EXISTS estoque_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE estoque_db;

-- 1. Tabela produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabela historico_alteracoes
CREATE TABLE IF NOT EXISTS historico_alteracoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    data_alteracao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    campo_alterado VARCHAR(50) NOT NULL,
    valor_antigo TEXT NULL,
    valor_novo TEXT NULL,
    CONSTRAINT fk_historico_produtos 
        FOREIGN KEY (id_produto) REFERENCES produtos(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Trigger para registrar modificações campo a campo
DELIMITER $$

DROP TRIGGER IF EXISTS trg_produto_update$$

CREATE TRIGGER trg_produto_update
AFTER UPDATE ON produtos
FOR EACH ROW
BEGIN
    -- Verifica campo 'nome'
    IF NOT (OLD.nome <=> NEW.nome) THEN
        INSERT INTO historico_alteracoes (id_produto, data_alteracao, campo_alterado, valor_antigo, valor_novo)
        VALUES (OLD.id, NOW(), 'nome', OLD.nome, NEW.nome);
    END IF;

    -- Verifica campo 'descricao'
    IF NOT (OLD.descricao <=> NEW.descricao) THEN
        INSERT INTO historico_alteracoes (id_produto, data_alteracao, campo_alterado, valor_antigo, valor_novo)
        VALUES (OLD.id, NOW(), 'descricao', OLD.descricao, NEW.descricao);
    END IF;

    -- Verifica campo 'preco'
    IF NOT (OLD.preco <=> NEW.preco) THEN
        INSERT INTO historico_alteracoes (id_produto, data_alteracao, campo_alterado, valor_antigo, valor_novo)
        VALUES (OLD.id, NOW(), 'preco', CAST(OLD.preco AS CHAR), CAST(NEW.preco AS CHAR));
    END IF;

    -- Verifica campo 'quantidade'
    IF NOT (OLD.quantidade <=> NEW.quantidade) THEN
        INSERT INTO historico_alteracoes (id_produto, data_alteracao, campo_alterado, valor_antigo, valor_novo)
        VALUES (OLD.id, NOW(), 'quantidade', CAST(OLD.quantidade AS CHAR), CAST(NEW.quantidade AS CHAR));
    END IF;
END$$

DELIMITER ;

