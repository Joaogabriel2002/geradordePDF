CREATE TABLE transbordo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    codigo INT NOT NULL,
    descricao VARCHAR(400) NOT NULL,
    quantidade INT NOT NULL,
    lote VARCHAR(30) NOT NULL,
    outros INT NOT NULL,
    observacao VARCHAR(400),
    usuario_id INT,  -- FK para usuarios.id
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
