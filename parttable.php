<?php
/**
 * 生成分表SQL功能
 */
$sql = "CREATE TABLE `catch_doll_order_{i}` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` bigint(20) unsigned NOT NULL COMMENT 'uid',
  `status` tinyint(3) NOT NULL COMMENT '状态：1已扣金币；2已完成',
  `consume_amount` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '消费数量',
  `consume_present_amount` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '消费赠送美币数量',
  `amount_remain` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '剩余额度',
  `present_amount_remain` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '剩余赠送美币额度',
  `out_trade_no` varchar(64) NOT NULL COMMENT '第三方订单号',
  `catch_result` text NOT NULL COMMENT '抓取结果，json格式字符串',
  `consume_at` int(11) unsigned NOT NULL COMMENT '消费时间，作为和第三方结算的时间依据',
  `updated_at` int(11) unsigned NOT NULL COMMENT '更新时间',
  `created_at` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `unq_out_trade_no` (`out_trade_no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='抓娃娃业务'";
$start = 0;
$end = 16;
$leftPad = array(1, '0');
$leftPadLen = strlen($end);

$result = '';
for ($i = $start; $i < $end; $i++) {
    $pad = $i;
    if ($leftPad[0]) {
        $pad = str_pad($pad, $leftPadLen, $leftPad[1], STR_PAD_LEFT);
    }
    $result = $result . str_replace('{i}', $pad, $sql) . ';' . PHP_EOL . PHP_EOL;
}

echo $result;


