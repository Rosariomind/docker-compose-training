CREATE TABLE IF NOT EXISTS person_pg (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO person_pg (name) VALUES
('Postgres William'),
('Postgres Marc'),
('Postgres John');
