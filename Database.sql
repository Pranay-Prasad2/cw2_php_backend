
DATABASE NAME: "healthyfy"
CREATE TABLE area (
    area_id INT AUTO_INCREMENT NOT NULL,
    area_name varchar(30) NOT NULL,
    PRIMARY KEY (area_id)

);

CREATE TABLE user (
    user_id INT AUTO_INCREMENT NOT NULL,
    user_name varchar(30) NOT NULL,
    user_email varchar(30) NOT NULL,
    user_password varchar(30) NOT NULL,
    area_id INT NOT NULL,
    PRIMARY KEY (user_id),
    FOREIGN KEY (area_id) REFERENCES area(area_id)   
);

CREATE TABLE business (
    business_id INT AUTO_INCREMENT NOT NULL,
    business_name varchar(30) NOT NULL,
    business_desc varchar(100) NOT NULL,
    business_email varchar(30) NOT NULL,
    business_password varchar(30) NOT NULL,
    area_id INT NOT NULL,
    PRIMARY KEY (business_id),
    FOREIGN KEY (area_id) REFERENCES area(area_id)   
);

CREATE TABLE price(
    price_id INT AUTO_INCREMENT NOT NULL,
    price_cat VARCHAR(30) NOT NULL,
    PRIMARY KEY (price_id)
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT NOT NULL,
    product_name varchar(30) NOT NULL,
    product_desc varchar(100) NOT NULL,
    price_id INT NOT NULL,
    business_id INT NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (price_id) REFERENCES price(price_id),
    FOREIGN KEY (business_id) REFERENCES business(business_id)

);


INSERT INTO area (area_name) VALUES
('London'),
('Manchester'),
('Birmingham'),
('Leeds'),
('Glasgow'),
('Liverpool'),
('Bristol'),
('Sheffield'),
('Edinburgh'),
('Cardiff');

INSERT INTO price (price_cat) VALUES
('Affordable'),
('Moderate'),
('Premium'); 