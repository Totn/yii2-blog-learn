# frontend member table
CREATE TABLE `admin` (
    `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `username` VARCHAR(255) NOT NULL COMMENT '用户名',
    `auth_key` VARCHAR(255) NOT NULL COMMENT '自动登陆key',
    `password_hash` VARCHAR(255) NOT NULL COMMENT '加密密码',
    `password_reset_token` VARCHAR(255) NOT NULL COMMENT '重置密码token',
    `email_validate_token` VARCHAR(255) NOT NULL COMMENT '邮箱验证token',
    `email` VARCHAR(255) NOT NULL COMMENT '邮箱',
    `role` SMALLINT(6) NOT NULL DEFAULT 10 COMMENT '角色等级',
    `status` SMALLINT(6) NOT NULL DEFAULT 10 COMMENT '状态',
    `avatar` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '头像',
    `vip_lv` INT(11) NOT NULL DEFAULT 0 COMMENT 'vip等级',
    `created_at` INT(11) NOT NULL COMMENT ' 创建时间',
    `updated_at` INT(11)  NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT="backend admin table";