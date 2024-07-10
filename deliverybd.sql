-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS deliverybd;

-- Crear la base de datos
CREATE DATABASE deliverybd;
USE deliverybd;

-- Crear tablas sin dependencias primero
CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    celular VARCHAR(20),
    tipo VARCHAR(20) NOT NULL,
    dni_ruc VARCHAR(20) UNIQUE
);

CREATE TABLE Pago (
    id INT PRIMARY KEY AUTO_INCREMENT,
    monto DECIMAL(10,2) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    metodo VARCHAR(50) NOT NULL
);

CREATE TABLE Contraentrega (
    id INT PRIMARY KEY AUTO_INCREMENT,
    costo_delivery DECIMAL(10,2) NOT NULL,
    costo_pedido DECIMAL(10,2) NOT NULL
);

CREATE TABLE Inconveniente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    foto_prueba LONGBLOB
);

CREATE TABLE Calificacion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    puntaje INT NOT NULL,
    comentario TEXT
);

-- Crear tablas con dependencias de Usuario
CREATE TABLE Repartidor (
    id INT PRIMARY KEY,
    tipo_transporte VARCHAR(50) NOT NULL,
    placa VARCHAR(20),
    FOREIGN KEY (id) REFERENCES Usuario(id) ON DELETE CASCADE
);

CREATE TABLE EmpresaCliente (
    id INT PRIMARY KEY,
    direccion VARCHAR(255) NOT NULL,
    razon_social VARCHAR(255) NOT NULL,
    FOREIGN KEY (id) REFERENCES Usuario(id) ON DELETE CASCADE
);

CREATE TABLE Administrador (
    id INT PRIMARY KEY,
    cod_admin VARCHAR(50) UNIQUE NOT NULL,
    FOREIGN KEY (id) REFERENCES Usuario(id) ON DELETE CASCADE
);

CREATE TABLE Destinatario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dni VARCHAR(10),
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    celular VARCHAR(15)
);

-- Crear tablas Recojo y Entrega con dependencias de Delivery, Repartidor, Inconveniente y Calificacion
CREATE TABLE Recojo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_repartidor INT,
    direccion VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME,
    estado VARCHAR(50) NOT NULL,
    id_inconveniente INT,
    FOREIGN KEY (id_repartidor) REFERENCES Repartidor(id) ON DELETE SET NULL,
    FOREIGN KEY (id_inconveniente) REFERENCES Inconveniente(id) ON DELETE SET NULL
);

CREATE TABLE Entrega (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_repartidor INT,
    direccion VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME,
    estado VARCHAR(50) NOT NULL,
    foto_entrega LONGBLOB,
    id_inconveniente INT,
    id_calificacion INT,
    FOREIGN KEY (id_repartidor) REFERENCES Repartidor(id) ON DELETE SET NULL,
    FOREIGN KEY (id_inconveniente) REFERENCES Inconveniente(id) ON DELETE SET NULL,
    FOREIGN KEY (id_calificacion) REFERENCES Calificacion(id) ON DELETE SET NULL
);

-- Crear tabla Delivery con dependencias de EmpresaCliente, Repartidor, Pago y Contraentrega
CREATE TABLE Delivery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT NOT NULL,
    cod_seguimiento VARCHAR(50) UNIQUE,
    fecha_solicitud DATETIME NOT NULL,
    id_recojo INT UNIQUE,
    id_entrega INT UNIQUE,
    id_pago INT UNIQUE,
    id_contraentrega INT UNIQUE,
    id_cliente INT,
    id_destinatario INT UNIQUE,
    FOREIGN KEY (id_cliente) REFERENCES EmpresaCliente(id) ON DELETE SET NULL,
    FOREIGN KEY (id_recojo) REFERENCES Recojo(id) ON DELETE SET NULL,
    FOREIGN KEY (id_entrega) REFERENCES Entrega(id) ON DELETE SET NULL,
    FOREIGN KEY (id_pago) REFERENCES Pago(id) ON DELETE SET NULL,
    FOREIGN KEY (id_contraentrega) REFERENCES Contraentrega(id) ON DELETE SET NULL,
    FOREIGN KEY (id_destinatario) REFERENCES Destinatario(id) ON DELETE SET NULL
);

DELIMITER //

CREATE TRIGGER eliminar_delivery
BEFORE DELETE ON Delivery
FOR EACH ROW
BEGIN
    DELETE FROM Recojo WHERE id = OLD.id_recojo;
    DELETE FROM Entrega WHERE id = OLD.id_entrega;
    DELETE FROM Pago WHERE id = OLD.id_pago;
    DELETE FROM Contraentrega WHERE id = OLD.id_contraentrega;
    DELETE FROM Destinatario WHERE id = OLD.id_destinatario;
END//

DELIMITER ;

-- Usuario
INSERT INTO Usuario (id, nombres, apellidos, email, password, celular, tipo, dni_ruc) VALUES
(1, 'Juan', 'Pérez', 'juan@email.com', 'pass123', '123456789', 'cliente', '12345678'),
(2, 'Ana', 'Gómez', 'ana@email.com', 'pass456', '987654321', 'repartidor', '87654321'),
(3, 'Carlos', 'López', 'carlos@email.com', 'pass789', '456789123', 'administrador', '23456789'),
(4, 'María', 'Rodríguez', 'maria@email.com', 'pass321', '789123456', 'cliente', '34567890'),
(5, 'Pedro', 'Martínez', 'pedro@email.com', 'pass654', '321654987', 'repartidor', '45678901');

-- Pago
INSERT INTO Pago (id, monto, estado, metodo) VALUES
(1, 100.50, 'completado', 'tarjeta'),
(2, 75.25, 'pendiente', 'efectivo'),
(3, 150.00, 'completado', 'transferencia'),
(4, 200.75, 'completado', 'tarjeta'),
(5, 50.00, 'pendiente', 'efectivo');

-- Contraentrega
INSERT INTO Contraentrega (id, costo_delivery, costo_pedido) VALUES
(1, 10.00, 90.50),
(2, 15.00, 60.25),
(3, 20.00, 130.00),
(4, 12.50, 188.25),
(5, 8.00, 42.00);

-- Inconveniente
INSERT INTO Inconveniente (id, descripcion) VALUES
(1, 'Dirección incorrecta'),
(2, 'Cliente ausente'),
(3, 'Paquete dañado'),
(4, 'Retraso en la entrega'),
(5, 'Problema con el pago');

-- Calificacion
INSERT INTO Calificacion (id, puntaje, comentario) VALUES
(1, 5, 'Excelente servicio'),
(2, 4, 'Buena entrega'),
(3, 3, 'Servicio regular'),
(4, 5, 'Muy rápido y eficiente'),
(5, 2, 'Entrega tardía');

-- Repartidor
INSERT INTO Repartidor (id, tipo_transporte, placa) VALUES
(1, 'moto', 'DEF456'),
(2, 'moto', 'ABC123'),
(3, 'bicicleta', NULL),
(4, 'carro', 'XYZ789'),
(5, 'bicicleta', NULL);

-- EmpresaCliente
INSERT INTO EmpresaCliente (id, direccion, razon_social) VALUES
(1, 'Calle Principal 123', 'Empresa A S.A.C.'),
(2, 'Avenida Central 456', 'Compañía B E.I.R.L.'),
(3, 'Jirón Comercial 789', 'Negocio C S.R.L.'),
(4, 'Pasaje Industrial 321', 'Corporación D S.A.'),
(5, 'Boulevard Empresarial 654', 'Emprendimiento E S.A.C.');

-- Administrador
INSERT INTO Administrador (id, cod_admin) VALUES
(1, 'ADMIN001'),
(2, 'ADMIN002'),
(3, 'ADMIN003'),
(4, 'ADMIN004'),
(5, 'ADMIN005');

-- Destinatario
INSERT INTO Destinatario (id, dni, nombres, apellidos, email, celular) VALUES
(1, '2324314', 'Luis', 'García', 'luis@email.com', '111222333'),
(2, '4534353', 'Elena', 'Fernández', 'elena@email.com', '444555666'),
(3, '4443521', 'Roberto', 'Sánchez', 'roberto@email.com', '777888999'),
(4, '4356223', 'Carmen', 'Díaz', 'carmen@email.com', '000111222'),
(5, '4784665', 'Javier', 'Torres', 'javier@email.com', '333444555');

-- Recojo
INSERT INTO Recojo (id, id_repartidor, direccion, fecha, hora, estado, id_inconveniente) VALUES
(1, 2, 'Almacén Central 1', '2024-06-29', '09:00:00', 'completado', NULL),
(2, 5, 'Tienda Principal 2', '2024-06-29', '10:30:00', 'en proceso', NULL),
(3, 4, 'Depósito 3', '2024-06-29', '11:45:00', 'pendiente', NULL),
(4, 1, 'Sucursal 4', '2024-06-29', '13:15:00', 'completado', NULL),
(5, 3, 'Oficina 5', '2024-06-29', '14:30:00', 'en proceso', NULL);

-- Entrega
INSERT INTO Entrega (id, id_repartidor, direccion, fecha, hora, estado, id_inconveniente, id_calificacion) VALUES
(1, 2, 'Calle Destino 1', '2024-06-29', '11:00:00', 'completado', NULL, NULL),
(2, 5, 'Avenida Llegada 2', '2024-06-29', '12:30:00', 'en camino', NULL, NULL),
(3, 4, 'Jirón Entrega 3', '2024-06-29', '14:00:00', 'pendiente', NULL, NULL),
(4, 1, 'Pasaje Recepción 4', '2024-06-29', '15:30:00', 'completado', NULL, NULL),
(5, 3, 'Boulevard Final 5', '2024-06-29', '16:45:00', 'en camino', NULL, NULL);

-- Delivery
INSERT INTO Delivery (id, descripcion, cod_seguimiento, fecha_solicitud, id_recojo, id_entrega, id_pago, id_contraentrega, id_cliente, id_destinatario) VALUES
(1, 'Paquete pequeño', 'DEL001', '2024-06-29 08:00:00', 1, 1, 1, 1, 1, 1),
(2, 'Documento urgente', 'DEL002', '2024-06-29 09:30:00', 2, 2, 2, 2, 2, 2),
(3, 'Caja mediana', 'DEL003', '2024-06-29 10:45:00', 3, 3, 3, 3, 3, 3),
(4, 'Sobre confidencial', 'DEL004', '2024-06-29 12:15:00', 4, 4, 4, 4, 4, 4),
(5, 'Paquete grande', 'DEL005', '2024-06-29 13:30:00', 5, 5, 5, 5, 5, 5);
