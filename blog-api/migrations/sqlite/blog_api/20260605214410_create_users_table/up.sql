CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email VARCHAR(320) NOT NULL UNIQUE,
  password TEXT NOT NULL,
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted_at DATETIME DEFAULT NULL
);

INSERT INTO users (email, password, first_name, last_name) VALUES
('user@example.com', '$2y$12$e8Fs.1Ht5p5XCqy0pBnmKO6gDVBrft1zz87LiMD1G5L2r.No0sav2', 'John', 'Doe');
