CREATE TABLE IF NOT EXISTS `Users` (
	`id` INT NOT NULL AUTO_INCREMENT
	,`email` VARCHAR(100) NOT NULL
	,`username` VARCHAR(60) NOT NULL
	,`password` VARCHAR(100) NOT NULL
	,`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	,`friend_code` INT(6) NOT NULL
	,PRIMARY KEY (`id`)
	,UNIQUE (`email`)
	,UNIQUE (`username`)
	,UNIQUE (`friend_code`)
)
