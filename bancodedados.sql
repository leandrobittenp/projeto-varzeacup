CREATE TABLE times (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100),
    partidas_jogadas INT DEFAULT 0,
    vitorias INT DEFAULT 0,
    empates INT DEFAULT 0,
    derrotas INT DEFAULT 0,
    pontuacao INT DEFAULT 0
);

CREATE TABLE partidas (
    id SERIAL PRIMARY KEY,
    time_casa_id INT REFERENCES times(id) on delete cascade,
    time_visitante_id INT REFERENCES times(id) on delete cascade,
    gols_time_casa INT,
    gols_time_visitante INT,
    CONSTRAINT partidas_times_check CHECK (time_casa_id <> time_visitante_id)
);