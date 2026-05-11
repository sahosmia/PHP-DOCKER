# 🚀 TaskForge: Advanced Task & Project Management System

**TaskForge** is a high-performance, containerized Task Management System built to demonstrate professional software engineering principles including **Dockerization**, **Object-Oriented Programming (OOP)**, and **Complex Relational Database Design**.

---

## 🏗️ System Architecture & Design

The system is designed to handle multiple layers of project management, from high-level client oversight to granular subtask tracking.

### 📊 Database Schema
The database utilizes a relational structure with strict data integrity using Foreign Keys and Constraints.

* **Clients:** Management of external stakeholders and contact data.
* **Projects:** Client-specific ventures with defined timelines and statuses.
* **Categories:** Cross-project classification (e.g., Development, Design, Marketing).
* **Tasks:** Core units of work within a project, linked to specific categories.
* **Subtasks:** Granular checklists that drive Task completion.

---

## 🧠 Business Logic & Automation (State Management)

This project implements advanced "State Machine" logic to automate the workflow:

1.  **Vertical Synchronization:**
    * If all **Subtasks** under a Task are marked `Done`, the parent **Task** status automatically transitions to `Done`.
    * If a new **Subtask** is added to a `Done` Task, the parent status reverts to `Doing` to ensure visibility.
2.  **Project Progress Tracking:**
    * Real-time progress percentage calculation based on the ratio of completed tasks to total tasks using SQL Aggregations.

---

## 🛠️ Technical Stack

* **Environment:** Docker (Multi-container: PHP-FPM, Nginx, MySQL 8.0)
* **Language:** PHP 8.x (Strictly Object-Oriented)
* **Database:** MySQL (Relational Joins, Indexing, and Transactions)
* **Architecture:** * **Vanilla OOP:** No frameworks, focusing on the core "Engine" of PHP.
    * **PDO:** Secure data handling using prepared statements.
    * **Namespacing:** PSR-4 compliant autoloading.

---

## 📂 Project Structure

```text
├── .docker/                   
├── src/                       
│   ├── App/                   
│   │   ├── Database/          
│   │   │   └── Database.php
│   │   ├── Models/            
│   │   │   ├── Client.php
│   │   │   ├── Project.php
│   │   │   ├── Task.php
│   │   │   └── Subtask.php
│   │   └── Helpers/           
│   │       └── functions.php
│   ├── public/                
│   │   ├── assets/            
│   │   ├── index.php          
│   │   └── .htaccess          
│   └── views/                 
│       ├── includes/
│       │   ├── header.php
│       │   └── footer.php
│       ├── projects/
│       ├── tasks/
│       └── dashboard.php
├── .env                       
├── .dockerignore
├── .gitignore
├── Dockerfile
├── docker-compose.yml
└── README.md
