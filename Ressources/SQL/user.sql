CREATE TABLE users(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    nation VARCHAR(100) NOT NULL,
    cp INT(6) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    currency VARCHAR(55) NOT NULL,
    session_id INT(10)
);

INSERT INTO `users` (`id`, `name`, `surname`, `birthday`, `nation`, `cp`, `email`, `password`, `currency`, `session_id`) VALUES (NULL, 'Paul', 'Douane', '2021-12-06', 'France', '28000', 'paul.douane@gmail.com', 'test', 'EUR', NULL);