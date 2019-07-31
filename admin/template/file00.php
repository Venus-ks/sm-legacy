<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:1rem 0">
    <tr>
        <td class="font_16">
            <img src="../images/icon.png"  align="absmiddle" class="mr5" />
            <?=($data['step']<10)?'File Upload':'Revised File Upload <i>(If you choose to revise, please make the changes in your text in a colored typeface to help us easily identify them.)</i>'?>
        </td>
    </tr>
</table>
<table class="boardType01_write">
<?php foreach($info['file_arr'] as $v): ?>
    <?php if(!$v['step'] || in_array($data['step'],$v['step'])):?>
    <tr>
        <th width="200">
            <?php if($v['required']):?>
            <span class="glyphicon glyphicon-ok" style="color:red"></span>
            <?php endif?>
                <?=$v['title']?>
                <br/>
                <?=$v['eng_title']?>
        </th>
        <td>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="<?=$v['name']?>" <?=($v['required'] && !$data[$v['name']])?'required':''?>>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-danger remove-file" type="button">Remove</button>
                </div>
            </div>

            <?php if($data[$v['name']]):?>
            <div style="padding-top:5px;">
                <span class="glyphicon glyphicon-save" style="color:red"></span>
                <strong>
                    <a href="/down.php?link=<?=$data[$v['name']]?>">
                        <?=end(explode("/",substr(strstr($data[$v['name']],'^'),1)))?>
                    </a>
                </strong>
            </div>
            <?php endif?>
            <?php if($v['file_on']):?>
                <br/>
                <a class="btn btn-default" href="<?=$info[$v['file']]?>">
                    <strong style="color:#B60000">한글양식</strong>
                </a>
                <?php if($v['file_en']):?>
                <a class="btn btn-default" href="<?=$info[$v['file_en']]?>">
                    <strong style="color:#B60000">English Form</strong>
                </a>
                <?php endif?>
                <br/>
            <?php endif?>
            <div style="padding:5px 0">
                <?php if($v['msg']):?>
                    <?=$v['msg']?>
                <?php else:?>
                    파일을 작성하여, 업로드해주시기 바랍니다.
                    /<br/>Please create a file and upload it.
                <?php endif?>
            </div>
        </td>
    </tr>
    <?php endif?>
<?php endforeach?>
</table>
<script type="text/javascript">
    $(".remove-file").on('click', function(e){
        var $el = $(this).parents("div").prev().children();
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
    });
</script>
