<tr>
    <th>논문심사표<br/>Attached Review File</th>
    <td>
        <input type="file" name="review_file" id="review_file" style="width:100%;" required/>
        <div style="padding-top:5px;">
            <?php if ($data['step'] == '4' || $data['step'] == '3' || !$data['step']):?>
                <a href="/down.php?link=<?=$info['file']['review_form1']['link']?>" class="btn btn-danger" style="color:#FFF">
                    <span class="glyphicon glyphicon-paperclip"></span> 1차 심사의견서
                </a>
            <?php elseif ($data['step'] == '14'):?>
                <a href="/down.php?link=<?=$info['file']['review_form2']['link']?>" class="btn btn-danger" style="color:#FFF">
                    <span class="glyphicon glyphicon-paperclip"></span> 2차 심사의견서
                </a>
            <?php elseif ($data['step'] == '24'):?>
                <a href="/down.php?link=<?=$info['file']['review_form3']['link']?>" class="btn btn-danger" style="color:#FFF">
                    <span class="glyphicon glyphicon-paperclip"></span> 3차 심사의견서
                </a>
            <?php endif ?>
        </div>
    </td>
</tr>
