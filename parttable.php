<?php
/**
 * 生成分表SQL功能
 */
$sql = "CREATE TABLE `recharge_order_others_{i}` (
  `id` bigint(20) unsigned NOT NULL COMMENT '订单id',
  `uid` int(11) unsigned NOT NULL COMMENT '所属用户',
  `pay_type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式, 1支付宝wap支付；2支付宝客户端支付',
  `pay_order_num` varchar(64) NOT NULL DEFAULT '0' COMMENT '支付平台交易id',
  `pay_account` varchar(128) NOT NULL DEFAULT '' COMMENT '支付账号',
  `pay_order_status` varchar(24) NOT NULL DEFAULT '0' COMMENT '第三方支付状态',
  `pay_time` int(11) unsigned NOT NULL COMMENT '支付时间',
  `product_id` int(11) unsigned NOT NULL COMMENT '如：美币产品id',
  `product_external_id` varchar(255) NOT NULL DEFAULT '' COMMENT '苹果平台产品id',
  `amount` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '付款金额',
  `exchange_rate` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '兑换比例',
  `coins` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '充值的美币',
  `coins_present` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赠送的美币',
  `order_status` tinyint(1) unsigned NOT NULL COMMENT '订单状态，0未付款；1已付款；2取消订单；3订单过期',
  `created_at` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `uid_status` (`uid`,`order_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
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


