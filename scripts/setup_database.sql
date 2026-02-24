CREATE DATABASE IF NOT EXISTS nexus_publishing;
USE nexus_publishing;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(180) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(500) DEFAULT 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cart (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  UNIQUE KEY uq_cart_user_book (user_id, book_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  shipping_address TEXT NOT NULL,
  payment_method VARCHAR(50) NOT NULL,
  status VARCHAR(50) DEFAULT 'placed',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  book_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(180) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admin_users (username,password_hash)
VALUES ('admin', '$2y$10$Y9fd3tvyeRWpbGYVBxQzI.5PT6Ga0xeIY5GfKxA2UxA6hYcAfwN8S')
ON DUPLICATE KEY UPDATE username=username;

INSERT INTO books (title,author,description,price,image_url) VALUES
('The Silent Archive','Leah Wren','A mystery through forgotten libraries.',19.99,'https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=500'),
('Midnight Circuits','Owen Pike','Cyberpunk thriller set in Neo London.',22.50,'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500'),
('Ocean of Maps','Rina Sol','Travel memoir of hidden islands.',15.00,'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=500')
ON DUPLICATE KEY UPDATE title=VALUES(title);
