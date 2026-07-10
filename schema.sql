PRAGMA foreign_keys = ON;

-- ============================================
-- STUDENT
-- ============================================
CREATE TABLE student (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    student_no INTEGER NOT NULL UNIQUE,
    student_name TEXT,
    status TEXT NOT NULL DEFAULT 'active'
);

INSERT INTO student (id, student_no, student_name, status) VALUES
(88, 2023102555, 'SWIFT, Taylor B.', 'active'),
(89, 2023102598, 'NIEVA, Lester Loyd P.', 'active');

-- ============================================
-- SCHEDULES
-- ============================================
CREATE TABLE schedules (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    day_of_week TEXT,
    start_time TEXT,
    end_time TEXT,
    course_code TEXT NOT NULL UNIQUE,
    course_name TEXT NOT NULL
);

INSERT INTO schedules (id, day_of_week, start_time, end_time, course_code, course_name) VALUES
(1, 'Monday', '14:00:00', '17:00:00', 'MAT 402', 'Thesis 1'),
(2, 'Wednesday', '08:30:00', '11:30:00', 'MAT 401', 'Real Analysis'),
(3, 'Thursday', '11:00:00', '14:00:00', 'MCS 401L', 'Computer Networking Design Lab'),
(4, 'Wednesday', '14:00:00', '17:00:00', 'MCS 401', 'Computer Networking Design'),
(5, 'Wednesday', '07:00:00', '08:30:00', 'SSP 101d', 'The Entrepreneurial Mind'),
(6, 'Monday', '12:00:00', '13:30:00', 'SSP 101d*', 'The Entrepreneurial Mind'),
(7, 'Monday', '17:00:00', '20:00:00', 'RLW 101', 'Life and Works of Rizal');

-- ============================================
-- ENROLLMENTS
-- ============================================
CREATE TABLE enrollments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    student_id INTEGER NOT NULL,
    sched_id INTEGER NOT NULL,
    FOREIGN KEY (student_id) REFERENCES student(id),
    FOREIGN KEY (sched_id) REFERENCES schedules(id)
);

INSERT INTO enrollments (id, student_id, sched_id) VALUES
(8, 88, 6), (9, 88, 2), (10, 88, 1), (11, 88, 7), (12, 88, 4), (13, 88, 3),
(14, 89, 6), (15, 89, 2), (16, 89, 1), (17, 89, 7), (18, 89, 4), (19, 89, 3);

-- ============================================
-- GATE_CODES
-- ============================================
CREATE TABLE gate_codes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    sched_id INTEGER NOT NULL,
    code TEXT NOT NULL,
    generated_at TEXT NOT NULL,
    FOREIGN KEY (sched_id) REFERENCES schedules(id)
);

-- (Old gate codes are just history/logs — safe to skip re-inserting these,
--  since they've already expired and serve no purpose going forward.
--  Starting this table empty on the phone is fine.)

-- ============================================
-- ATTENDANCE
-- ============================================
CREATE TABLE attendance (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    time_in TEXT NOT NULL,
    gate_code TEXT DEFAULT NULL,
    student_id INTEGER NOT NULL,
    sched_id INTEGER NOT NULL,
    FOREIGN KEY (student_id) REFERENCES student(id),
    FOREIGN KEY (sched_id) REFERENCES schedules(id)
);
-- (No attendance rows existed yet in your export — starts empty, as expected)