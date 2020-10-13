CREATE DATABASE scotbooks;

CREATE TABLE `user` (
  `user_name` VARCHAR(75) NOT NULL,
  `password` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`user_name`));


  CREATE TABLE `category` (
  `category_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_name`));


CREATE TABLE `product` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` FLOAT NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `image` VARCHAR(255) NOT NULL,
  `category_id` VARCHAR(45) NULL,
  PRIMARY KEY (`product_id`),
  CONSTRAINT `fk_product_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`category_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE TABLE `cart` (
  `user_id` VARCHAR(75) NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`, `product_id`),
  CONSTRAINT `fk_cart_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE TABLE `orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `Address` VARCHAR(255) NULL,
  `phone` INT NULL,
  `payment` VARCHAR(45) NULL,
  `user_id` VARCHAR(75) NULL,
  PRIMARY KEY (`order_id`),
  CONSTRAINT `fk_order_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE TABLE `order_product` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` VARCHAR(45) NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  CONSTRAINT `fk_op_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `product` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_op_order`
    FOREIGN KEY (`order_id`)
    REFERENCES `orders` (`order_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


ALTER TABLE `user` 
ADD COLUMN `first_name` VARCHAR(45) NULL AFTER `role`,
ADD COLUMN `last_name` VARCHAR(45) NULL AFTER `first_name`,
ADD COLUMN `email` VARCHAR(45) NULL AFTER `last_name`;

CREATE TABLE `inquiry` (
  `inquiry_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `subject` VARCHAR(100) NULL,
  `message` VARCHAR(255) NULL,
  PRIMARY KEY (`inquiry_id`));

ALTER TABLE `product` 
ADD COLUMN `in_stock` TINYINT NULL AFTER `category_id`;

ALTER TABLE `product` 
CHANGE COLUMN `in_stock` `in_stock` TINYINT(4) NULL DEFAULT 1 ;

ALTER TABLE `orders` 
ADD COLUMN `payment_method` VARCHAR(45) NULL AFTER `user_id`;

ALTER TABLE `orders` 
CHANGE COLUMN `payment_method` `payment_method` TINYINT NULL DEFAULT NULL ;

ALTER TABLE `product` 
CHANGE COLUMN `description` `description` TEXT NULL DEFAULT NULL ;


-- site information table and data 
CREATE TABLE `website_info` (
  `info_id` INT NOT NULL AUTO_INCREMENT,
  `fb` VARCHAR(255) NULL,
  `instergram` VARCHAR(255) NULL,
  `twiter` VARCHAR(255) NULL,
  `address` VARCHAR(255) NULL,
  `phone` VARCHAR(45) NULL,
  PRIMARY KEY (`info_id`));

INSERT INTO `website_info` (`fb`, `instergram`, `twiter`, `address`, `phone`) VALUES ('https://www.facebook.com/scotbook.book.1', 'https://www.instagram.com/scotbooks_BKStore/?hl=en', 'https://twitter.com/ScotbooksB', '105,<br> Baudaloke Mw,<br> Colombo 04', '+9477-080-4255');




-- These cascade scripts needed to delete user
-- if something went wrone remove this script. this only disable deleting a user
ALTER TABLE `orders` 
DROP FOREIGN KEY `fk_order_user`;
ALTER TABLE `orders` 
ADD CONSTRAINT `fk_order_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `user` (`user_name`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


ALTER TABLE `cart` 
DROP FOREIGN KEY `fk_cart_product`;
ALTER TABLE `cart` 
ADD CONSTRAINT `fk_cart_product`
  FOREIGN KEY (`product_id`)
  REFERENCES `product` (`product_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


ALTER TABLE `order_product` 
DROP FOREIGN KEY `fk_op_product`;
ALTER TABLE `order_product` 
ADD CONSTRAINT `fk_op_product`
  FOREIGN KEY (`product_id`)
  REFERENCES `product` (`product_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `product` 
DROP FOREIGN KEY `fk_product_category`;
ALTER TABLE `product` 
ADD CONSTRAINT `fk_product_category`
  FOREIGN KEY (`category_id`)
  REFERENCES `category` (`category_name`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `cart` 
DROP FOREIGN KEY `fk_cart_user`;
ALTER TABLE `cart` 
ADD CONSTRAINT `fk_cart_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `user` (`user_name`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `order_product` 
DROP FOREIGN KEY `fk_op_order`;
ALTER TABLE `order_product` 
ADD CONSTRAINT `fk_op_order`
  FOREIGN KEY (`order_id`)
  REFERENCES `orders` (`order_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

-- end of cascade scripts 