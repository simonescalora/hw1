CREATE DATABASE IF NOT EXISTS 'hw1';
USE 'hw1';

CREATE TABLE IF NOT EXISTS 'users' (
  'id' int NOT NULL AUTO_INCREMENT,
  'nome' varchar(255) NOT NULL,
  'cognome' varchar(255) NOT NULL,
  'username' varchar(255) NOT NULL,
  'password' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS 'cart_item' (
  'id' int NOT NULL AUTO_INCREMENT,
  'name' varchar(255) NOT NULL,
  'description' varchar(255) NOT NULL,
  'price' float NOT NULL,
  'image' varchar(255) NOT NULL,
  'category_id' int NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB;

INSERT INTO `cart_item` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES ('1', 'Apple Iphone 13 128GB Mezzanotte', 'Penta Band - 5G - Wi-Fi - GPS', '829', 'iphone13.png', '2'), 
('2', 'Samsung Galaxy A52 13 128GB Black', 'Quadri Band - 5G - Wi-Fi - GPS', '289', 'galaxya52.png', '1'),
('3', 'Apple Iphone 11 128GB Nero', 'Display Liquid Retina HD 6,1\"', '599', 'iphone11.png', '2'), 
('4', 'Samsung Galaxy A13 128GB Black', 'Quadri Band - 4G - Wi-Fi - GPS', '152', 'galaxya13.png', '1'), 
('5', 'Apple Ipad Pro 128GB Grigio Siderale', 'Processore M1 8-Core - 11\" LED', '799', 'ipadpro.png', '4'), 
('6', 'Samsung Galaxy TAB S7 128GB', 'Tablet 12.4\" Wi-Fi', '529', 'galaxytab.png', '3'), 
('7', 'Apple Ipad Air 256GB Grigio Siderale', 'Processore M1 8-Core - 10.9\"', '769', 'ipadair.png', '4'),
('8', 'Samsung Galaxy TAB A8 64GB', 'Tablet 10.5\" 5G-LTE', '259', 'galaxytaba8.png', '3'),
('9', 'Apple AirPods con custodia di ricarica', 'Auricolari True Wireless', '129', 'airpods.png', '5'),
('10', 'Samsung Galaxy BUDS PRO Black', 'Compatibilità: SO Android 7.0', '129', 'samsungbuds.png', '5'),
('11', 'Apple Alimentatore MagSafe', 'Ricarica Wireless per Iphone', '39', 'magsafe.png', '5'),
('12', 'HAMA Cavo 1,5 metri Nero', 'Cavo da USB-A a USB-C', '12', 'cavo.png', '5');
