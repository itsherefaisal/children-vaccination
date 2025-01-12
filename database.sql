CREATE DATABASE vaccination_management;
USE vaccination_management;

-- Create Admins Table
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create Parents Table
CREATE TABLE parents (
    parent_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address TEXT,
    phone_number VARCHAR(15),
    type ENUM('Father', 'Mother') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create Hospitals Table
CREATE TABLE hospitals (
    hospital_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    availability VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    operating_hours VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create Children Table
CREATE TABLE children (
    child_id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    vaccination_status VARCHAR(255) DEFAULT 'Up-to-date',
    FOREIGN KEY (parent_id) REFERENCES parents(parent_id) ON DELETE CASCADE
);

-- Create Vaccines Table
CREATE TABLE vaccines (
    vaccine_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    doses_required INT NOT NULL
);

-- Create Vaccination Schedule Table
CREATE TABLE vaccination_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    child_id INT NOT NULL,
    vaccine_id INT NOT NULL,
    dose_number INT NOT NULL,
    scheduled_date DATE NOT NULL,
    status ENUM('Scheduled', 'Completed', 'Missed') DEFAULT 'Scheduled',
    FOREIGN KEY (child_id) REFERENCES children(child_id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(vaccine_id) ON DELETE CASCADE
);

-- Create Appointments Table
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NOT NULL,
    child_id INT NOT NULL,
    hospital_id INT NOT NULL,
    vaccine_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (parent_id) REFERENCES parents(parent_id) ON DELETE CASCADE,
    FOREIGN KEY (child_id) REFERENCES children(child_id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(vaccine_id) ON DELETE CASCADE
);

-- Create Reports Table
CREATE TABLE reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    child_id INT NOT NULL,
    vaccine_id INT NOT NULL,
    dose_number INT NOT NULL,
    completion_date DATE NOT NULL,
    hospital_id INT NOT NULL,
    FOREIGN KEY (child_id) REFERENCES children(child_id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(vaccine_id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE
);
