
CREATE TABLE bank_account(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    bank VARCHAR(150) NOT NULL,
    balance INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE transaction(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    amount INT(6) NOT NULL,
    date DATE NOT NULL,
    category VARCHAR(100) NOT NULL,
    bank_id INT,
    FOREIGN KEY (bank_id) REFERENCES bank_account(id)
);