CREATE TABLE users(
   id_users INT AUTO_INCREMENT,
   lastname VARCHAR(50)  NOT NULL,
   firstname VARCHAR(50)  NOT NULL,
   email VARCHAR(150)  NOT NULL,
   password VARCHAR(255)  NOT NULL,
   phone CHAR(10)  NOT NULL,
   birthdate DATE,
   created_at DATETIME NOT NULL,
   updated_at DATETIME,
   deleted_at DATETIME,
   validated_at DATETIME,
   PRIMARY KEY(id_users)
);

CREATE TABLE slots(
   id_slots INT AUTO_INCREMENT,
   slot TIME NOT NULL,
   PRIMARY KEY(id_slots)
);

CREATE TABLE services(
   id_services INT AUTO_INCREMENT,
   service VARCHAR(50)  NOT NULL,
   duration TIME NOT NULL,
   price DECIMAL(5,2)   NOT NULL,
   description VARCHAR(150)  NOT NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME,
   deleted_at DATETIME,
   PRIMARY KEY(id_services)
);

CREATE TABLE appointments(
   id_appointments INT AUTO_INCREMENT,
   appointment DATE NOT NULL,
   created_at DATETIME NOT NULL,
   validated_at DATETIME,
   updated_at DATETIME,
   deleted_at DATETIME,
   id_slots INT NOT NULL,
   id_users INT NOT NULL,
   PRIMARY KEY(id_appointments),
   FOREIGN KEY(id_slots) REFERENCES slots(id_slots),
   FOREIGN KEY(id_users) REFERENCES users(id_users)
);

CREATE TABLE comments(
   id_comments INT AUTO_INCREMENT,
   content TEXT NOT NULL,
   quotations TINYINT NOT NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME,
   deleted_at DATETIME,
   moderated_at DATETIME,
   id_services INT NOT NULL,
   id_users INT NOT NULL,
   PRIMARY KEY(id_comments),
   FOREIGN KEY(id_services) REFERENCES services(id_services),
   FOREIGN KEY(id_users) REFERENCES users(id_users)
);

CREATE TABLE appointments_services(
   id_appointments INT,
   id_services INT,
   PRIMARY KEY(id_appointments, id_services),
   FOREIGN KEY(id_appointments) REFERENCES appointments(id_appointments),
   FOREIGN KEY(id_services) REFERENCES services(id_services)
);
