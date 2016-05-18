CREATE TABLE ft_table (
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	login varchar(8) DEFAULT 'toto' NOT NULL,
	groupe ENUM('staff', 'student', 'other') NOT NULL,
	date_de_creation DATE NOT NULL
)