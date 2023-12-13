CREATE DATABASE Inventario;

USE Inventario;
CREATE TABLE Cliente(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    Direccion VARCHAR(30) NOT NULL,
    Telefono INT(9) NOT NULL
);

CREATE TABLE Proveedor(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    Direccion VARCHAR(30) NOT NULL,
	Telefono INT(9) NOT NULL,
    PaginaWeb VARCHAR(30) 
);

CREATE TABLE Categoria(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    Descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE Producto(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    Precio DECIMAL(8,2) NOT NULL,
    Stock INT NOT NULL,
    CodigoC INT,
    CodigoPr INT,
    FOREIGN KEY (CodigoC) REFERENCES Categoria(Codigo),
    FOREIGN KEY (CodigoPr) REFERENCES Proveedor(Codigo)
);

CREATE TABLE Venta(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    CodCliente INT NOT NULL,
    Fecha DATE NOT NULL,
    Descuento DECIMAL(5,4) DEFAULT 0.00,
    MontoFinal DECIMAL(8,2),
    FOREIGN KEY (CodCliente) REFERENCES Cliente(Codigo)
);


CREATE TABLE Venta_Producto(
	Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Cantidad INT NOT NULL,
    Precio DECIMAL(8,2),
    CodigoV INT,
    CodigoP INT,
    FOREIGN KEY (CodigoV) REFERENCES Venta(Codigo),
    FOREIGN KEY (CodigoP) REFERENCES Producto(Codigo)
);

-- ///////////////////////////////// TRIGGERS ////////////////////////////////////////

-- Crear un trigger para actualizar el precio, el stock y MontoFinal, Verificando Stock Disponible
DELIMITER //
CREATE TRIGGER Agregar_Producto_Venta_VENTA_PRODUCTO
BEFORE INSERT ON Venta_Producto
FOR EACH ROW
BEGIN
    DECLARE nuevo_precio DECIMAL(8,2);
    DECLARE stock_disponible INT;

    -- Obtener el precio del producto desde la tabla Producto
    SELECT Precio * NEW.Cantidad INTO nuevo_precio
    FROM Producto
    WHERE Codigo = NEW.CodigoP;

    -- Obtener el stock disponible
    SELECT Stock INTO stock_disponible
    FROM Producto
    WHERE Codigo = NEW.CodigoP;

    -- Verificar si hay suficiente stock
    IF stock_disponible >= NEW.Cantidad THEN
        -- Actualizar el precio en la tabla Venta_Producto
        SET NEW.Precio = nuevo_precio;

        -- Actualizar el stock en la tabla Producto restando la cantidad
        UPDATE Producto
        SET Stock = Stock - NEW.Cantidad
        WHERE Codigo = NEW.CodigoP;
        
        -- Actualizar MontoFinal en la tabla Venta sumando Precio y aplicando Descuento
		UPDATE Venta
		SET MontoFinal = MontoFinal + (NEW.Precio * (1 - Descuento))
		WHERE Codigo = NEW.CodigoV;
    ELSE
        -- Anular la inserción si no hay suficiente stock
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay suficiente stock disponible';
    END IF;
END;
//
DELIMITER ;


-- ////////////////////////////////// INSERT /////////////////////////////////////

-- Insertar filas en la tabla Cliente
INSERT INTO Cliente (Nombre, Direccion, Telefono) VALUES
    ('Juan Perez', 'Calle A 123', 123456789),
    ('Maria Rodriguez', 'Avenida B 456', 987654321),
    ('Carlos Gomez', 'Calle C 789', 654321987),
    ('Ana Martínez', 'Avenida D 012', 111223344),
    ('Roberto Sanchez', 'Calle E 345', 555666777);

-- Insertar filas en la tabla Proveedor
INSERT INTO Proveedor (Nombre, Direccion, Telefono, PaginaWeb) VALUES
    ('Proveedor A', 'Calle X 111', 111000111, 'www.proveedorA.com'),
    ('Proveedor B', 'Avenida Y 222', 222000222, 'www.proveedorB.com'),
    ('Proveedor C', 'Calle Z 333', 333000333, 'www.proveedorC.com'),
    ('Proveedor D', 'Avenida W 444', 444000444, 'www.proveedorD.com'),
    ('Proveedor E', 'Calle V 555', 555000555, 'www.proveedorE.com');

-- Insertar filas en la tabla Categoria
INSERT INTO Categoria (Nombre, Descripcion) VALUES
    ('Electrónicos', 'Productos electrónicos de última generación'),
    ('Ropa', 'Ropa de moda para todas las edades'),
    ('Hogar', 'Artículos para el hogar y decoración'),
    ('Deportes', 'Equipos y accesorios deportivos'),
    ('Alimentos', 'Productos alimenticios y comestibles');

-- Insertar filas en la tabla Producto
INSERT INTO Producto (Nombre, Precio, Stock, CodigoC, CodigoPr) VALUES
    ('Laptop', 1200.00, 50, 1, 1),
    ('Camiseta', 25.99, 100, 2, 2),
    ('Sofá', 499.99, 10, 3, 3),
    ('Balón de Fútbol', 19.99, 30, 4, 4),
    ('Arroz', 2.49, 200, 5, 5);


INSERT INTO Venta (CodCliente, Fecha, Descuento, MontoFinal)
VALUES (3, '2023-12-01', 0.50, 0.00);

INSERT INTO Venta_Producto (Cantidad, Precio, CodigoV, CodigoP)
VALUES (10, 0, 3, 3);

DELETE FROM Venta_Producto WHERE Codigo = 3;
DELETE FROM Venta WHERE Codigo = 2;

SELECT * FROM Venta;
SELECT * FROM Producto;
SELECT * FROM Venta_Producto;

DESCRIBE Producto;

