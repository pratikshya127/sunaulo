-- ================================
-- SUNAULO DATABASE
-- ================================

CREATE TABLE users (
    id         INT(11) NOT NULL AUTO_INCREMENT,
    full_name  VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    role       ENUM('elder','family') NOT NULL,
    phone      VARCHAR(20) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE elderly_profile (
    id                INT(11) NOT NULL AUTO_INCREMENT,
    user_id           INT(11) DEFAULT NULL,
    name              VARCHAR(100) DEFAULT NULL,
    age               INT(11) DEFAULT NULL,
    gender            VARCHAR(10) DEFAULT NULL,
    address           TEXT DEFAULT NULL,
    medical_condition TEXT DEFAULT NULL,
    created_at        DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE family_profile (
    id         INT(11) NOT NULL AUTO_INCREMENT,
    user_id    INT(11) DEFAULT NULL,
    phone      VARCHAR(20) DEFAULT NULL,
    address    TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE family_elder_link (
    id                 INT(11) NOT NULL AUTO_INCREMENT,
    family_id          INT(11) DEFAULT NULL,
    elder_id           INT(11) DEFAULT NULL,
    relationship       VARCHAR(50) DEFAULT NULL,
    is_primary_contact TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (family_id) REFERENCES family_profile(id) ON DELETE CASCADE,
    FOREIGN KEY (elder_id)  REFERENCES elderly_profile(id) ON DELETE CASCADE
);

CREATE TABLE medicine_schedule (
    id            INT(11) NOT NULL AUTO_INCREMENT,
    elder_id      INT(11) DEFAULT NULL,
    medicine_name VARCHAR(100) DEFAULT NULL,
    dosage        VARCHAR(50) DEFAULT NULL,
    med_interval  VARCHAR(50) DEFAULT NULL,
    reminder_time TIME DEFAULT NULL,
    status        ENUM('Pending','Taken','Not Taken','Finished','Missed') DEFAULT 'Pending',
    date          DATE DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (elder_id) REFERENCES elderly_profile(id) ON DELETE CASCADE
);

CREATE TABLE health_records (
    id             INT(11) NOT NULL AUTO_INCREMENT,
    elder_id       INT(11) DEFAULT NULL,
    blood_pressure VARCHAR(20) DEFAULT NULL,
    sleep_hours    INT(11) DEFAULT NULL,
    water_intake   INT(11) DEFAULT NULL,
    weight         FLOAT DEFAULT NULL,
    date           DATE DEFAULT NULL,
    user_id        INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (elder_id) REFERENCES elderly_profile(id) ON DELETE CASCADE
);

CREATE TABLE medical_contacts (
    id           INT(11) NOT NULL AUTO_INCREMENT,
    elder_id     INT(11) DEFAULT NULL,
    contact_name VARCHAR(100) DEFAULT NULL,
    contact_type ENUM('doctor','pharmacy','hospital','ambulance') DEFAULT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    address      TEXT DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (elder_id) REFERENCES elderly_profile(id) ON DELETE CASCADE
);

CREATE TABLE memories (
    id          INT(11) NOT NULL AUTO_INCREMENT,
    user_id     INT(11) DEFAULT NULL,
    title       VARCHAR(100) DEFAULT NULL,
    file_path   TEXT DEFAULT NULL,
    file_type   VARCHAR(50) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE mood_checkins (
    id         INT(11) NOT NULL AUTO_INCREMENT,
    elder_id   INT(11) DEFAULT NULL,
    mood       VARCHAR(50) DEFAULT NULL,
    note       TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (elder_id) REFERENCES elderly_profile(id) ON DELETE CASCADE
);

CREATE TABLE notifications (
    id         INT(11) NOT NULL AUTO_INCREMENT,
    user_id    INT(11) DEFAULT NULL,
    type       VARCHAR(50) DEFAULT NULL,
    message    TEXT DEFAULT NULL,
    is_read    TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE sos_alerts (
    id         INT(11) NOT NULL AUTO_INCREMENT,
    elder_id   INT(11) DEFAULT NULL,
    message    VARCHAR(255) DEFAULT NULL,
    latitude   DECIMAL(10,6) DEFAULT NULL,
    longitude  DECIMAL(10,6) DEFAULT NULL,
    address    TEXT DEFAULT NULL,
    status     VARCHAR(50) DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (elder_id) REFERENCES elderly_profile(id) ON DELETE CASCADE
);