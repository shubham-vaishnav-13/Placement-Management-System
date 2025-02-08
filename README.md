# 📌 Placement Management System

## 🚀 Overview

The **Placement Management System** is a web-based application designed to streamline the campus placement process for educational institutions. It provides distinct portals for students and companies, facilitating efficient management and access to placement-related information.

---

## 🎯 Features

✅ **Student Portal**: Students can register, update their profiles, and access placement opportunities.

✅ **Company Portal**: Companies can post job opportunities, review student profiles, and manage recruitment activities.

---

## 🛠️ Technologies Used

### **Frontend**
- 🖥️ HTML5, CSS3, JavaScript

### **Backend**
- 🐘 PHP
- 🛢️ MySQL

### **Development Tools**
- 📝 Visual Studio Code
- 🔥 XAMPP / LAMPP

---

## 📥 Installation Guide

1️⃣ **Clone the Repository**
```bash
 git clone https://github.com/shubham-vaishnav-13/Placement-Management-System.git
```

2️⃣ **Set Up the Environment**
- If using **XAMPP (Windows)** or **LAMPP (Linux)**, copy the cloned folder to the `htdocs` directory.

3️⃣ **Database Configuration**
- Open **phpMyAdmin** and create a database named `auxilio`.
- Import the `auxilio.sql` file from the project into the database.

4️⃣ **Configure Database Connection**
- Open PHP files and update the database connection settings:
```php
$connect = mysqli_connect("localhost", "root", "", "auxilio");
```
- If your MySQL setup has a password, replace `""` with your password.

---

## 📂 Database Structure

The system uses a MySQL database named **auxilio**, which includes the following key tables:

🔹 `candidate` - Stores student details (ID, name, email, password, image, etc.).

🔹 `company` - Stores company details (ID, name, email, phone, website, description, address, logo, password).

🔹 `jobs` - Contains job postings (ID, title, location, salary, description, experience, company ID).

🔹 `connection` - Manages relationships between students and job applications (company ID, user ID, job ID).

Each table includes appropriate **primary keys** and **foreign key constraints** for data integrity.

---

## 🎮 Usage

🔹 Open your browser and navigate to:
```bash
http://localhost/Placement-Management-System
```
🔹 Login using the credentials provided for each role (Student, Company).

---

## 📸 Running Demo
Youtube Link  : https://youtu.be/plB3oW-7ABQ 
---

## 🤝 Contributing

🔹 Fork the repository and create a new branch for your feature/fix.

🔹 Commit your changes and push them to your fork.

🔹 Open a pull request and describe your changes.

---

---

🎯 *Developed with passion by [Shubham Vaishnav](https://github.com/shubham-vaishnav-13) and [Man Vadariya](https://github.com/Manvadariya)* 🚀
