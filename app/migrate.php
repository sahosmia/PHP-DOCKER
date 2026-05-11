<?php
require_once 'db.php';

$sql = "
CREATE TABLE IF NOT EXISTS clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE,
  phone VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_id INT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  status ENUM('active', 'completed', 'on_hold') DEFAULT 'active',
  start_date DATE,
  end_date DATE,
  FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  project_id INT,
  category_id INT,
  title VARCHAR(255) NOT NULL,
  priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
  status ENUM('todo', 'doing', 'done') DEFAULT 'todo',
  due_date DATE,
  FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS subtasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  title VARCHAR(255) NOT NULL,
  is_completed BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
);
";

if ($conn->multi_query($sql)) {
    do {
        /* store first result set */
        if ($result = $conn->store_result()) {
            $result->free();
        }
        /* print divider */
        if ($conn->more_results()) {
            // echo "-----------------\n";
        }
    } while ($conn->next_result());
    echo "Tables created successfully\n";
} else {
    echo "Error creating tables: " . $conn->error . "\n";
}

$conn->close();
