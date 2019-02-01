<?php
$js = [
    'header' => [
        '진행상태','논문번호','저널명','원고종류','심사요청분야','논문명','투고자','투고일','할일'
    ],
    'header_eng' => [
        'Status','Paper Number','Journal Title','Type of Paper','Review Category','Title','Author','Submission Date','TODO'
    ],
];
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <?php foreach($js['header'] as $k=>$v): ?>
                <th scope="col"><?=$v?><?=($js['header_eng'][$k])?"<br/>{$js['header_eng'][$k]}":''?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $k => $v):?>
        <tr>
            <th scope="row"><?=get_status($v['seq'])?></th>
            <td><?=$info['abbr'].'-'.date('y').'-'.str_pad($v['number'],3,'0',STR_PAD_LEFT)?></td>
            <td><?=$v['journal']?></td>
            <td><?=get_manuscript($v['manuscript'])?></td>
            <td><?=get_category_target($v['review_category_target'])?></td>
            <td><?=$v['title']?></td>
            <td><?=$v['mb_name']?></td>
            <td><?=$v['regdate']?></td>
            <td>btn</td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
