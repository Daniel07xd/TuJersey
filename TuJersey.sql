CREATE DATABASE TuJersey;
USE TuJersey;

CREATE TABLE usuarios (
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL,
apellido_paterno VARCHAR(50) NOT NULL,
apellido_materno VARCHAR(50) NOT NULL,
email VARCHAR(100) UNIQUE NOT NULL,
contrasena VARCHAR(255) NOT NULL,
rol ENUM('admin', 'cliente') DEFAULT 'cliente',
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorias (
id_categoria INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL
);

CREATE TABLE productos (
id_producto INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(100) NOT NULL,
precio DECIMAL(10,2) NOT NULL,
stock INT NOT NULL DEFAULT 0,
id_categoria INT,
imagen VARCHAR(255) NULL,
activo BOOLEAN DEFAULT TRUE,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
ON DELETE SET NULL
ON UPDATE CASCADE
);

CREATE TABLE carritos (
id_carrito INT PRIMARY KEY AUTO_INCREMENT,
id_usuario INT NOT NULL,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
estado ENUM('activo', 'comprado') DEFAULT 'activo',
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
ON DELETE CASCADE
);

CREATE TABLE carrito_items (
id_item INT PRIMARY KEY AUTO_INCREMENT,
id_carrito INT NOT NULL,
id_producto INT NOT NULL,
cantidad INT NOT NULL DEFAULT 1,
FOREIGN KEY (id_carrito) REFERENCES carritos(id_carrito)
ON DELETE CASCADE,
FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
ON DELETE CASCADE
);

CREATE TABLE ordenes (
id_orden INT PRIMARY KEY AUTO_INCREMENT,
id_usuario INT NOT NULL,
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
total DECIMAL(10,2) NOT NULL DEFAULT 0,
estado ENUM('pendiente', 'pagado', 'enviado', 'entregado', 'cancelado') DEFAULT 'pendiente',
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
ON DELETE CASCADE
);

CREATE TABLE orden_detalle (
id_detalle INT PRIMARY KEY AUTO_INCREMENT,
id_orden INT NOT NULL,
id_producto INT NOT NULL,
cantidad INT NOT NULL,
precio_unitario DECIMAL(10,2) NOT NULL,
FOREIGN KEY (id_orden) REFERENCES ordenes(id_orden)
ON DELETE CASCADE,
FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
ON DELETE CASCADE
);

DELIMITER $$

CREATE TRIGGER disminuir_stock
AFTER INSERT ON orden_detalle
FOR EACH ROW
BEGIN
UPDATE productos
SET stock = stock - NEW.cantidad
WHERE id_producto = NEW.id_producto;
END $$


CREATE TRIGGER validar_stock
BEFORE INSERT ON orden_detalle
FOR EACH ROW
BEGIN
DECLARE stock_actual INT;
SELECT stock INTO stock_actual
FROM productos
WHERE id_producto = NEW.id_producto;
IF stock_actual < NEW.cantidad THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Stock insuficiente';
END IF;
END $$

CREATE TRIGGER calcular_total_orden
AFTER INSERT ON orden_detalle
FOR EACH ROW
BEGIN
UPDATE ordenes
SET total = (
SELECT SUM(cantidad * precio_unitario)
FROM orden_detalle
WHERE id_orden = NEW.id_orden
)
WHERE id_orden = NEW.id_orden;
END $$

CREATE TRIGGER cerrar_carrito
AFTER INSERT ON ordenes
FOR EACH ROW
BEGIN
UPDATE carritos
SET estado = 'comprado'
WHERE id_usuario = NEW.id_usuario
AND estado = 'activo';
END $$

CREATE TRIGGER set_precio_unitario
BEFORE INSERT ON orden_detalle
FOR EACH ROW
BEGIN
DECLARE precio_actual DECIMAL(10,2);
SELECT precio INTO precio_actual
FROM productos
WHERE id_producto = NEW.id_producto;
SET NEW.precio_unitario = precio_actual;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE crear_carrito(IN usuario_id INT)
BEGIN
IF NOT EXISTS (
SELECT 1 FROM carritos 
WHERE id_usuario = usuario_id AND estado = 'activo'
) THEN
INSERT INTO carritos (id_usuario, estado)
VALUES (usuario_id, 'activo');
END IF;
END $$

DELIMITER ;

INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, email, contrasena, rol)
VALUES
('Juan', 'Pérez', 'López', 'juan@gmail.com', 'JPerezL2026', 'cliente'),
('Ana', 'García', 'Martínez', 'ana@gmail.com', 'AGarcíaM2026', 'cliente'),
('Daniel', 'Admin', 'Root', 'admin@tujersey.com', 'AdminDaniel1234', 'admin');

INSERT INTO categorias (nombre)
VALUES
('Local'),
('Visitante'),
('Edición Especial');

INSERT INTO productos (nombre, precio, stock, id_categoria, imagen)
VALUES
('Jersey Tigres Local 2025', 1299.99, 10, 2, 'Images/JerseyTigresLocal.jpg'),
('Jersey Rayados Local 2025', 1350.00, 18, 1, 'Images/JerseyRayadosLocal.jpg'),
('Jersey América Local 2025', 1499.99, 20, 1, 'Images/JerseyAmericaLocal.jpg'),
('Jersey Chivas Local 2025', 1399.99, 15, 1, 'Images/JerseyChivasLocal.jpg'),
('Jersey Tigres Edición Especial 2025', 1599.99, 8, 3, 'Images/JerseyTigresEdicionEspecial.jpg');

INSERT INTO carritos (id_usuario, estado)
VALUES
(1, 'activo');

INSERT INTO carrito_items (id_carrito, id_producto, cantidad)
VALUES
(1, 1, 2),
(1, 2, 1);

INSERT INTO ordenes (id_usuario, estado)
VALUES
(1, 'pendiente');

INSERT INTO orden_detalle (id_orden, id_producto, cantidad)
VALUES
(1, 1, 2),
(1, 3, 1);