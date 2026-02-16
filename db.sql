CREATE TABLE admin (
id int(11) PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(55) NOT NULL,
pwd VARCHAR(55) NOT NULL
);

CREATE TABLE doctor (
id int(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(55) NOT NULL,
email VARCHAR(55) NOT NULL,
pwd VARCHAR(55) NOT NULL,
Specialization VARCHAR(55) NOT NULL,
is_active VARCHAR(55) DEFAULT 'is_active',
created_at timestamp DEFAULT CURRENT_DATE
);


CREATE TABLE patient (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(55) NOT NULL,
    email VARCHAR(55) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    doctor_id INT(11) NOT NULL,
    slot VARCHAR(20) NOT NULL,
    patient_date DATE NOT NULL
);
CREATE TABLE schedule (
id int(11) PRIMARY KEY AUTO_INCREMENT,
doctor_id int(11) NOT NULL,
day VARCHAR(55) NOT NULL,
start_time int(11) NOT NULL,
end_time int(11) NOT NULL,
slot int(55) NOT NULL,
created_at timestamp DEFAULT CURRENT_TIME
);