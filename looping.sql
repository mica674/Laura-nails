CREATE TABLE users(
   id INT AUTO_INCREMENT,
   lastname VARCHAR(50)  NOT NULL,
   firstname VARCHAR(50)  NOT NULL,
   email VARCHAR(150)  NOT NULL,
   password VARCHAR(255)  NOT NULL,
   phone CHAR(10)  NOT NULL,
   birthdate DATE,
   created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   updated_at DATETIME,
   deleted_at DATETIME,
   validated_at DATETIME,
   PRIMARY KEY(id)
);

CREATE TABLE slots(
   id INT AUTO_INCREMENT,
   slot TIME NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE services(
   id INT AUTO_INCREMENT,
   service VARCHAR(50)  NOT NULL,
   duration TIME NOT NULL,
   price DECIMAL(5,2)   NOT NULL,
   description VARCHAR(150)  NOT NULL,
   created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   updated_at DATETIME,
   deleted_at DATETIME,
   PRIMARY KEY(id)
);

CREATE TABLE appointments(
   id INT AUTO_INCREMENT,
   appointment DATE NOT NULL,
   created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   validated_at DATETIME,
   updated_at DATETIME,
   deleted_at DATETIME,
   id_slots INT NOT NULL,
   id_users INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_slots) REFERENCES slots(id),
   FOREIGN KEY(id_users) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE comments(
   id INT AUTO_INCREMENT,
   content TEXT NOT NULL,
   title VARCHAR(30) NOT NULL,
   quotations TINYINT NOT NULL,
   created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   updated_at DATETIME,
   deleted_at DATETIME,
   moderated_at DATETIME,
   id_services INT,
   id_users INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_services) REFERENCES services(id),
   FOREIGN KEY(id_users) REFERENCES users(id)
);

CREATE TABLE appointments_services(
   id_appointments INT,
   id_services INT,
   PRIMARY KEY(id_appointments, id_services),
   FOREIGN KEY(id_appointments) REFERENCES appointments(id),
   FOREIGN KEY(id_services) REFERENCES services(id)
);
