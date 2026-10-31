show databases;
use inventory;
show tables;

select * from products;	
ALTER TABLE products
MODIFY quantity INT;
DROP TABLE products;

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name1 VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

commit;