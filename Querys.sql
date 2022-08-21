


CREATE TABLE `message_teacher` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL , `text` TEXT NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `message_teacher` ADD `timeStamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `text`;

DROP TABLE announce;
CREATE TABLE `announce` (
  `id` int(11) NOT NULL,
  `title` text,
  `html` text,
  `status` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `announce`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

