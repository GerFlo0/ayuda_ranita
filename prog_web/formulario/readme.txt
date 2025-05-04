holi :3
esta es la instruccion que usé para crear la tabla en la base de datos mysql (default)


CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contrasena TEXT
);
