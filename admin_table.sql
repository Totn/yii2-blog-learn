# frontend member table
create table `y_admin` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `username` varchar(255) NOT NULL COMMENT '用户名',
    `auth_key` varchar(255) NOT NULL COMMENT '自动登陆key',
    `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
    `password_reset_token` varchar(255) NOT NULL COMMENT '重置密码token',
    `email_validate_token` varchar(255) NOT NULL COMMENT '邮箱验证token',
    `email` varchar(255) NOT NULL COMMENT '邮箱',
    `role` smallint(6) NOT NULL DEFAULT 10 COMMENT '角色等级',
    `status` smallint(6) NOT NULL DEFAULT 10 COMMENT '状态',
    `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
    `vip_lv` int(11) NOT NULL DEFAUL 0 COMMENT 'vip等级',
    `created_at` int(11) NOT NULL COMMENT ' 创建时间',
    `updated_at` int(11)  NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
) engine-innoDB AUTO_INCREMENT-1 DEFAULT CHARSET-utf8 COMMENT-"backend admin table"