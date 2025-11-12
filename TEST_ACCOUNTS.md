# Test Accounts for Gym Management System

Use these accounts to test all features of the application.

---

## Manager (Admin) Accounts

| Name         | Email         | Password |
| ------------ | ------------- | -------- |
| Rahul Sharma | rahul@gym.com | admin123 |
| Priya Patel  | priya@gym.com | admin123 |

**Manager Features:**

- View all trainers and trainees
- Add new trainers
- Delete trainers
- Delete trainees
- View all system data

---

## Trainer Accounts

| Name           | Email          | Password   |
| -------------- | -------------- | ---------- |
| Prajay Kumar   | prajay@gym.com | trainer123 |
| Omkar Deshmukh | omkar@gym.com  | trainer123 |
| Vinay Singh    | vinay@gym.com  | trainer123 |

**Trainer Features:**

- View all trainees
- Update trainee training plans
- View trainee details and BMI

---

## Trainee Accounts

| Name        | Email            | Password | Age | Height | Weight |
| ----------- | ---------------- | -------- | --- | ------ | ------ |
| Arjun Mehta | arjun@gmail.com  | pass123  | 25  | 175cm  | 70kg   |
| Ananya Iyer | ananya@gmail.com | pass123  | 28  | 165cm  | 58kg   |
| Rohan Gupta | rohan@gmail.com  | pass123  | 22  | 180cm  | 85kg   |
| Sneha Reddy | sneha@gmail.com  | pass123  | 30  | 160cm  | 62kg   |
| Karan Joshi | karan@gmail.com  | pass123  | 27  | 178cm  | 75kg   |
| Diya Kapoor | diya@gmail.com   | pass123  | 24  | 168cm  | 55kg   |

**Trainee Features:**

- View personal dashboard
- See BMI calculation
- View training plan
- Make payments
- View profile details

---

## Quick Setup

1. **Create Database:**

   ```bash
   mysql -u root -p < database.sql
   ```

2. **Load Sample Data:**

   ```bash
   mysql -u root -p < sample_data.sql
   ```

3. **Start Server:**

   ```bash
   php -S localhost:8000
   ```

4. **Open Browser:**
   Go to: http://localhost:8000

---

## Testing Workflow

### Test Manager Features:

1. Go to http://localhost:8000
2. Click "Manager Login"
3. Login with: rahul@gym.com / admin123
4. Try adding a new trainer
5. View all trainees and trainers
6. Delete a trainer or trainee

### Test Trainer Features:

1. Go to http://localhost:8000
2. Click "Trainer Login"
3. Login with: prajay@gym.com / trainer123
4. View all trainees
5. Update a trainee's training plan

### Test Trainee Features:

1. Go to http://localhost:8000
2. Click "Trainee Login"
3. Login with: arjun@gmail.com / pass123
4. View your dashboard and BMI
5. Make a payment

---

## Reset Database

If you want to start fresh:

```bash
mysql -u root -p -e "DROP DATABASE gym_management;"
mysql -u root -p < database.sql
mysql -u root -p < sample_data.sql
```
