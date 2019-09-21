CREATE TABLE `grower` (
  `id` int PRIMARY KEY,
  `name` varchar(255)
);

CREATE TABLE `farm` (
  `id` int PRIMARY KEY,
  `grower_id` int
);

CREATE TABLE `planting_event` (
  `id` int PRIMARY KEY,
  `farm_id` int,
  `crop_type_id` int,
  `date` datetime
);

CREATE TABLE `crop_type` (
  `id` int PRIMARY KEY,
  `name` varchar(255)
);

ALTER TABLE `farm` ADD FOREIGN KEY (`grower_id`) REFERENCES `grower` (`id`);

ALTER TABLE `planting_event` ADD FOREIGN KEY (`farm_id`) REFERENCES `farm` (`id`);

ALTER TABLE `planting_event` ADD FOREIGN KEY (`crop_type_id`) REFERENCES `crop_type` (`id`);

INSERT INTO grower (id, name) VALUES
  (1, 'grower_1'), (2, 'grower_2'), (3, 'grower_3'),
  (4, 'grower_4'), (5, 'grower_5'), (6, 'grower_6');

INSERT INTO crop_type (id, name) VALUES
  (1, 'corn'), (2, 'soybeans');

INSERT INTO farm (id, grower_id) VALUES
  (1, 1), (2, 1), (3, 1),
  (4, 2), (5, 2), (6, 3)
;

INSERT INTO planting_event (id, farm_id, crop_type_id, date) VALUES
  (1, 1, 1, '2019-09-20 00:00:00'),
  (2, 1, 1, '2019-09-20 00:00:00'),
  (3, 1, 2, '2019-09-20 00:00:00'),
  (4, 2, 1, '2019-09-21 00:00:00'),
  (5, 2, 2, '2019-09-21 00:00:00'),
  (6, 2, 2, '2019-09-20 00:00:00'),
  (7, 3, 1, '2018-09-20 00:00:00'),
  (8, 3, 2, '2019-09-20 00:00:00'),
  (9, 4, 2, '2019-09-22 00:00:00'),
  (10, 4, 1, '2019-09-22 00:00:00'),
  (11, 4, 1, '2018-09-19 00:00:00'),
  (12, 5, 2, '2019-09-19 00:00:00'),
  (13, 5, 1, '2018-09-19 00:00:00'),
  (14, 6, 1, '2018-09-21 00:00:00'),
  (15, 6, 2, '2018-09-22 00:00:00')
;