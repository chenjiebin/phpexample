<?php

$numList = [
    ['from' => 0, 'to' => 3000],
    ['from' => 15000, 'to' => 20000],
    ['from' => 2000, 'to' => 10000],
    ['from' => 4000, 'to' => 10000],
];

var_dump(mergeNumInterval($numList));

/**
 * 合并多个数字区间
 * @param $numList
 *  [
 *      ['from'=>1, 'to'=>2]
 *      ['from'=>1, 'to'=>2]
 *  ]
 * @return array
 */
function mergeNumInterval($numList)
{
    if (count($numList) <= 1) {
        return $numList;
    }
    // 按按照区间升序排列一下
    usort($numList, function ($a, $b) {
        $al = $a['from'];
        $bl = $b['from'];
        if ($al == $bl) {
            if ($a['to'] == $b['to']) {
                return 0;
            }
            return ($a['to'] < $b['to']) ? -1 : 1;
        }
        return ($al < $bl) ? -1 : 1;
    });

    $return = [];

    $total = count($numList);
    for ($i = 0; $i < $total; $i++) {
        $temp = $numList[$i];
        for ($j = $i + 1; $j < $total; $j++) {
            $item2 = $numList[$j];
            if (isNumIntervalntersection($temp, $item2)) {
                $temp['from'] = max($item2['from'], $temp['from']);
                $temp['to'] = max($item2['to'], $temp['to']);
                $i++;
            } else {
                break;
            }
        }
        $return[] = $temp;
    }
    var_dump($return);
    exit();
    return $return;
}

/**
 * 计算两个区间是否有交集
 *
 * @param array $numArray1
 * @param array $numArray2
 * @return int
 */
function isNumIntervalntersection($numArray1, $numArray2)
{
    if (count($numArray1) != 2) {
        return false;
    }
    if ($numArray2 && count($numArray2) != 2) {
        return false;
    }
    sort($numArray1);
    $from = $numArray1[0];
    $to = $numArray1[1];
    if (empty($numArray2)) {
        return false;
    }

    sort($numArray2);
    $otherFrom = $numArray2[0];
    $otherTo = $numArray2[1];

    if ($to < $otherFrom || $otherTo < $from) {
        return false;
    }
    return true;
}