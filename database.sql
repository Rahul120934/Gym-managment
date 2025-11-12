CREATE DATABASE gym_management;
USE gym_management;

CREATE TABLE manager (
  manager_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  contact_number VARCHAR(15),
  email_id VARCHAR(100),
  password VARCHAR(255)
);

CREATE TABLE trainer (
  trainer_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  contact_number VARCHAR(15),
  email_id VARCHAR(100),
  password VARCHAR(255)
);

CREATE TABLE trainees (
  trainee_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  gender VARCHAR(10),
  email VARCHAR(100),
  contact_number VARCHAR(15),
  age INT,
  height FLOAT,
  weight FLOAT,
  training_plan TEXT,
  password VARCHAR(255)
);

CREATE TABLE payment (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  trainee_id INT,
  method VARCHAR(50),
  amount DECIMAL(10,2),
  FOREIGN KEY (trainee_id) REFERENCES trainees(trainee_id)
);
