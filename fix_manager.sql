-- Add password column to manager table
ALTER TABLE manager ADD COLUMN password VARCHAR(255);

-- Insert manager sample data
INSERT INTO manager (name, contact_number, email_id, password) VALUES
('Rahul Sharma', '9876543210', 'rahul@gym.com', 'admin123'),
('Priya Patel', '9876543211', 'priya@gym.com', 'admin123');

-- Display managers
SELECT * FROM manager;
