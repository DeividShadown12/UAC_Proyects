DROP DATABASE Inventario;
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
    Precio DECIMAL,
    CodigoV INT,
    CodigoP INT,
    FOREIGN KEY (CodigoV) REFERENCES Venta(Codigo),
    FOREIGN KEY (CodigoP) REFERENCES Producto(Codigo)
);


