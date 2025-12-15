CREATE DATABASE IF NOT EXISTS RedSocial;
USE RedSocial;

CREATE TABLE Usuarios (
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT 0,
    activo BOOLEAN NOT NULL DEFAULT 0,
    fechaRegistro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Posts (
    idPost INT PRIMARY KEY AUTO_INCREMENT,
    idUsuario INT NOT NULL,
    fechaPublicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contenido VARCHAR(1000) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

CREATE TABLE Comentarios (
    idComentario INT PRIMARY KEY AUTO_INCREMENT,
    idPost INT NOT NULL,
    idUsuario INT NOT NULL,
    fechaPublicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contenido VARCHAR(1000) NOT NULL,
    FOREIGN KEY (idPost) REFERENCES Posts(idPost),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

CREATE TABLE Seguidores (
    idSeguidor INT NOT NULL,
    idSeguido INT NOT NULL,
    estado ENUM('pendiente','aceptado') NOT NULL DEFAULT 'pendiente',
    PRIMARY KEY (idSeguidor, idSeguido),
    FOREIGN KEY (idSeguidor) REFERENCES Usuarios(idUsuario),
    FOREIGN KEY (idSeguido) REFERENCES Usuarios(idUsuario)
);


-- Insert 4 users into the Usuarios table
INSERT INTO Usuarios (nombre, correo, contraseña, admin, activo)
VALUES 
('User1', 'user1@example.com', '$2y$10$QbERimcev6WAj9H3.c/6KO2kFtJ/cQUmfe5c.zPxfaMFWzVsB2wmC', 0, 1),
('User2', 'user2@example.com', '$2y$10$kwzVAIBcDyrB7Qz8645mSucLT.8V8sz7rwFI8jnQB.WrAEb9XtFfu', 0, 1),
('OscarHueso', 'oscarHueso@gmail.com', '$2y$10$BVo.Ixn5RW.y/C/clPp3A.mc86WY2IvnYMbQm.VezTDInIpL8.Vfi', 0, 1),
('Ahmad', 'ahmad@gmail.com', '$2y$10$2mBqfmPFaHarnZPm1ZhbIOL.fALO29gOPVm5sleBT58kKF1UV9QVC', 0, 1);

-- Insert 2 posts for each user
INSERT INTO Posts (idUsuario, contenido)
VALUES
-- User 1's posts
(1, 'Post 1 from User 1'),
(1, 'Post 2 from User 1'),

-- User 2's posts
(2, 'Post 1 from User 2'),
(2, 'Post 2 from User 2'),

-- User 3's posts
(3, 'Post 1 from User 3'),
(3, 'Post 2 from User 3'),

-- User 4's posts
(4, 'Post 1 from User 4'),
(4, 'Post 2 from User 4');

-- Insert 3 comments for each post
INSERT INTO Comentarios (idPost, idUsuario, contenido)
VALUES
-- Comments for User 1's first post
(1, 2, 'Comment 1 on Post 1 by User 2'),
(1, 3, 'Comment 2 on Post 1 by User 3'),
(1, 4, 'Comment 3 on Post 1 by User 4'),

-- Comments for User 1's second post
(2, 2, 'Comment 1 on Post 2 by User 2'),
(2, 3, 'Comment 2 on Post 2 by User 3'),
(2, 4, 'Comment 3 on Post 2 by User 4'),

-- Comments for User 2's first post
(3, 1, 'Comment 1 on Post 1 by User 1'),
(3, 3, 'Comment 2 on Post 1 by User 3'),
(3, 4, 'Comment 3 on Post 1 by User 4'),

-- Comments for User 2's second post
(4, 1, 'Comment 1 on Post 2 by User 1'),
(4, 3, 'Comment 2 on Post 2 by User 3'),
(4, 4, 'Comment 3 on Post 2 by User 4'),

-- Comments for User 3's first post
(5, 1, 'Comment 1 on Post 1 by User 1'),
(5, 2, 'Comment 2 on Post 1 by User 2'),
(5, 4, 'Comment 3 on Post 1 by User 4'),

-- Comments for User 3's second post
(6, 1, 'Comment 1 on Post 2 by User 1'),
(6, 2, 'Comment 2 on Post 2 by User 2'),
(6, 4, 'Comment 3 on Post 2 by User 4'),

-- Comments for User 4's first post
(7, 1, 'Comment 1 on Post 1 by User 1'),
(7, 2, 'Comment 2 on Post 1 by User 2'),
(7, 3, 'Comment 3 on Post 1 by User 3'),

-- Comments for User 4's second post
(8, 1, 'Comment 1 on Post 2 by User 1'),
(8, 2, 'Comment 2 on Post 2 by User 2'),
(8, 3, 'Comment 3 on Post 2 by User 3');

-- Insert follower relationships
-- User 1 follows User 2 and User 3
INSERT INTO Seguidores (idSeguidor, idSeguido, estado)
VALUES
(1, 2, 'aceptado'),
(1, 3, 'aceptado'),

-- User 2 does not follow anyone
(2, 1, 'pendiente'),
(2, 3, 'pendiente'),
(2, 4, 'pendiente'),

-- User 3 does not follow anyone
(3, 1, 'pendiente'),
(3, 2, 'pendiente'),
(3, 4, 'pendiente'),

-- User 4 does not follow anyone
(4, 1, 'pendiente'),
(4, 2, 'pendiente'),
(4, 3, 'pendiente');
