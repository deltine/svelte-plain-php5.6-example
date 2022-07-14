CREATE DATABASE php_test;

drop table account;
CREATE TABLE `account` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'アカウントID',
  `account_name` varchar(255) DEFAULT NULL COMMENT 'アカウント名',
  `email` varchar(255) DEFAULT NULL COMMENT 'Eメールアドレス',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新日',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '削除フラグ',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='アカウント';

select * from account;
INSERT INTO `account` (`account_name`, `email`, `password`, `created_at`, `updated_at`) VALUES ('a1', 'a2', 'a3', now(), now());
INSERT INTO `account` (`account_name`, `email`, `password`, `created_at`, `updated_at`) VALUES ('b1', 'b2', 'b3', now(), now());
INSERT INTO `account` (`account_name`, `email`, `password`, `created_at`, `updated_at`) VALUES ('c1', 'c2', 'c3', now(), now());
INSERT INTO account (`account_name`, `email`, `password`, `created_at`, `updated_at`) (select `account_name`, `email`, `password`, `created_at`, `updated_at` FROM account);

select * from account order by account_id limit 0, 10;
select * from account order by account_id limit 9, 10;