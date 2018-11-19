<?
include_once("../_common1.php");

include_once("../head.php");
$mNum="0";
$sNum="0";
$ssNum="0";
?>

   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="199" height="800" valign="top" background="/images/leftbg.png"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="43" align="center">홍길동님 환영합니다.</td>
      </tr>
      <tr>
        <td align="center" style="padding-bottom:10px;"><img src="../images/btn_mypage.png"  /><img src="../images/btn_logout1.png" /></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../images/01_leftmenu01.png" width="199" height="70" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub01.php" class="leftmenuofflink"><strong>논문접수 등록</strong><br />
          <font class="font11">Paper Registration</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub02.php" class="leftmenuofflink"><strong>심사위원 추천</strong><br />
          <font class="font11">Reviewer Recommend</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub03.php" class="leftmenuofflink"><strong>심사위원 선정</strong><br />
          <font class="font11">Reviewer Assignment</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub04.php" class="leftmenuofflink"><strong>편집위원 결재</strong><br />
          <font class="font11">Editor-in-Chief Sanction</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub05.php" class="leftmenuofflink"><strong>논문 총평등록</strong><br />
          <font class="font11">Reivew Summary</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub06.php" class="leftmenuofflink"><strong>편집간사 심사현황</strong><br />
          <font class="font11">Reivew Progress Status</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub07.php" class="leftmenuofflink"><strong>심사위원 관리</strong><br />
          <font class="font11">Reviewer Registration</font></a></td>
        </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../images/03_leftmenu02.png" width="199" height="70" /></td>
        </tr>
        <tr>
          <td class="leftmenuoff"><a href="sub08.php" class="leftmenuofflink"><strong>회원관리</strong><br />
            <font class="font11">Membership</font></a></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
        <tr>
          <td class="leftmenuon"><strong>결제내역</strong><br />
            <font class="font11">Payment Breakdown</font></td>
        </tr>
        <tr>
          <td><img src="../images/leftline.png" width="199" height="2" /></td>
        </tr>
    </table></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="../images/titlebg.png"><img src="../images/03_title10.png" /></td>
      </tr>
      <tr>
        <td valign="top" style="padding:20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type="text" name="textfield4" id="textfield4" style="width:100px;"/>
              <img src="../images/icon_cal.png"  align="absmiddle" />
              <input type="text" name="textfield3" id="textfield3"  style="width:100px;"/><img src="../images/icon_cal.png"  align="absmiddle" />
              <select name="select" id="select" style="width:100px;height:26px;padding:10px 0;line-height:21px;" >
                <option>회원명칭</option>
                <option>논문명칭</option>
</select>
              <input type="text" name="textfield" id="textfield" />
              <img src="../images/btn_search.png" align="absmiddle" /></td>
            </tr>
          <tr>
            <td height="32">&nbsp;</td>
          </tr>
        
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
            <tr>
              <td class="borderbox"><strong>· Total : <font class="point">1,175</font></strong> Item</td>
            </tr>
            <tr>
              <td height="6"></td>
            </tr>
            <tr>
              <td><table class="boardType01">
                <tr>
                  <th><strong>No</strong></th>
                  <th><strong>구분</strong><br /></th>
                  <th><strong>회원명</strong><br /></th>
                  <th><strong>주문번호</strong></th>
                  <th><strong>결재방식</strong></th>
                  <th>등록일</th>
                  <th width="170"><strong>관리</strong></th>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
               <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>홍길동</td>
                  <td>서울대학교</td>
                  <td>gLine_ehikUcb18H120823</td>
                  <td>Hp<br />
                    신용카드<br />
                    무통장</td>
                  <td>2013-05-09<br />
06:33:59
</td>
                  <td><img src="../images/btn_modify.png" class="mr5" /><img src="../images/btn_delete1.png"  /></td>
                </tr>
              </table></td>
            </tr>
          </table>
          
          
         
          </td>
      </tr>
      <tr><td align="center" class="paging"> 
        	<span class="next"><img src="/images/list_prev.png" /></span>
        	<span>1</span>
            <span>2</span>
            <span class="on">3</span>
            <span>4</span>
            <span>5</span>
            <span>6</span>
            <span>7</span>
            <span>8</span>
            <span>9</span>
            <span>10</span>
            <span class="next"><img src="/images/list_next.png" /></span>
      </td></tr>
    </table></td>
  </tr>
</table>







