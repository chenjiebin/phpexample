<?php

$sql = "CREATE TABLE IF NOT EXISTS `mp_sign_in`.`lucky_draw_{i}` (
  `id` BIGINT(20) UNSIGNED NOT NULL COMMENT '编号',
  `uid` INT(11) UNSIGNED NOT NULL COMMENT '用户编号',
  `reward_id` INT(11) UNSIGNED NOT NULL COMMENT '抽奖奖品编号',
  `reward_result` VARCHAR(255) NOT NULL COMMENT '抽中的奖品结果',
  `used_at` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '使用时间',
  `created_at` INT(11) UNSIGNED NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  INDEX `uid` USING BTREE (`uid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COMMENT = '抽奖记录表'";
$start = 0;
$end = 128;
$leftPad = array(1, '0');

$result = '';
for ($i = $start; $i < $end; $i++) {
    $pad = $i;
    if ($leftPad[0]) {
        $pad = str_pad($pad, 3, $leftPad[1], STR_PAD_LEFT);
    }
    $result = $result . str_replace('{i}', $pad, $sql) . ';' . PHP_EOL . PHP_EOL;
}

echo $result;


