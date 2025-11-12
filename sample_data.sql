-- Sample data for Gym Management System
-- Use this to test the application

USE gym_management;

-- Insert sample managers (admin accounts)
INSERT INTO manager (name, contact_number, email_id, password) VALUES
('Rahul Sharma', '9876543210', 'rahul@gym.com', 'admin123'),
('Priya Patel', '9876543211', 'priya@gym.com', 'admin123');

-- Insert sample trainers
INSERT INTO trainer (name, contact_number, email_id, password) VALUES
('Prajay Kumar', '9876543220', 'prajay@gym.com', 'trainer123'),
('Omkar Deshmukh', '9876543221', 'omkar@gym.com', 'trainer123'),
('Vinay Singh', '9876543222', 'vinay@gym.com', 'trainer123');

-- Insert sample trainees
INSERT INTO trainees (name, gender, email, contact_number, age, height, weight, training_plan, password) VALUES
('Arjun Mehta', 'Male', 'arjun@gmail.com', '9876543230', 25, 175, 70, 'Strength Training - 5 days/week', 'pass123'),
('Ananya Iyer', 'Female', 'ananya@gmail.com', '9876543231', 28, 165, 58, 'Cardio + Yoga - 4 days/week', 'pass123'),
('Rohan Gupta', 'Male', 'rohan@gmail.com', '9876543232', 22, 180, 85, 'Weight Loss Program - 6 days/week', 'pass123'),
('Sneha Reddy', 'Female', 'sneha@gmail.com', '9876543233', 30, 160, 62, 'Fitness Maintenance - 3 days/week', 'pass123'),
('Karan Joshi', 'Male', 'karan@gmail.com', '9876543234', 27, 178, 75, 'Muscle Building - 5 days/week', 'pass123'),
('Diya Kapoor', 'Female', 'diya@gmail.com', '9876543235', 24, 168, 55, 'Toning + Pilates - 4 days/week', 'pass123');

-- Insert sample payments
INSERT INTO payment (trainee_id, method, amount) VALUES
(1, 'UPI', 5000.00),
(2, 'Credit Card', 6000.00),
(3, 'Cash', 4500.00),
(4, 'Debit Card', 5500.00),
(5, 'UPI', 7000.00),
(6, 'Net Banking', 6500.00);

-- Display inserted data
SELECT 'Managers:' as '';
SELECT * FROM manager;

SELECT 'Trainers:' as '';
SELECT * FROM trainer;

SELECT 'Trainees:' as '';
SELECT * FROM trainees;

SELECT 'Payments:' as '';
SELECT * FROM payment;
