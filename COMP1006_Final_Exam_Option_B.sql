/*COMP1006 Final Exam SQL*/
USE gc100022849;

DROP TABLE IF EXISTS restaurants,cities;

CREATE TABLE cities
(city_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
city VARCHAR(50) NOT NULL);

INSERT INTO cities (city)
VALUES 
('San Diego'), ('San Francisco'), ('Los Angeles');

CREATE TABLE restaurants
(restaurant_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
address VARCHAR(100) NOT NULL, 
city_id INT NOT NULL,
phone VARCHAR(15) NOT NULL,
menu VARCHAR(100),
FOREIGN KEY (city_id) REFERENCES cities(city_id));

INSERT INTO restaurants
(name, address, city_id, phone, menu)
VALUES
('Rubio\'s', '4504 East Mission Bay Drive', 1, '858-272-2801', 'rubios.pdf'),
('Mama Testa', '1417 University Avenue', 1, '619-298-8226', 'mama-testa.pdf'),
('The Tin Fish', '170 Sixth Avenue', 1, '619-238-8100', 'the-tin-fish.pdf'),
('Pacific Catch', '1200 9th Avenue', 2, '415-504-6905', 'pacific-catch.pdf'),
('Papito', '317 Connecticut Street', 2, '415-695-0147', 'papito.pdf'),
('Nick\'s Crispy Tacos', '1500 Broadway St', 2, '415-286-8621', 'nicks-crispy-tacos.pdf'),
('Duke\'s Malibu' , '21150 Pacific Coast Highway', 3, '310-317-0777', 'dukes-malibu.pdf'),
('Senor Fish', '4803 Eagle Rock', 3, '323-257-7167', 'senor-fish.pdf'),
('Wahoo\'s Fish Taco', '6258 Wilshire Boulevard', 3, '323-933-2480', 'wahoos.pdf');
