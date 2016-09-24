<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content1_wrap clearfix"> 
	<?php /* navigation */ ?>
	<div class="NowLocation mt35 clearfix">
		<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <strong>결제완료</strong> </p>
	</div>
	<?php /* //navigation */ ?>
	<div class="listWrap positionR mt20">
		<h2 class="skip"><?php echo ($get_payment['pay_method']=='bank')?'무통장입금대기':'결제완료';?></h2>
			<!--  컨텐츠  -->
			<div class="companyContentWrap">
				<!-- 상품결제 -->
				<div class="memberResult mt50">
					<h2 class="pb20"> <img alt="<?php echo ($get_payment['pay_method']=='bank')?'무통장입금대기':'결제완료';?>" src="../images/basic/<?php echo ($get_payment['pay_method']=='bank')?'img_paymethod_end1_st.gif ':'img_paymethod_end1.gif';?>"> </h2>
					<div class="payWrap" >          
					<table>
					<caption><span class="skip"></span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<?php if($get_payment['pay_total']!=0){ ?>
					<tr>
						<th scope="row"><label>결제방식</label></th>
						<td><span><?php echo $pay_method;?></span></td>
					</tr>
					<?php } ?>
					<tr>
						<th scope="row"><label>주문금액</label></th>
						<td><span>
						<?php 
						if($get_payment['pay_total']){
							echo number_format($get_payment['pay_total'])."원";
						} else {
							echo "무료";
						}
						?>
						</span></td>
					</tr>
					<?php if($get_payment['pay_dc']){ ?>
					<tr>
						<th scope="row"> <label>할인금액</label></th>
						<td><span><?php echo number_format($get_payment['pay_dc']);?>원</span></td>
					</tr>
					<?php } ?>
					<tr>
						<th scope="row" <?php if($get_payment['pay_method']!='bank') { ?>class="bbend"<?php } ?>> <label>최종 결제금액</label></th>
						<td <?php if($get_payment['pay_method']!='bank') { ?>class="bbend"<?php } ?>><span><strong class="sumTot text_orange">
						<?php 
						if($get_payment['pay_price']){
							echo number_format($get_payment['pay_price'])."</strong><strong>원</strong>";
						} else {
							echo "무료</strong>";
						}
						?></span></td>
					</tr>
					<?php if($get_payment['pay_total'] && $get_payment['pay_method']=='bank' && $get_payment['pay_total'] != $get_payment['pay_dc']){ // 무통장 입금시?>
					<tr>
						<th scope="row"> <label>입금계좌</label></th>
						<td><span>[<?php echo $pay_bank[0];?>] <?php echo $pay_bank[1];?> (예금주: <?php echo $pay_bank[2];?>)</span></td>
					</tr>
					<tr>
						<th scope="row" class="bbend"> <label>입금자명</label></th>
						<td class="bbend"><span><?php echo $get_payment['pay_bank_name'];?></span></td>
					</tr>
					<?php } ?>
					</tbody>
					</table>
					</div>
					<div style="width:150px;" class="joinbtn clearfix mt30">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="/">메인페이지</a></div></li>
						</ul>
					</div>
				</div>
				<!-- //상품결제 -->
			</div>
			<!--  //컨텐츠 --> 
		</div>
	</div>
	</div>  
</section>