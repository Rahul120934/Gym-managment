-- Create the database
CREATE DATABASE IF NOT EXISTS gym_management;
USE gym_management;

-- Manager Table
CREATE TABLE Manager (
    Manager_id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Contact_Number VARCHAR(15),
    Email_id VARCHAR(255) UNIQUE NOT NULL
);

-- Trainer Table
CREATE TABLE Trainer (
    Trainer_id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email_id VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Contact_Number VARCHAR(15),
    Manager_id INT,
    FOREIGN KEY (Manager_id) REFERENCES Manager(Manager_id)
);

-- Trainees Table
CREATE TABLE Trainees (
    Trainee_id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Gender VARCHAR(10),
    Training_Plan TEXT,
    Contact_number VARCHAR(15),
    Age INT,
    Height FLOAT,
    Weight FLOAT,
    Trainer_id INT,
    FOREIGN KEY (Trainer_id) REFERENCES Trainer(Trainer_id)
);

-- Payment Table
CREATE TABLE Payment (
    payment_ID INT PRIMARY KEY AUTO_INCREMENT,
    method VARCHAR(50),
    Amount DECIMAL(10, 2),
    Trainee_id INT,
    Manager_id INT,
    FOREIGN KEY (Trainee_id) REFERENCES Trainees(Trainee_id),
    FOREIGN KEY (Manager_id) REFERENCES Manager(Manager_id)
);
